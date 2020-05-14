<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Rooms;
use App\Repository\RoomsRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('code')
            ->add('name')
            ->add('email')
            ->add('phone')
            ->add('fromDate')
            ->add('toDate')
            ->add('price')
            ->add('currency')
            ->add('days')
            ->add('status',ChoiceType::class,[
                'choices'  => [
                    'On' => 'On',
                    'Off' => 'Off',
                ],
            ])
            ->add('accept',ChoiceType::class,[
                'choices'  => [
                    'On' => 'On',
                    'Off' => 'Off',
                ],
            ])
            ->add('currency')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
