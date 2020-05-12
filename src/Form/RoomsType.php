<?php

namespace App\Form;

use App\Entity\Rooms;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomsType extends AbstractType
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
            ->add('Description')
            ->add('image')
            ->add('status')
            ->add('featured')
            ->add('priceDays')
            ->add('weekend')
            ->add('holiday')
            ->add('discount')
            ->add('service')
            ->add('type')
            ->add('room_total')
            ->add('room_booked')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rooms::class,
        ]);
    }
}
