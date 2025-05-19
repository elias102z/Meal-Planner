<?php

namespace App\Controller;

use App\Entity\RecipeIngredients;
use App\Entity\ShoppingList;
use App\Form\ShoppingListType;
use App\Repository\DayRepository;
use App\Repository\IngredientRepository;
use App\Repository\RecipeIngredientsRepository;
use App\Repository\RecipesRepository;
use App\Repository\ShoppingListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/shopping/list')]
final class ShoppingListController extends AbstractController
{
    #[Route(name: 'app_shopping_list_index', methods: ['GET'])]
    public function index(RecipesRepository $rp, IngredientRepository $ir, DayRepository $dr): Response
    {

        $user = $this->getUser();
        $day = ($dr->findBy(array('user' => $user)))[0];


        $recipes = [];
        $ingredients = [];

        if ($day != null) {
            if ($day->getBreakfast() != null) {
                $recipes[] = $day->getBreakfast();
            }
            if ($day->getLunch() != null) {
                $recipes[] = $day->getLunch();
            }
            if ($day->getDinner() != null) {
                $recipes[] = $day->getDinner();
            }
        }

        foreach ($recipes as $index => $recipe) {
            $recipeIngredients = $ir->findBy(array('recipe' => $recipe));
            foreach ($recipeIngredients  as $key => $value) {
                $ingredients[] = $value;
            }
        }
        // dd($ingredients);
        return $this->render('shopping_list/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }

    #[Route('/new', name: 'app_shopping_list_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $shoppingList = new ShoppingList();
        $form = $this->createForm(ShoppingListType::class, $shoppingList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($shoppingList);
            $entityManager->flush();

            return $this->redirectToRoute('app_shopping_list_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('shopping_list/new.html.twig', [
            'shopping_list' => $shoppingList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_shopping_list_show', methods: ['GET'])]
    public function show(ShoppingList $shoppingList): Response
    {
        return $this->render('shopping_list/show.html.twig', [
            'shopping_list' => $shoppingList,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_shopping_list_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ShoppingList $shoppingList, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ShoppingListType::class, $shoppingList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_shopping_list_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('shopping_list/edit.html.twig', [
            'shopping_list' => $shoppingList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_shopping_list_delete', methods: ['POST'])]
    public function delete(Request $request, ShoppingList $shoppingList, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $shoppingList->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($shoppingList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_shopping_list_index', [], Response::HTTP_SEE_OTHER);
    }
}
