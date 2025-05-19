<?php

namespace App\Entity;

use App\Repository\ShoppingListRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ShoppingListRepository::class)]
class ShoppingList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'shoppingLists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'shoppingLists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ingredients $ingredient = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $ingredientName = null;

    #[ORM\Column(type: 'float')]
    private ?float $quantity = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $unit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getIngredient(): ?Ingredients
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredients $ingredient): self
    {
        $this->ingredient = $ingredient;
        $this->ingredientName = $ingredient ? $ingredient->getName() : null;

        return $this;
    }

    public function getIngredientName(): ?string
    {
        return $this->ingredientName;
    }

    public function setIngredientName(string $ingredientName): self
    {
        $this->ingredientName = $ingredientName;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }
}