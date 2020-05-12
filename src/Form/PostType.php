<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('content')
            ->add('author')
            ->add('tags', EntityType::class, [
                'required' => false,
                'multiple' => true,
                'class' => Tag::class,
                'choice_label' => function(Tag $category) {
                    return sprintf(' %s', $category->getName());
                },
                'placeholder' => 'Choose an author',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
