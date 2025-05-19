<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                "label" => "email",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            
            ->add('password', null, [
                "label" => "password",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('username', null, [
                "label" => "username",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])           
            ->add('first_name', null, [
                "label" => "first name",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('last_name', null, [
                "label" => "last name",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
