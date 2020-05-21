<?php

namespace App\Form;

use App\Entity\Category;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\Cache\Persister\Collection\ReadOnlyCachedCollectionPersister;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class Category1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Choose a name category!'
                    ]),
                    new Length([
                        'max' => 255,
                        'min' => 5,
                        'maxMessage' => 'Come on, you can think of a name short than that!',
                        'minMessage' => 'Come on, you can think of a name longer than that!'
                    ])
                ]
            ])
            ->add('slug',null,[
                'attr' => array(
                    'readonly' => true,
                )
            ])
            ->add('description',TextareaType::class);
            $builder->get('name')
                ->addModelTransformer(new CallbackTransformer(
                    function ($nameAsArray) {
                        return implode(', ', $nameAsArray);
                    },
                    function ($nameAsString) {
                        return explode(', ', $nameAsString);
                    }
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
