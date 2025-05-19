<?php

namespace App\Service;

use App\Entity\Day;
use App\Entity\Recipes;
use App\Entity\User;
use App\Repository\DayRepository;
use Doctrine\ORM\EntityManagerInterface;

class StateService
{
    // 0 = nothing
    // 1 = add breakfast
    // 2 = add lunch
    // 3 = add dinner
    public int $state = 0;
    public Day $day;

    public function __construct(
        DayRepository $dayRepository,
        private EntityManagerInterface $entityManager,
    ) {}

    public function getState(): int
    {
        global $state;
        // $state = 12;
        return $state;
    }

    public function setState(int $newState)
    {
        global $state;
        $state = $newState;
    }

    public function setMeal(Recipes $recipe)
    {
        global $state, $day;

        switch ($state) {
            case 3:
                $day->dinner = $recipe;
                break;

            default:
                # code...
                break;
        }
    }

    public function setBreakfast(User $user, Recipes $recipe)
    {
        $day = $this->checkIfDayExists($user);

        $day->setBreakfast($recipe);
        $this->entityManager->flush();
    }
    public function hasBreakfast(User $user)
    {
        if ($user == null)
            return null;

        $day = $this->checkIfDayExists($user);
        return $day->getBreakfast();
    }


    public function setLunch(User $user, Recipes $recipe)
    {
        $day = $this->checkIfDayExists($user);

        $day->setLunch($recipe);
        $this->entityManager->flush();
    }
    public function hasLunch(User $user)
    {
        if ($user == null)
            return null;

        $day = $this->checkIfDayExists($user);
        return $day->getLunch();
    }

    public function setDinner(User $user, Recipes $recipe)
    {
        $day = $this->checkIfDayExists($user);

        $day->setDinner($recipe);
        $this->entityManager->flush();
    }
    public function hasDinner(User $user)
    {
        if ($user == null)
            return null;

        $day = $this->checkIfDayExists($user);
        return $day->getDinner();
    }
    private function checkIfDayExists(User $user): Day
    {
        global $day;
        if ($day == null) {
            // TODO
            $day = ($user->getDays())[0];

            if ($day == null) {
                $day = new Day();
                $day->setUser($user);
                $this->entityManager->persist($day);
                $this->entityManager->flush();
            }
        }
        return $day;
    }
}
