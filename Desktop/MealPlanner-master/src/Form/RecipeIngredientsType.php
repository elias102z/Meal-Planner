<?php

namespace App\Form;

use App\Entity\Ingredients;
use App\Entity\RecipeIngredients;
use App\Entity\Recipes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;

class RecipeIngredientsType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ingredient', TextType::class)
            ->add('quantity')
->add('unit', ChoiceType::class, [
'choices' => [
'ml' => 'ml',
'gr' => 'gr',
'unit' => 'unit',
],
])
//->add('recipe', EntityType::class, [
// looks for choices from this entity
//'class' =>Recipes::class,
// uses the User.username property as the visible option string
//'choice_label' => 'title',
// used to render a select box, check boxes or radios
// 'multiple' => true,
// 'expanded' => true,
//])
        ;

        $builder->get('ingredient')
            ->addModelTransformer(new CallbackTransformer(
                function ($ingredient) {
                    return $ingredient ? $ingredient->getIngredient() : '';
                },
                function ($ingredientName) {
                    if (!$ingredientName) {
                        return null;
                    }
                    $ingredient = $this->entityManager->getRepository(Ingredients::class)->findOneBy(['ingredient' => $ingredientName]);
                    if (!$ingredient) {
                        $ingredient = new Ingredients();
                        $ingredient->setIngredient($ingredientName);
                        $this->entityManager->persist($ingredient);
                    }
                    return $ingredient;
                }
            ));
    }
}
