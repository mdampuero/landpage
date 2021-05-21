<?php

namespace Apachecms\BackendBundle\Form\Plan;

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

class PlanType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nameEs',TextType::class,array('label'=>'Nombre','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('price',NumberType::class,array('label'=>'Precio $','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('percentDiscount',NumberType::class,array('label'=>'% Descuento pago anual','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('trialDays',IntegerType::class,array('label'=>'Días de prueba','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('maxVisits',IntegerType::class,array('label'=>'Máximo de visitas','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('maxLeads',IntegerType::class,array('label'=>'Máximo de Leads','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('order',IntegerType::class,array('label'=>'Orden de explosición','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('maxBusiness',IntegerType::class,array('label'=>'Máximo de empresas','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('maxLanding',IntegerType::class,array('label'=>'Máximo de landings','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('descriptionEs',TextareaType::class,array('label'=>'Descripcion en español','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('descriptionEn',TextareaType::class,array('label'=>'Descripcion en inglés','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('supportEmail',ChoiceType::class, array('label'=>'Email de soporte',
        'choices' => array(
            'SI' => '1',
            'NO' => '0'
        ),
        'attr'=>array('class'=>'form-control')))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\Plan'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_plan';
    }


}
