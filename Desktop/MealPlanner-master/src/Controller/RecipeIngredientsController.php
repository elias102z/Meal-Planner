<?php

namespace App\Controller;

use App\Entity\Ingredients;
use App\Entity\RecipeIngredients;
use App\Form\RecipeIngredientsType;
use App\Repository\RecipeIngredientsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/recipe/ingredients')]
final class RecipeIngredientsController extends AbstractController{
    #[Route(name: 'app_recipe_ingredients_index', methods: ['GET'])]
    public function index(RecipeIngredientsRepository $recipeIngredientsRepository): Response
    {
        return $this->render('recipe_ingredients/index.html.twig', [
            'recipe_ingredients' => $recipeIngredientsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_recipe_ingredients_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $recipeIngredient = new RecipeIngredients();
    $form = $this->createForm(RecipeIngredientsType::class, $recipeIngredient);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Get the ingredient name from the form
        $ingredientName = $form->get('ingredient')->getData();

        // Check if an ingredient with this name already exists
        $ingredient = $entityManager->getRepository(Ingredients::class)->findOneBy(['ingredient' => $ingredientName]);

        // If it doesn't exist, create a new Ingredients entity
        if (!$ingredient) {
            $ingredient = new Ingredients();
            $ingredient->setIngredient($ingredientName);
            $entityManager->persist($ingredient);
        }

        // Set the ingredient for the recipe ingredient
        $recipeIngredient->setIngredient($ingredient);

        // Persist the recipe ingredient
        $entityManager->persist($recipeIngredient);
        $entityManager->flush();

        return $this->redirectToRoute('app_recipe_ingredients_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('recipe_ingredients/new.html.twig', [
        'recipe_ingredient' => $recipeIngredient,
        'form' => $form,
    ]);
}
    #[Route('/{id}', name: 'app_recipe_ingredients_show', methods: ['GET'])]
    public function show(RecipeIngredients $recipeIngredient): Response
    {
        return $this->render('recipe_ingredients/show.html.twig', [
            'recipe_ingredient' => $recipeIngredient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recipe_ingredients_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RecipeIngredients $recipeIngredient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecipeIngredientsType::class, $recipeIngredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_recipe_ingredients_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipe_ingredients/edit.html.twig', [
            'recipe_ingredient' => $recipeIngredient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recipe_ingredients_delete', methods: ['POST'])]
    public function delete(Request $request, RecipeIngredients $recipeIngredient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipeIngredient->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($recipeIngredient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_recipe_ingredients_index', [], Response::HTTP_SEE_OTHER);
    }
}
