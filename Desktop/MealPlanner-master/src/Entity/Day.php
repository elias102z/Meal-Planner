<?php

namespace App\Entity;

use App\Repository\DayRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DayRepository::class)]
class Day
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\ManyToOne(inversedBy: 'days')]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    private ?Recipes $breakfast = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    private ?Recipes $lunch = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    private ?Recipes $dinner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getBreakfast(): ?Recipes
    {
        return $this->breakfast;
    }

    public function setBreakfast(?Recipes $breakfast): static
    {
        $this->breakfast = $breakfast;

        return $this;
    }

    public function getLunch(): ?Recipes
    {
        return $this->lunch;
    }

    public function setLunch(?Recipes $lunch): static
    {
        $this->lunch = $lunch;

        return $this;
    }

    public function getDinner(): ?Recipes
    {
        return $this->dinner;
    }

    public function setDinner(?Recipes $dinner): static
    {
        $this->dinner = $dinner;

        return $this;
    }
}
