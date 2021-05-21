<?php

namespace Apachecms\BackendBundle\Form\Landing;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class Step2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        // ->add('isProductService',ChoiceType::class, array('label'=>'product.or.service',
        // 'choices' => array(
        //     'yes' => true,
        //     'no' => false
        // ),
        // 'attr'=>array('class'=>'form-control')))
        ->add('isProductService',CheckboxType::class, array('label'=>'yes_no','attr'=>array('class'=>'switch')))
        // ->add('gridColumns',ChoiceType::class, array('label'=>'columns',
        // 'choices' => array(
        //     '2.columns' => 'col-sm-6',
        //     '3.columns' => 'col-sm-4',
        //     '4.columns' => 'col-sm-3',
        //     '6.columns' => 'col-sm-2'
        // ),
        // 'attr'=>array('class'=>'form-control')))
        ->add('gridColumns',HiddenType::class,array('data' => 'col-md-3 col-sm-6'))
        ->add('submit', SubmitType::class, array('label'=>'form.continue','attr'=>array('class'=>'btn btn-info pull-right')))
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\Landing'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'landing_step2';
    }

}
