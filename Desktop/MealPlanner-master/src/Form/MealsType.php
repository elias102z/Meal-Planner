<?php

namespace App\Form;

use App\Entity\Meals;
use App\Entity\Recipes;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MealsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day')
            ->add('time', null, [
                'widget' => 'single_text',
            ])
            ->add('week_n')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('modified_at', null, [
                'widget' => 'single_text',
            ])
            ->add('user', EntityType::class, [
                'class' => user::class,
                'choice_label' => 'id',
            ])
            ->add('recipe', EntityType::class, [
                'class' => recipes::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Meals::class,
        ]);
    }
}
