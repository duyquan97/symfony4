<?php
namespace App\Form\EventListener;

use App\Entity\Rooms;
use App\Repository\RoomsRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Session\Session;

class OrderListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::SUBMIT => 'onSubmit',
        ];
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

}