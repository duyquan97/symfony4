<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
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
            ->add('brochure', FileType::class, [
                'label' => 'Brochure (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
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
