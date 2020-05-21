<?php

namespace App\Form;

use App\Controller\BaseController;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Rooms;
use App\Form\DataTransformer\RoomSelectTransformer;
use App\Form\EventListener\OrderListener;
use App\Repository\RoomsRepository;
use App\Service\BookingHelper;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class OrderType extends AbstractType
{
    private $roomSelectTransformer;
    public function __construct(RoomSelectTransformer $roomSelectTransformer)
    {
        $this->roomSelectTransformer = $roomSelectTransformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add('name',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Name not blank!'
                    ]),
                ]
            ])
            ->add('email',EmailType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Email not blank!'
                    ]),
                ]
            ])
            ->add('phone',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Phone not blank!'
                    ]),
                    new Length([
                        'min' => 10,
                        'max' => 12,
                        'minMessage' => 'Phone number of at least 10 characters!',
                        'maxMessage' => 'Phone number must not exceed 12 characters!'
                    ])
                ]
            ])
            ->add(
                $builder->create('room',TextType::class,[
                        'invalid_message' => 'That is not a valid room number',])
                        ->addModelTransformer($this->roomSelectTransformer))

            ->add('fromDate', DateType::class,[
                'label' => 'From Date',
                'widget' => 'single_text',
                'html5' => false,

                'constraints' => [
                    new NotBlank([
                        'message' => 'Email not blank!'
                    ]),
                ]
            ])
            ->add('toDate',DateType::class,[
                'label' => 'To Date',
                'widget' => 'single_text',
                'html5' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Email not blank!'
                    ]),

                ]
            ])
            ->add('price')
            ->add('currency',TextType::class,[

            ])
            ->add('days',null,[
                'constraints' => [
                    new Type([
                        'type' => 'integer',
                        'message' => 'The value {{ value }} is not a valid {{ type }}'
                    ])
                ]
            ])
            ->addEventSubscriber(new OrderListener())
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
