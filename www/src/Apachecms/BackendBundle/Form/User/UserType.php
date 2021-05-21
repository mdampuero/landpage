<?php

namespace Apachecms\BackendBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',TextType::class,array('label'=>'Nombre','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'Ingrese el nombre')))
        ->add('email',TextType::class,array('label'=>'Email','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'Ingrese el email')))
        ->add('plainPassword', RepeatedType::class, array(
            'type' => PasswordType::class,
            'constraints' => array(new Length(array('min'=>6,'max'=>32))),
            'first_options'  => array('label'=>'Contraseña','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')),
            'second_options' => array('label'=>'Repita la contraseña','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')),
        ))
        ->add('role',ChoiceType::class, array('label'=>'Rol','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control'),'choices' => array(
            'Superusuario' => 'ROLE_SUPER',
            'Administrador' => 'ROLE_ADMIN',
            'Operador' => 'ROLE_OPER'
            )))
        ->add('isActive',ChoiceType::class, array('label'=>'Activo','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control'),'choices' => array(
                'SI' => 1,
                'NO' => 0
        )))
        ->add('picture', FileType::class, array(
            'label'=>'Foto',
            'data_class' => null,
            'label_attr'=>array('class'=>'control-label'),
            'attr'=>array(
                'class'=>'dropify',
                'data-height'=>'300',
                'data-max-file-size'=>'2M',
                'data-allowed-file-extensions'=>'png jpg jpeg gif'
                )
            )
        )
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_user';
    }


}
