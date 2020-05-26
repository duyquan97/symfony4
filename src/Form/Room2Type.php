<?php

namespace App\Form;

use App\Entity\Room2;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Room2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('province')
            ->add('district')
            ->add('street')
            ->add('shortDescription')
            ->add('description')
            ->add('image')
            ->add('type')
            ->add('status')
            ->add('featured')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Room2::class,
        ]);
    }
}
