<?php

namespace Apachecms\BackendBundle\Form\Customer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName',TextType::class,array('label'=>'form.first.name','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'form.first.name')))
        ->add('lastName',TextType::class,array('label'=>'form.last.name','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'form.last.name')))
        ->add('email',EmailType::class,array('label'=>'form.email','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'form.email')))
        ->add('plainPassword', RepeatedType::class, array(
            
            'type' => PasswordType::class,
            'first_options'  => array(
                'label'=>'form.password.first',
                'constraints' => array(new Length(array('min'=>6,'max'=>32)),new NotBlank()),
                'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'form.password.first')),
            'second_options' => array('label'=>'form.password.second',
            'constraints' => array(new Length(array('min'=>6,'max'=>32)),new NotBlank()),
            'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'form.password.second')),
        ))
        ->add('submit', SubmitType::class, array('label'=>'register','attr'=>array('class'=>'btn btn-info')))
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\Customer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_customer';
    }


}
