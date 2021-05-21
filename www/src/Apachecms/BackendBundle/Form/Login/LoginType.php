<?php

namespace Apachecms\BackendBundle\Form\Login;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;

class LoginType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('_username',EmailType::class,array('label' => 'form.email',
        'constraints' => array(new Email(),new NotBlank()),
        'attr'=>array('class'=>'form-control','placeholder'=>'form.email')))
        ->add('_password', PasswordType::class, array('label' => 'Clave',
        'constraints' => array(new Length(array('min'=>6,'max'=>32)),new NotBlank()),
        'attr'=>array('class'=>'form-control','placeholder'=>'password')))
        ->add('submit', SubmitType::class, array('label'=>'login','attr'=>array('class'=>'btn btn-info')))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }


}
