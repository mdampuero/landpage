<?php

namespace Apachecms\BackendBundle\Form\Customer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CustomerExtraType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName',TextType::class,array('label'=>'form.name','constraints' => array(new NotBlank()),'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'form.name')))
        ->add('lastName',TextType::class,array('label'=>'form.last.name','constraints' => array(new NotBlank()),'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('phone',TextType::class,array('label'=>'phone','constraints' => array(new NotBlank()),'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('document',TextType::class,array('label'=>'document','constraints' => array(new NotBlank()),'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('businessName',TextType::class,array('label'=>'business.name','constraints' => array(new NotBlank()),'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('businessCuit',TextType::class,array('label'=>'business.cuit','constraints' => array(new NotBlank()),'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('businessAddress',TextType::class,array('label'=>'business.address','constraints' => array(new NotBlank()),'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('acceptTermsAndConditions',CheckboxType::class, array('constraints' => array(new NotBlank()),'label'=>'accept.terms.and.conditions.me','attr'=>array('class'=>'form-check-input')))
        ->add('submit', SubmitType::class, array('label'=>'continue','attr'=>array('class'=>'btn btn-info')))
        ->add('country', EntityType::class, array(
            'label'=>'country',
            'constraints' => array(new NotBlank()),
            'label_attr'=>array('class'=>'control-label'),
            'class' => 'ApachecmsBackendBundle:Country',
            'choice_label' => 'name',
            'attr'=>array('class'=>'form-control'),
            'placeholder' => 'choice.country',
            'query_builder' => function (EntityRepository $er) {
                $qb = $er->createQueryBuilder('e');
                $choices=$qb->where('e.isDelete=0')
                ->orderBy('e.name', 'ASC');
                return $choices;
            }
        ))
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\Customer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_customer';
    }


}
