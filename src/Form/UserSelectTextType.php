<?php
namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSelectTextType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tags', TextType::class)
            ->addModelTransformer(new CallbackTransformer(
                function ($tagsAsArray) {
                    return implode(', ', $tagsAsArray);
                },
                function ($tagsAsString) {
                    return explode(', ', $tagsAsString);
                }
            ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);

    }
}