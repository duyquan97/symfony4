<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('keyWord',TextType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Search',
                ]
            ])
            ->add('type',ChoiceType::class,[
                'required' => false,
                'choices' => [
                    'VIP' => 'vip',
                    'NORMAL' => 'normal',
                ],
                'placeholder' => 'Choose',
            ])
            ->add('fromDate', DateType::class,[
                'required' => false,
                'label' => 'From',
                'widget' => 'single_text',
                'html5' => false,
                'input' => 'string'
            ])
            ->add('toDate',DateType::class,[
                'required' => false,
                'label' => 'To',
                'widget' => 'single_text',
                'html5' => false,
                'input' => 'string'
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
