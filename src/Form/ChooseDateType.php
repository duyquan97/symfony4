<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChooseDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fromDate', DateType::class,[
                'label' => 'From Date',
                'widget' => 'single_text',
                'html5' => false,
                'input' => 'string',
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
                'input' => 'string',
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
            // Configure your form options here
        ]);
    }
}
