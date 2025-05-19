<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Ingredients;
use App\Entity\RecipeIngredients;
use App\Entity\Recipes;
use App\Form\AddDinner;
use App\Form\AddMeal;
use App\Form\IngredientType;
use App\Form\RecipeIngredientsType;
use App\Form\RecipesType;
use App\Form\SearchForm;
use App\Repository\RecipesRepository;
use App\Service\StateService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\FileUploader;


// RECIPES
#[Route('/recipes')]
final class RecipesController extends AbstractController
{
    #[Route(name: 'app_recipes_index', methods: ['GET', 'POST'])]
    public function index(Request $request, RecipesRepository $recipesRepository, EntityManagerInterface $em): Response
    {
        $isSearched = false;

        $form = $this->createForm(SearchForm::class);
        // $form->remove('resetBtn');

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $search_phrase = $form->get('searchPhrase')->getData();
            if ($search_phrase == null) {
                return $this->redirectToRoute('app_recipes_index');
            }
            return $this->redirectToRoute('app_recipes_search', ["search_phrase" => $search_phrase]);
        }

        $recipes = $recipesRepository->findAll();

        // dd($isSearched);
        return $this->render('recipes/index.html.twig', [
            'recipes' => $recipes,
            'form' => $form,
            'isSearched' => $isSearched,
        ]);
    }

    // RECIPES search
    #[Route('/search/{search_phrase}', name: 'app_recipes_search', methods: ['GET', 'POST'])]
    public function search($search_phrase, Request $request, RecipesRepository $recipesRepository, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SearchForm::class);
        $form->handleRequest($request);
        $isSearched = true;
        if ($form->isSubmitted()) {
            $search_phrase = $form->get('searchPhrase')->getData();
            if ($search_phrase == null) {
                // dd("null");
                return $this->redirectToRoute('app_recipes_index');
            }
            $recipes = $recipesRepository->customFind($search_phrase);
            return $this->redirectToRoute('app_recipes_search', ["search_phrase" => $search_phrase]);
        }

        $recipes = $recipesRepository->customFind($search_phrase);


        return $this->render('recipes/index.html.twig', [
            'recipes' => $recipes,
            'form' => $form,
            'isSearched' => $isSearched,
        ]);
    }

    // NEW
    #[Route('/user/new', name: 'app_recipes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $recipe = new Recipes();

        $user = $this->getUser();
        $userId = $user->getId();
        $recipe->setIdUser($user);

        $form = $this->createForm(RecipesType::class, $recipe);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $pictureFile = $form->get('image')->getData();
            if ($pictureFile) {
                $pictureFileName = $fileUploader->upload($pictureFile);
                $recipe->setImage($pictureFileName);
            }

            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipes/new.html.twig', [
            'form' => $form,
        ]);
    }

    // RECIPE SHOW
    #[Route('/{id}', name: 'app_recipes_show', methods: ['GET', 'POST'])]
    public function show(Recipes $recipe, Request $request, StateService $stateService): Response
    {
        $ingredients = $recipe->getIngredients();

        $user = $this->getUser();
        if ($user == null) {
            $hasBreakfast = null;
            $hasLunch = null;
            $hasDinner = null;
        } else {

            $hasBreakfast = $stateService->hasBreakfast($user);
            $hasLunch = $stateService->hasLunch($user);
            $hasDinner = $stateService->hasDinner($user);
        }

        $form = $this->createForm(AddMeal::class, $recipe);
        $form->handleRequest($request);
        if ($form->get('breakfast')->isClicked()) {
            // dd("breakfast");
            $stateService->setBreakfast($user, $recipe);
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }
        if ($form->get('lunch')->isClicked()) {
            // dd("lunch");
            $stateService->setLunch($user, $recipe);
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }
        if ($form->get('dinner')->isClicked()) {
            // dd("dinner");
            $stateService->setDinner($user, $recipe);
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipes/show.html.twig', [
            'recipe' => $recipe,
            'ingredients' => $ingredients,
            'form' => $form,
            'hasBreakfast' => $hasBreakfast,
            'hasLunch' => $hasLunch,
            'hasDinner' => $hasDinner,
        ]);
    }

    // EDIT
    #[Route('/{id}/edit', name: 'app_recipes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recipes $recipe, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(RecipesType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pictureFile = $form->get('image')->getData();

            if ($pictureFile) {
                $pictureFileName = $fileUploader->upload($pictureFile);
                $recipe->setImage($pictureFileName);
            }
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_dashboard', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('recipes/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);
    }


    #[Route('/delete/{id}', name: 'app_recipes_delete', methods: ['POST'])]
    public function delete(Request $request, Recipes $recipe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $recipe->getId(), $request->request->get('_token'))) {
            // Remove associated meals or update them to null
            foreach ($recipe->getMeals() as $meal) {
                $meal->setRecipe(null);
                $entityManager->persist($meal);
            }

            $entityManager->remove($recipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_dashboard', [], Response::HTTP_SEE_OTHER);
    }
}
