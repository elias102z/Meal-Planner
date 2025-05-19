<?php

namespace App\Controller;

use App\Entity\Day;
use App\Form\AddBreakfast;
use App\Form\AddDinner;
use App\Form\AddLunch;
use App\Form\DayType;
use App\Form\RemoveBreakfast;
use App\Form\RemoveDinner;
use App\Form\RemoveLunch;
use App\Repository\DayRepository;
use App\Service\StateService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user/day')]
final class DayController extends AbstractController
{
    #[Route(name: 'app_day_index', methods: ['GET', 'POST'])]
    public function index(StateService $stateService, Request $request, DayRepository $dayRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        // Create new day if there are no safed days
        //TODO: refactor to service
        $days = $dayRepository->findBy(array('user' => $user));
        if (count($days) === 0) {
            $day = new Day();
            $day->setUser($user);
            $entityManager->persist($day);
            $entityManager->flush();
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        } else {
            $day = $days[0];
        }



        // breakfast
        $form_removeBreakfast = $this->createForm(RemoveBreakfast::class);
        $form_removeBreakfast->handleRequest($request);
        if ($form_removeBreakfast->isSubmitted()) {
            $day->setBreakfast(null);
            $entityManager->flush();
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }
        $form_addBreakfast = $this->createForm(AddBreakfast::class);
        $form_addBreakfast->handleRequest($request);
        if ($form_addBreakfast->isSubmitted()) {
            $stateService->state = 1;
            $stateService->day = $day;
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }
        // lunch
        $form_removeLunch = $this->createForm(RemoveLunch::class);
        $form_removeLunch->handleRequest($request);
        if ($form_removeLunch->isSubmitted()) {
            $day->setLunch(null);
            $entityManager->flush();
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }
        $form_addLunch = $this->createForm(AddLunch::class);
        $form_addLunch->handleRequest($request);
        if ($form_addLunch->isSubmitted()) {
            $stateService->state = 3;
            $stateService->day = $day;
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }
        // dinner
        $form_removeDinner = $this->createForm(RemoveDinner::class);
        $form_removeDinner->handleRequest($request);
        if ($form_removeDinner->isSubmitted()) {
            $day->setDinner(null);
            $entityManager->flush();
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }
        $form_addDinner = $this->createForm(AddDinner::class);
        $form_addDinner->handleRequest($request);
        if ($form_addDinner->isSubmitted()) {
            $stateService->state = 3;
            $stateService->day = $day;
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }



        return $this->render('day/index.html.twig', [
            'days' => $days,
            'form_addBreakfast' => $form_addBreakfast,
            'form_removeBreakfast' => $form_removeBreakfast,
            'form_addLunch' => $form_addLunch,
            'form_removeLunch' => $form_removeLunch,
            'form_addDinner' => $form_addDinner,
            'form_removeDinner' => $form_removeDinner,
            // 'days' => $dayRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_day_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $day = new Day();
        $form = $this->createForm(DayType::class, $day);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($day);
            $entityManager->flush();

            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('day/new.html.twig', [
            'day' => $day,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_day_show', methods: ['GET'])]
    public function show(Day $day): Response
    {
        return $this->render('day/show.html.twig', [
            'day' => $day,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_day_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Day $day, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DayType::class, $day);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd("edit");
            $entityManager->flush();
            return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('day/edit.html.twig', [
            'day' => $day,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_day_delete', methods: ['POST'])]
    public function delete(Request $request, Day $day, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $day->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($day);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_day_index', [], Response::HTTP_SEE_OTHER);
    }
}
