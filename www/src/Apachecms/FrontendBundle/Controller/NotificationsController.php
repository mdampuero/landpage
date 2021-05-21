<?php

namespace Apachecms\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class NotificationsController extends Controller
{
    public function __construct(TokenStorage $storage = null,RouterInterface $router){
        if($storage->getToken()->getUser()->getUrlDestination()){
            $urlDestination=json_decode($storage->getToken()->getUser()->getUrlDestination(),true);
            header('Location: '.$router->generate($urlDestination['url'],$urlDestination['params']));
            exit();
        }
    }

    public function indexAction(Request $request){
        return $this->render('ApachecmsFrontendBundle:Notifications:index.html.twig');
    }
    
}
