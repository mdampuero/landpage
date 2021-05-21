<?php

namespace Apachecms\FrontendBundle\Form\Landing;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email',EmailType::class,array(
            'constraints' => array(new NotBlank(),new Email()),
            'label' => null,
            'attr'=>array('class'=>'form-control tooltipoff'
            )))
        ->add('name',TextType::class,array(
            'constraints' => array(new NotBlank()),
            'label' => null,
            'attr'=>array('class'=>'form-control tooltipoff'
            )))
        ->add('phone',TextType::class,array(
            'constraints' => array(new NotBlank()),
            'label' => null,
            'attr'=>array('class'=>'form-control tooltipoff'
            )))
        ->add('query',TextareaType::class,array(
            'constraints' => array(new NotBlank()),
            'label' => null,
            'attr'=>array('class'=>'form-control tooltipoff','style'=>''
            )))
        // ->add('business', EntityType::class, array(
        //         'label'=>'business',
        //         'label_attr'=>array('class'=>'control-label'),
        //         'class' => 'ApachecmsBackendBundle:LandingService',
        //         'choice_label' => 'title',
        //         'attr'=>array('class'=>'form-control'),
        //         'placeholder' => 'choice.business',
        //         'query_builder' => function (EntityRepository $er) {
        //             return $er->createQueryBuilder('e')
        //             ->where('e.isDelete=0')
        //             ->orderBy('e.title', 'ASC');
        //         }
        //     ))
        ->add('statsId',HiddenType::class,array('constraints' => array(new NotBlank())))
        ->add('testOptionId',HiddenType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
            'allow_extra_fields'=>true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'template_form_contact';
    }


}
