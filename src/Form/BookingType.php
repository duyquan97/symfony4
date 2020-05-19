<?php

namespace App\Form;

use App\Entity\Order;
use Carbon\Carbon;
use Faker\Provider\PhoneNumber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $now = strtotime(Carbon::now()->toDateString());

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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
