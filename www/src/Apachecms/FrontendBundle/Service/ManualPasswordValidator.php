<?php

namespace Apachecms\FrontendBundle\Service;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

/**
 * Class ManualPasswordValidator
 *
 * @package Apachecms\FrontendBundle\Service
 */
class ManualPasswordValidator
{
    /**
     * @var EncoderFactory
     */
    protected $encoderFactory;

    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * ManualPasswordValidator constructor.
     * 
     * @param EncoderFactory $encoderFactory
     * @param TokenStorage $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage, EncoderFactory $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param $password
     * @return bool
     */
    public function passwordIsValidForCurrentUser($password)
    {
        $token = $this->tokenStorage->getToken();

        if ($token) {
            $user = $token->getUser();

            if ($user) {
                $encoder = $this->encoderFactory->getEncoder($user);

                if ($encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())) {
                    return true;
                }
            }
        }

        return false;
    }
}