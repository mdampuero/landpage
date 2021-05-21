<?php

namespace Apachecms\BackendBundle\Form\Login;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RecoverType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('plainPassword', RepeatedType::class, array(
            
            'type' => PasswordType::class,
            'first_options'  => array(
                'label'=>'Contraseña',
                'constraints' => array(new Length(array('min'=>6,'max'=>32)),new NotBlank()),
                'label_attr'=>array('class'=>'control-label'),'attr'=>array('autocomplete'=>'new-password','class'=>'form-control','placeholder'=>'form.password.first')),
            'second_options' => array('label'=>'Repita la contraseña',
            'constraints' => array(new Length(array('min'=>6,'max'=>32)),new NotBlank()),
            'label_attr'=>array('class'=>'control-label'),'attr'=>array('autocomplete'=>'new-password','class'=>'form-control','placeholder'=>'form.password.second')),
        ))
        ->add('submit', SubmitType::class, array('label'=>'reset.password','attr'=>array('class'=>'btn btn-info')))
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
        return 'reset_password';
    }


}
