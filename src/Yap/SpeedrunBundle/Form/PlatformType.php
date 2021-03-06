<?php

namespace Yap\SpeedrunBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlatformType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',       'text', array('label' => 'Name'))
            ->add('description',    'textarea',  array('label' => 'Description'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Yap\SpeedrunBundle\Entity\Platform'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'yap_speedrunbundle_platform';
    }
}
