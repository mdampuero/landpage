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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class Step3Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('contactPhone',TextType::class, array('label'=>'contact.phone','attr'=>array('class'=>'form-control')))
        ->add('contactAddressMap',CheckboxType::class, array('label'=>'yes_no','attr'=>array('class'=>'switch')))
        ->add('social',CheckboxType::class, array('label'=>'yes_no','attr'=>array('class'=>'switch')))
        ->add('useWhatsapp',CheckboxType::class, array('label'=>'yes_no','attr'=>array('class'=>'switch')))
        ->add('useWhatsappMobile',CheckboxType::class, array('label'=>'yes_no','attr'=>array('class'=>'switch')))
        ->add('contactAddressLat',HiddenType::class, array('label'=>'contact.phone','attr'=>array('class'=>'form-control')))
        ->add('contactAddressLng',HiddenType::class, array('label'=>'contact.phone','attr'=>array('class'=>'form-control')))
        ->add('contactAddressZoom',HiddenType::class, array('label'=>'contact.phone','attr'=>array('class'=>'form-control')))
        ->add('contactAddress',TextType::class, array('label'=>'contact.address','attr'=>array('class'=>'form-control')))
        ->add('contactEmail',EmailType::class, array('label'=>'contact.email','constraints' => array(new NotBlank(),new Email()),'attr'=>array('class'=>'form-control')))
        ->add('contactReplyEmail',TextareaType::class, array('label'=>'auto.reply','constraints' => array(new NotBlank()),'attr'=>array('class'=>'form-control','style'=>'height:150px;')))
        ->add('submit', SubmitType::class, array('label'=>'form.continue','attr'=>array('class'=>'btn btn-info pull-right')))
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
        return 'landing_step3';
    }

}
