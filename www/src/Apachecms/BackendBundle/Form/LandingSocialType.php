<?php

namespace Apachecms\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class LandingSocialType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('facebook',TextType::class,array('constraints' => array(new Url())))
        ->add('web',TextType::class,array('constraints' => array(new Url())))
        ->add('googlePlus',TextType::class,array('constraints' => array(new Url())))
        ->add('twitter',TextType::class,array('constraints' => array(new Url())))
        ->add('youtube',TextType::class,array('constraints' => array(new Url())))
        ->add('linkedin',TextType::class,array('constraints' => array(new Url())))
        ->add('instagram',TextType::class,array('constraints' => array(new Url())));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\LandingSocial'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_landingsocial';
    }


}
