<?php

namespace App\Controller;

use App\Entity\Meals;
use App\Form\MealsType;
use App\Repository\MealsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/meals')]
final class MealsController extends AbstractController
{
    #[Route(name: 'app_meals_index', methods: ['GET'])]
    public function index(MealsRepository $mealsRepository): Response
    {
        return $this->render('meals/index.html.twig', [
            'meals' => $mealsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_meals_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $meal = new Meals();
        $form = $this->createForm(MealsType::class, $meal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($meal);
            $entityManager->flush();

            return $this->redirectToRoute('app_meals_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('meals/new.html.twig', [
            'meal' => $meal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_meals_show', methods: ['GET'])]
    public function show(Meals $meal): Response
    {
        return $this->render('meals/show.html.twig', [
            'meal' => $meal,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_meals_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Meals $meal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MealsType::class, $meal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_meals_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('meals/edit.html.twig', [
            'meal' => $meal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_meals_delete', methods: ['POST'])]
    public function delete(Request $request, Meals $meal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$meal->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($meal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_meals_index', [], Response::HTTP_SEE_OTHER);
    }
}
