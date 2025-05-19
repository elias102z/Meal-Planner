<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('searchPhrase', null, [
                'attr' => ['class' => 'form-control form-control-100'],
                'label' => false,
            ])
            ->add('searchBtn', SubmitType::class, [
                'attr' => ['class' => 'btn btn-green'],
                'label' => 'Search'
            ])
        ;
    }
    // ->add('resetBtn', SubmitType::class, [
    //     'attr' => ['class' => 'btn btn-green']
    // ])

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
