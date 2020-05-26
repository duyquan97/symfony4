<?php

namespace App\Form;

use App\Entity\RoomDate;
use App\Form\DataTransformer\Room2SelectTransformer;
use App\Form\DataTransformer\RoomSelectTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RoomDateType extends AbstractType
{
    private $room2SelectTransformer;
    public function __construct(Room2SelectTransformer $room2SelectTransformer)
    {
        $this->room2SelectTransformer = $room2SelectTransformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('price')
            ->add('discount')
            ->add('roomCount')
            ->add('roomBooked')
            ->add(
                $builder->create('roomId',TextType::class,[
                        'invalid_message' => 'That is not a valid room number',])
                        ->addModelTransformer($this->room2SelectTransformer)
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RoomDate::class,
        ]);
    }
}
