<?php

namespace App\Form;

use App\Entity\Rooms;

use App\Form\DataTransformer\TestTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RoomsType extends AbstractType
{
    private $transformer;

    public function __construct(TestTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'required' => false,
                'attr' =>[
                    'placeholder' => 'Import name ',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Name not blank!'
                    ]),
                ]

            ])
            ->add('province',ChoiceType::class,[
                'choices' => [
                    'Hà Nội'      => 'Hà Nội',
                    'Hồ Chí Minh' => 'Hồ Chí Minh',
                    'Đà Nẵng'     => 'Dà Nẵng',
                    'Nha Trang'   => 'Nha Trang',
                ],
                'placeholder' => 'Choose a province',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Province not blank!'
                    ]),
                ]
            ])
            ->add('district', null,[
                'attr' =>[
                    'placeholder' => 'Import district',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'District not blank!'
                    ]),
                ]
                ])
            ->add('street', null,[
                'attr' =>[
                    'placeholder' => 'Import street',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Street not blank!'
                    ]),
                ]
            ])
            ->add('shortDescription',null,[
                'attr' =>[
                    'placeholder' => 'Import short description',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Short Description not blank!'
                    ]),
                ]
            ])
            ->add('Description',null,[
                'attr' =>[
                    'placeholder' => 'Import description',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Description not blank!'
                    ]),
                ]
            ])
            ->add('image', FileType::class,[
                'data_class' => null,
                'required' => false,
                'mapped' => false
            ])

            ->add('price', null,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Price not blank!'
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'VND',
                ]
            ])
            ->add('weekend', TextType::class,[
                'attr' => [
                    'placeholder' => '%',
                ]
            ])
            ->add('holiday', TextType::class,[
                'attr' => [
                    'placeholder' => '%',
                ]
            ])
            ->add('discount', TextType::class,[
                'attr' => [
                    'placeholder' => '%',
                ]
            ])
            ->add(
                $builder->create('service',TextType::class)
                ->addModelTransformer(new CallbackTransformer(
                    function ($tagsAsArray) {
                        return implode(', ', $tagsAsArray);
                    },
                    function ($tagsAsString) {
                        return explode(', ', $tagsAsString);
                    }
                ))
            )
            ->add('type',ChoiceType::class,[
                'choices' => [
                    'Vip' => 'vip',
                    'Normal' => 'normal'
                ]
            ])
            ->add('people',null,[
                'attr' => [
                    'min' => 1,
                    'placeholder' => 'Maximum number of people',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'People not blank!'
                    ]),
                ]
            ])
            ->add('toilet',null,[
                'attr' => [
                    'min' => 1,
                    'placeholder' => 'Toilet',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Toilet not blank!'
                    ]),
                ]
            ])
            ->add('status', ChoiceType::class,[
                'choices' => [
                    'On'  => 'On',
                    'Off' => 'Off',
                ]
            ])
            ->add('featured', ChoiceType::class,[
                'choices' => [
                    'On'  => 'On',
                    'Off' => 'Off',
                ]
            ])
            ->add('user',UserType::class,[
                    'invalid_message' => 'This value is not valid',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rooms::class,
        ]);
    }
}
