<?php

namespace Apachecms\BackendBundle\Form\Landing;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Apachecms\BackendBundle\Entity\LandingLabel;

class Step5Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('template',ChoiceType::class, array('label'=>'templates',
        'choices' => array(
            'Plantilla 1' => 'template_1',
            'Plantilla 2' => 'template_2',
            'Plantilla 3' => 'template_3',
            'Plantilla 4' => 'template_4'
        ),'attr'=>array('class'=>'form-control')))
        ->add('navBarTop',TextType::class,array('label'=>'navbar.top','constraints' => array(new NotBlank())))
        ->add('brightness',HiddenType::class,array('label'=>'brightness','constraints' => array()))
        ->add('navBarTopText',TextType::class,array('label'=>'navbar.top.text','constraints' => array(new NotBlank())))
        ->add('navBarFixed',TextType::class,array('label'=>'navbar.fixed','constraints' => array(new NotBlank())))
        ->add('navBarFixedText',TextType::class,array('label'=>'navbar.fixed.text','constraints' => array(new NotBlank())))
        ->add('colorPrimary',TextType::class,array('label'=>'color.primary','constraints' => array(new NotBlank())))
        ->add('backgroundImage',HiddenType::class,array('constraints' => array(new NotBlank())))
        ->add('contactPhone',TextType::class)
        ->add('contactAddress',TextType::class)
        ->add('contactEmail',EmailType::class)
        // ->add('navbarAbout', EntityType::class, array(
        //     'class' => 'ApachecmsBackendBundle:LandingLabel',
        //     'choice_label' => 'navbarAbout'
        // ))
        // ->add('labels.navbarAbout', EntityType::class, array(
        //     'label'=>'industry',
        //     'class' => 'ApachecmsBackendBundle:LandingLabel',
        //     'choice_label' => 'navbarAbout'
        // ))
        // ->add('gridColumns',ChoiceType::class, array('label'=>'columns',
        // 'choices' => array(
        //     '2.columns' => 'col-md-6 col-sm-12',
        //     '3.columns' => 'col-md-4 col-sm-6',
        //     '4.columns' => 'col-md-3 col-sm-6',
        //     '6.columns' => 'col-md-2 col-sm-4'
        // ),
        
        ->add('submit', SubmitType::class, array('label'=>'form.save','attr'=>array('class'=>'btn btn-info pull-right')))
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'allow_extra_fields'=>true,
            'data_class' => 'Apachecms\BackendBundle\Entity\Landing'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'landing_step5';
    }

}
