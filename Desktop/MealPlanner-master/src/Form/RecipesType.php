<?php

namespace App\Form;

use App\Entity\Allergens;
use App\Entity\category;
use App\Entity\Recipes;
use App\Entity\type;
use App\Entity\User;
use Proxies\__CG__\App\Entity\Category as EntityCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;


class RecipesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                "label" => "TITLE",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('image', FileType::class, [
                'label' => 'Image (file)',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control'],

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '2024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid Image file',
                    ])
                ],
            ])
            ->add('description', null, [
                "label" => "Description",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])

            ->add('instructions', null, [
                "label" => "Instructions",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('time_minutes', null, [
                "label" => "Time needed in minutes",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('calories_cat',  ChoiceType::class, [
                'label' => 'Calories Category',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    'High' => 'High',
                    'Medium' => 'Medium',
                    'Low' => 'Low',


                ],
                'placeholder' => 'Select a calories category',
            ])
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Difficulty',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    'High' => 'High',
                    'Medium' => 'Medium',
                    'Low' => 'Low',


                ],
                'placeholder' => 'Select a difficulty level',
            ])
            ->add('rating', null, [
                "label" => "Rating",
                "label_attr" => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    'Approved' => 'Approved',
                    'Refused' => 'Refused',


                ],
                'placeholder' => 'Select a status',
            ])
            // ->add('created_at', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('modified_at', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('id_user', EntityType::class, [
            //     'class' => user::class,
            //     'choice_label' => 'id',
            // ])

            ->add('category', EntityType::class, [
                'label' => 'Category',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control'],
                'class' => Category::class,
                'choice_label' => 'category_name',
                'required' => false,
                'placeholder' => 'Select a category',
            ])

            ->add('type', EntityType::class, [
                'label' => 'Type',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control'],
                // looks for choices from this entity
                'class' => Type::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'type',
                'required' => false,
                'placeholder' => 'Select a type',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])


            ->add('allergen', EntityType::class, [
                'label' => 'Allergens',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control'],
                // looks for choices from this entity
                'class' => Allergens::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'allergen',
                'required' => false,
                'placeholder' => 'Select an allergen',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('ingredients', CollectionType::class, [
                'entry_type' => IngredientType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}
