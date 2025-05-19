<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recipes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('info', null, [
                "label" => "Ingredient and amount of ingredient",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ]);
    }
    // ->add('recipe', EntityType::class, [
    //     'class' => Recipes::class,
    //     'choice_label' => 'id',
    // ])
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
