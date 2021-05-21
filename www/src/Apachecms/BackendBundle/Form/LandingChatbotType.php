<?php

namespace Apachecms\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class LandingChatbotType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('avatarName',TextType::class,array('constraints' => array(new NotBlank())))
        ->add('title',TextType::class,array('constraints' => array(new NotBlank())))
        ->add('colour',TextType::class,array('constraints' => array(new NotBlank())))
        ->add('labelButton',TextType::class,array('constraints' => array(new NotBlank())))
        ->add('welcome',TextType::class,array('constraints' => array(new NotBlank())))
        ->add('timeoutOpen',ChoiceType::class, array(
            'choices' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10',
                '11' => '11',
                '12' => '12',
                '13' => '13',
                '14' => '14',
                '15' => '15',
                '16' => '16'
                )))
                ->add('position',ChoiceType::class, array(
            'choices' => array(
                'left' => 'bottom-left',
                'center' => 'bottom-center',
                'right' => 'bottom-right'
            )))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\LandingChatbot'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_landingchatbot';
    }


}
