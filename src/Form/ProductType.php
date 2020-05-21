<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Common\Collections\Selectable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\File\File;

class ProductType extends AbstractType
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,[
                'attr' =>[
                    'placeholder' => 'Import name product',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Import name product!'
                    ]),
                ]
            ])
            ->add('slug',null,[
                'attr'=>[
                    'readonly'=>true
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => function(Category $category) {
                    return sprintf(' %s', $category->getName());
                },
                'placeholder' => 'Choose an category',

            ])

//            ->add('category', ChoiceType::class, [
//                'placeholder' => 'Choose an category',
//                'choices' => [
//                    $this->categoryRepository->sort()
//                ],
//
//            ])


            ->add('image',FileType::class,[
                'data_class' => null,
                'required' => false,
                'mapped' => false
            ])
            ->add('description',TextareaType::class,[
                'attr' =>[
                    'placeholder' => 'Import description product',
                ],
            ])
            ->add('producer',null,[
                'attr' =>[
                    'placeholder' => 'Import producer product',
                ],
            ])
            ->add('price',NumberType::class,[
                'attr' =>[
                    'placeholder' => 'Import price product',
                ],
                'help' => 'VNĐ',

                'constraints' => [
                    new NotBlank([
                        'message' => 'Import price product!'
                    ]),
                ]
            ])
            ->add('discount',null,[
                'attr' =>[
                    'placeholder' => 'Import discount product',
                ],
                'help' => '%',
            ])
            ->add('price_discount',null,[
                'help' => 'VNĐ',
                'attr'=>[
                    'readonly' => true,
                ]
            ])
            ->add('status',ChoiceType::class,array(
                'choices'  => [
                    'Yes' => '1',
                    'No' => '0',
                ],
            ))
            ->add('featured',ChoiceType::class,[
                'choices' => [
                    'Yes' => '1',
                    'No' => '0',
                ],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
