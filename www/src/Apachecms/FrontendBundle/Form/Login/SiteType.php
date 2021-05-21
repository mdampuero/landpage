<?php

namespace Apachecms\FrontendBundle\Form\Login;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SiteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('site', EntityType::class, array(
            'label'=>'Empresa',
            'label_attr'=>array('class'=>'control-label'),
            'class' => 'ApachecmsBackendBundle:Site',
            'choice_label' => 'name',
            'attr'=>array('class'=>'form-control'),
            'placeholder' => '--Seleccione su empresa--',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('e')
                ->where('e.isDelete=0')
                ->orderBy('e.name', 'ASC');
            }
        ))
        ->add('accessCode',PasswordType::class,array(
            'constraints' => array(new NotBlank(),new Length(array('min'=>6,'max'=>100))),
            'label' => false,'attr'=>array('autocomplete'=>'new-password','class'=>'form-control','placeholder'=>'Código de acceso'
            )))
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
