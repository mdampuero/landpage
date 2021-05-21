<?php

namespace Apachecms\FrontendBundle\Form\Started;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;

class Step2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName',TextType::class,array(
            'constraints' => array(new NotBlank()),
            'label' => null,
            'attr'=>array('class'=>'form-control','placeholder'=>'form.first.name'
            )))
        ->add('lastName',TextType::class,array(
            'constraints' => array(new NotBlank()),
            'label' => null,
            'attr'=>array('class'=>'form-control','placeholder'=>'form.last.name'
            )))
        ->add('email',EmailType::class,array(
            'constraints' => array(new NotBlank(),new Email()),
            'label' => null,
            'attr'=>array('class'=>'form-control','placeholder'=>'form.email'
            )))
        ->add('phone',TextType::class,array(
            'constraints' => array(),
            'label' => null,
            'attr'=>array('class'=>'form-control','placeholder'=>'form.phone'
            )))
        ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'constraints' => array(new NotBlank(),new Length(array('min'=>6,'max'=>32))),
                'first_options'  => array('label'=>'Contraseña','label_attr'=>array('class'=>'control-label'),'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'form.password.first'
                )),
                'second_options' => array('label'=>'Repita la contraseña','label_attr'=>array('class'=>'control-label'),'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'form.password.second'
                )),
            ))
        ->add('submit', SubmitType::class, array('label'=>'form.continue','attr'=>array('class'=>'btn btn-info')))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
            'allow_extra_fields'=>true
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
