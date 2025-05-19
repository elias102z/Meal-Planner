<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddMeal extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('breakfast', SubmitType::class, [
                // 'attr' => ['class' => 'btn btn-green']
            ])
            ->add('lunch', SubmitType::class, [
                // 'attr' => ['class' => 'btn btn-green']
            ])
            ->add('dinner', SubmitType::class, [
                // 'attr' => ['class' => 'btn btn-green']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
