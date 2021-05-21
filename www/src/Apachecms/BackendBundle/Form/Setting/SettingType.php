<?php

namespace Apachecms\BackendBundle\Form\Setting;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FloatType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SettingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('dolar',TextType::class,array('label'=>'Valor del dólar','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('googleMapsId',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('ppClientId',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('greetingSecondResponse',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('mpClientId',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('mpClientSecret',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('mpAccessToken',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('mpPublicKey',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('greetingSecondTrigger',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('moreInfoResponse',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('moreInfoTrigger',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('morePriceResponse',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('morePriceTrigger',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('notUnderstand',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('notUsePhoneTrigger',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('notUsePhoneResponse',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('phoneNotValid',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('emailNotValid',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('loginGoogleClientId',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('loginFacebookAppId',TextType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('scriptGoogleAnalytics',TextareaType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','style'=>'height:200px;')))
        ->add('metaTags',TextareaType::class,array('label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','style'=>'height:200px;')))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\Setting'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_setting';
    }


}
