<?php

namespace eJobsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class JobType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titluJob', null, array(
                'required' => true,
            ))
            ->add('city', EntityType::class, array(
                'class' => 'eJobsBundle\Entity\Oras',
                'label' => 'City',
                'required' => true,
                'choice_label' => 'city_name',
            ))
            ->add('dataPublicarii', null, array(
                'required' => true,
            ))
            ->add('esteActiv', null, array(
                'required' => false,
            ))
            ->add('descriere', null, array(
                'required' => true,
                'attr' => array('rows' => 20),
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'eJobsBundle\Entity\Job'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ejobsbundle_job';
    }


}
