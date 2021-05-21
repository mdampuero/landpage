<?php

namespace Apachecms\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LandingLabelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('navbarAbout')
        ->add('navbarProductOrService')
        ->add('navbarContact')
        ->add('formLegend')
        ->add('headerTitle')
        ->add('contactName')
        ->add('contactEmail')
        ->add('contactPhone')
        ->add('contactQuery')
        ->add('contactBtn')
        ->add('aboutTitle')
        ->add('aboutDescription')
        ->add('productOrServiceTitle')
        ->add('productOrServiceDescription')
        ->add('productOrServiceBtn');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\LandingLabel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_landinglabel';
    }


}
