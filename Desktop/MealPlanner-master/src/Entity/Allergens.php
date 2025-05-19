<?php

namespace App\Entity;

use App\Repository\AllergensRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllergensRepository::class)]
class Allergens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $allergen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAllergen(): ?string
    {
        return $this->allergen;
    }

    public function setAllergen(string $allergen): static
    {
        $this->allergen = $allergen;

        return $this;
    }
}
