<?php

namespace Apachecms\BackendBundle\Form\Business;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BusinessType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',TextType::class,array('label'=>'name','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')))
        ->add('submit', SubmitType::class, array('label'=>'form.save','attr'=>array('class'=>'btn btn-info pull-right')))
        ->add('brand',FileType::class,array('label'=>'brand.business','data_class'=>null,'label_attr'=>array('class'=>'control-label'),'attr'=>array(
            'class'=>'dropify','data-height'=>'300',
            'data-max-file-size'=>'2M',
            'data-allowed-file-extensions'=>'png jpg jpeg gif')))
        ->add('addressLat',HiddenType::class, array('label'=>'contact.phone','attr'=>array('class'=>'form-control')))
        ->add('addressLng',HiddenType::class, array('label'=>'contact.phone','attr'=>array('class'=>'form-control')))
        ->add('addressZoom',HiddenType::class, array('label'=>'contact.phone','attr'=>array('class'=>'form-control')))
        ->add('phone',TextType::class, array('label'=>'contact.phone','attr'=>array('class'=>'form-control')))
        ->add('replyEmail',TextareaType::class, array('label'=>'auto.reply','attr'=>array('class'=>'form-control','style'=>'height:150px;')))
        ->add('address',TextType::class, array('label'=>'contact.address','attr'=>array('class'=>'form-control')))
        ->add('email',EmailType::class, array('label'=>'contact.email','constraints' => array(new NotBlank(),new Email()),'attr'=>array('class'=>'form-control')))
        ->add('facebook',TextType::class,array('constraints' => array(new Url()),'attr'=>array('class'=>'form-control','placeholder'=>'https://...')))
        ->add('web',TextType::class,array('constraints' => array(new Url()),'attr'=>array('class'=>'form-control','placeholder'=>'https://...')))
        ->add('googlePlus',TextType::class,array('constraints' => array(new Url()),'label'=>'Google+','attr'=>array('class'=>'form-control','placeholder'=>'https://...')))
        ->add('twitter',TextType::class,array('constraints' => array(new Url()),'attr'=>array('class'=>'form-control','placeholder'=>'https://...')))
        ->add('youtube',TextType::class,array('constraints' => array(new Url()),'attr'=>array('class'=>'form-control','placeholder'=>'https://...')))
        ->add('linkedin',TextType::class,array('constraints' => array(new Url()),'attr'=>array('class'=>'form-control','placeholder'=>'https://...')))
        ->add('instagram',TextType::class,array('constraints' => array(new Url()),'attr'=>array('class'=>'form-control','placeholder'=>'https://...')))
        ->add('industry', EntityType::class, array(
            'label'=>'industry',
            'label_attr'=>array('class'=>'control-label'),
            'class' => 'ApachecmsBackendBundle:Industry',
            'choice_label' => 'name',
            'attr'=>array('class'=>'form-control'),
            'placeholder' => 'choice.industry',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('e')
                ->where('e.isDelete=0')
                ->orderBy('e.name', 'ASC');
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
            'data_class' => 'Apachecms\BackendBundle\Entity\Business'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apachecms_backendbundle_business';
    }


}
