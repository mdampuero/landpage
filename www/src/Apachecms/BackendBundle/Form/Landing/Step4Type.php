<?php

namespace Apachecms\BackendBundle\Form\Landing;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Step4Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('useChatbot',CheckboxType::class, array('label'=>'yes_no','attr'=>array('class'=>'switch')))
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
        return 'landing_step4';
    }

}
