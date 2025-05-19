<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipesRepository::class)]
class Recipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?User $id_user = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $instructions = null;

    #[ORM\Column(nullable: true)]
    private ?int $time_minutes = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $calories_cat = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $difficulty = null;

    #[ORM\Column(nullable: true)]
    private ?int $rating = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $modified_at = null;

    #[ORM\ManyToOne]
    private ?Category $category = null;

    #[ORM\ManyToOne]
    private ?Type $type = null;

    #[ORM\ManyToOne]
    private ?Allergens $allergen = null;

    /**
     * @var Collection<int, RecipeIngredients>
     */
    #[ORM\OneToMany(targetEntity: RecipeIngredients::class, mappedBy: 'recipe')]
    private Collection $recipeIngredients;

    /**
     * @var Collection<int, Meals>
     */
    #[ORM\OneToMany(targetEntity: Meals::class, mappedBy: 'recipe', cascade: ['persist'], orphanRemoval: true)]
    private Collection $meals;
    

    /**
     * @var Collection<int, Ingredient>
     * persist
     */
    #[ORM\OneToMany(targetEntity: Ingredient::class, mappedBy: 'recipe', cascade: ['persist', "remove"])]
    private Collection $ingredients;

    public function __construct()
    {
        $this->recipeIngredients = new ArrayCollection();
        $this->meals = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?user
    {
        return $this->id_user;
    }

    public function setIdUser(?user $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(?string $instructions): static
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function getTimeMinutes(): ?int
    {
        return $this->time_minutes;
    }

    public function setTimeMinutes(?int $time_minutes): static
    {
        $this->time_minutes = $time_minutes;

        return $this;
    }

    public function getCaloriesCat(): ?string
    {
        return $this->calories_cat;
    }

    public function setCaloriesCat(?string $calories_cat): static
    {
        $this->calories_cat = $calories_cat;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(?string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->modified_at;
    }

    public function setModifiedAt(\DateTimeImmutable $modified_at): static
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getType(): ?type
    {
        return $this->type;
    }

    public function setType(?type $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getAllergen(): ?allergens
    {
        return $this->allergen;
    }

    public function setAllergen(?allergens $allergen): static
    {
        $this->allergen = $allergen;

        return $this;
    }

    /**
     * @return Collection<int, RecipeIngredients>
     */
    public function getRecipeIngredients(): Collection
    {
        return $this->recipeIngredients;
    }

    public function addRecipeIngredient(RecipeIngredients $recipeIngredient): static
    {
        if (!$this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients->add($recipeIngredient);
            $recipeIngredient->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(RecipeIngredients $recipeIngredient): static
    {
        if ($this->recipeIngredients->removeElement($recipeIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeIngredient->getRecipe() === $this) {
                $recipeIngredient->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Meals>
     */
    public function getMeals(): Collection
    {
        return $this->meals;
    }

    public function addMeal(Meals $meal): static
    {
        if (!$this->meals->contains($meal)) {
            $this->meals->add($meal);
            $meal->setRecipe($this);
        }

        return $this;
    }

    public function removeMeal(Meals $meal): static
    {
        if ($this->meals->removeElement($meal)) {
            // set the owning side to null (unless already changed)
            if ($meal->getRecipe() === $this) {
                $meal->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipe() === $this) {
                $ingredient->setRecipe(null);
            }
        }

        return $this;
    }

    public function removeAllIngredients() {}
}
