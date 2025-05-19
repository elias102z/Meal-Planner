<?php

namespace App\Entity;

use App\Repository\RecipeIngredientsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeIngredientsRepository::class)]
class RecipeIngredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 30)]
    private ?string $unit = null;

    #[ORM\ManyToOne(inversedBy: 'recipeIngredients')]
    private ?Recipes $recipe = null;

    #[ORM\ManyToOne(inversedBy: 'recipeIngredients')]
    private ?Ingredients $ingredient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getRecipe(): ?recipes
    {
        return $this->recipe;
    }

    public function setRecipe(?recipes $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getIngredient(): ?ingredients
    {
        return $this->ingredient;
    }

    public function setIngredient(?ingredients $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }
}
