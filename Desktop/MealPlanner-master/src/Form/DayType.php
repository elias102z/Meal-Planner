<?php

namespace App\Form;

use App\Entity\Day;
use App\Entity\Recipes;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('breakfast', EntityType::class, [
                'class' => Recipes::class,
                'choice_label' => 'id',
            ])
            ->add('lunch', EntityType::class, [
                'class' => Recipes::class,
                'choice_label' => 'id',
            ])
            ->add('dinner', EntityType::class, [
                'class' => Recipes::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Day::class,
        ]);
    }
}
