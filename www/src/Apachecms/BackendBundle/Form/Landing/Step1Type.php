<?php

namespace Apachecms\BackendBundle\Form\Landing;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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

class Step1Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->user=$options['user'];
        // dump($options);
        // exit();
        $builder
        // ->add('name',TextType::class,array('label'=>'name.business','constraints' => array(new NotBlank()), 'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        // ->add('brand',FileType::class,array('label'=>'brand.business','data_class'=>null,'label_attr'=>array('class'=>'control-label'),'attr'=>array(
        //     'class'=>'dropify','data-height'=>'300',
        //     'data-max-file-size'=>'2M',
        //     'data-allowed-file-extensions'=>'png jpg jpeg gif')))
        ->add('business', EntityType::class, array(
            'label'=>'landing.business',
            'label_attr'=>array('class'=>'control-label'),
            'class' => 'ApachecmsBackendBundle:Business',
            'choice_label' => 'name',
            'attr'=>array('class'=>'form-control'),
            'placeholder' => 'choice.business',
            'query_builder' => function (EntityRepository $er) {
                $qb = $er->createQueryBuilder('e');
                $choices=$qb->where('e.isDelete=0')
                ->andWhere('e.customer = :customer')->setParameter('customer',$this->user)
                ->orderBy('e.name', 'ASC');
                return $choices;
            }
        ))
        ->add('title',TextType::class,array('label'=>'title','constraints' => array(new NotBlank()), 'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        // ->add('title_1',TextType::class,array('label'=>'title_1', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        // ->add('title_2',TextType::class,array('label'=>'title_2', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('isActiveAi',CheckboxType::class, array('label'=>'yes_no','attr'=>array('class'=>'switch')))
        ->add('description',TextareaType::class,array('label'=>'description.long', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('style'=>'height:200px','class'=>'form-control')))
        ->add('description_1',TextType::class,array('label'=>'description_1', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','maxlength'=>70)))
        ->add('description_2',TextType::class,array('label'=>'description_2', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','maxlength'=>70)))
        ->add('description_3',TextType::class,array('label'=>'description_3', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','maxlength'=>70)))
        ->add('description_4',TextType::class,array('label'=>'description_4', 'label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','maxlength'=>70)))
        ->add('submit', SubmitType::class, array('label'=>'form.continue','attr'=>array('class'=>'btn btn-info pull-right')))
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Apachecms\BackendBundle\Entity\Landing'
        ));
        $resolver->setRequired('user');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'landing_step1';
    }

}
