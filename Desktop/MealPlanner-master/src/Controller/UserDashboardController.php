<?php

namespace App\Controller;

use App\Repository\RecipesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserDashboardController extends AbstractController
{
    #[Route('/user/dashboard', name: 'app_user_dashboard')]
    public function index(RecipesRepository $recipesRepository): Response
    {
        $user = $this->getUser();
        $userId = $user->getId();
        // dd($userId);

        return $this->render('user_dashboard/index.html.twig', [
            // 'recipes' => $recipesRepository->findAll(),
            // 'recipes' => $recipesRepository->findBy(array('user' => $user)),
            'recipes' => $recipesRepository->findBy(array('id_user' => $userId)),
            // $repository->findBy(array('name' => 'Registration')

        ]);
    }
}
