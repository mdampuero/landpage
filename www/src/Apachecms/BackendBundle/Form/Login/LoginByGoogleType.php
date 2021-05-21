<?php

namespace Apachecms\BackendBundle\Form\Login;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;

class LoginByGoogleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'form.name')))
        ->add('lastName',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'form.name')))
        ->add('email',EmailType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'form.email')))
        ->add('googleId',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'form.email')))
        ->add('submit', SubmitType::class, array('label'=>'register','attr'=>array('class'=>'btn btn-info')))
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
        return 'apachecms_backendbundle_customer_login_by_google';
    }


}
