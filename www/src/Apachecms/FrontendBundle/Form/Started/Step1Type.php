<?php

namespace Apachecms\FrontendBundle\Form\Started;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class Step1Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('plan',EntityType::class, array(
            'constraints' => array(new NotBlank()),
            'label'=>'form.choose.subscription',
            'label_attr'=>array('class'=>'form-control'),
            'class' => 'ApachecmsBackendBundle:Plan',
            'choice_label' => 'name',
            'choice_translation_domain' => true,
            'attr'=>array('class'=>'form-control'),
            'placeholder' => 'form.choose.subscription',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('e')
                ->where('e.isDelete=0')
                ->orderBy('e.price', 'ASC');
            }
        ))
        ->add('submit', SubmitType::class, array('label'=>'form.continue','attr'=>array('class'=>'btn btn-info')))
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
        return '';
    }


}
