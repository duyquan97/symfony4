<?php

namespace App\Form;

use App\Controller\BaseController;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Rooms;
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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrderType extends AbstractType
{
    private $roomsRepository;
    public function __construct(RoomsRepository $roomsRepository)
    {
        $this->roomsRepository = $roomsRepository;
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
                'attr' => [

                ],
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
            ->add('room',EntityType::class,[
                'class' => Rooms::class,
                'query_builder' => function (RoomsRepository $roomsRepository) {
                   return $roomsRepository->createQueryBuilder('r')
                       ->orderBy('r.id','DESC');
                },
                'choice_label' => 'name'
            ])
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
            ->add('days')

            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                [$this, 'onPreSetData']
            )
            ->addEventListener(
                FormEvents::SUBMIT,
                [$this, 'onSubmit']
            )
        ;
    }
    public function onPreSetData(FormEvent $event)
    {
        $order = $event->getData();
        $form = $event->getForm();


        if ($order->getId() != null) {
            $form
                ->add('status',ChoiceType::class,[
                    'choices' => [
                        'On' => 'On',
                        'Off' => 'Off',
                    ]
                ])
                ->add('accept',ChoiceType::class,[
                    'choices' => [
                        'Off' => 'Off',
                        'On' => 'On',
                    ]
                ])
            ;
        }
        else{
            $form->add('room',EntityType::class,[
                'class' => Rooms::class,
                'query_builder' => function (RoomsRepository $roomsRepository) {
                    $session = new Session();
                    $order = $session->get('order');
                    $id = '';
                    if (!empty($order)) {
                        $id = $order['room'];
                    }
                    return $roomsRepository->findById($id);
                },
                'choice_label' => 'name'
            ]);
        }
    }

    public function onSubmit(FormEvent $event) {
        $order = $event->getData();
        if ($order->getId() == null) {
            $code = strtoupper(uniqid());
            $order->setCode($code);
            $order->setStatus('On');
            $order->setAccept('Off');
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
