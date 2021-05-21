<?php

namespace Apachecms\BackendBundle\Form\Page;

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

class PageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('code',TextType::class,array('label'=>'Código','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('nameEs',TextType::class,array('label'=>'Título en español','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('nameEn',TextType::class,array('label'=>'Título en inglés','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('descriptionEs',TextareaType::class,array('label'=>'Descripcion en español','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('descriptionEn',TextareaType::class,array('label'=>'Descripcion en inglés','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\Page'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_page';
    }


}
