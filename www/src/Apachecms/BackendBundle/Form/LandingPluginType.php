<?php

namespace Apachecms\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class LandingPluginType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('googleAnalitycs',TextareaType::class,array('label'=>false, 'label_attr'=>array('class'=>'control-label'),'attr'=>array('style'=>'height:150px','placeholder'=>'<script>...</script>','class'=>'form-control')))
        ->add('googleAdsLanding',TextareaType::class,array('label'=>'googleAdsLanding', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('style'=>'height:150px','class'=>'form-control','placeholder'=>'<script>...</script>')))
        ->add('googleAdsSuccess',TextareaType::class,array('label'=>'googleAdsSuccess', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('style'=>'height:150px','class'=>'form-control','placeholder'=>'<script>...</script>')))
        ->add('pixelFacebook',TextareaType::class,array('label'=>'pixelFacebook', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('style'=>'height:150px','class'=>'form-control','placeholder'=>'<script>...</script>')))
        ->add('metaTagsDescription',TextareaType::class,array('label'=>'metaTagsDescription', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('style'=>'height:150px','class'=>'form-control')))
        ->add('metaIndex',CheckboxType::class, array('label'=>'metaIndex','attr'=>array('class'=>'switch')))
        ->add('submit', SubmitType::class, array('label'=>'save','attr'=>array('class'=>'btn btn-info')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\LandingPlugin'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_landingplugin';
    }


}
