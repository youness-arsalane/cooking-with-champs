<?php

namespace App\Adapters\Models;

use JsonSerializable;

class SpoonacularRecipe extends SpoonacularModel implements JsonSerializable
{
    /* @var $vegetarian boolean */
    private $vegetarian;

    /* @var $vegan boolean */
    private $vegan;

    /* @var $glutenFree boolean */
    private $glutenFree;

    /* @var $dairyFree boolean */
    private $dairyFree;

    /* @var $veryHealthy boolean */
    private $veryHealthy;

    /* @var $cheap boolean */
    private $cheap;

    /* @var $veryPopular boolean */
    private $veryPopular;

    /* @var $sustainable boolean */
    private $sustainable;

    /* @var $lowFodmap boolean */
    private $lowFodmap;

    /* @var $weightWatcherSmartPoints int */
    private $weightWatcherSmartPoints;

    /* @var $gaps string */
    private $gaps;

    /* @var $preparationMinutes int */
    private $preparationMinutes;

    /* @var $cookingMinutes int */
    private $cookingMinutes;

    /* @var $aggregateLikes int */
    private $aggregateLikes;

    /* @var $healthScore int */
    private $healthScore;

    /* @var $creditsText ?string */
    private $creditsText;

    /* @var $license string */
    private $license;

    /* @var $sourceName string */
    private $sourceName;

    /* @var $pricePerServing float */
    private $pricePerServing;

    /* @var $extendedIngredients array */
    private $extendedIngredients;

    /* @var $id int */
    private $id;

    /* @var $title string */
    private $title;

    /* @var $readyInMinutes int */
    private $readyInMinutes;

    /* @var $servings int */
    private $servings;

    /* @var $sourceUrl string */
    private $sourceUrl;

    /* @var $openLicense int */
    private $openLicense;

    /* @var $image string */
    private $image;

    /* @var $imageType string */
    private $imageType;

    /* @var $summary string */
    private $summary;

    /* @var $cuisines array */
    private $cuisines;

    /* @var $dishTypes array */
    private $dishTypes;

    /* @var $diets array */
    private $diets;

    /* @var $occasions array */
    private $occasions;

    /* @var $instructions string */
    private $instructions;

    /* @var $instructions array */
    private $analyzedInstructions;

    /* @var $originalId ?int */
    private $originalId;

    /* @var $spoonacularSourceUrl string */
    private $spoonacularSourceUrl;

    public function __construct(array $data = [])
    {
        $this->populateByData($data);
    }

    public function isVegetarian(): bool
    {
        return $this->vegetarian;
    }

    public function setVegetarian(bool $vegetarian): void
    {
        $this->vegetarian = $vegetarian;
    }

    public function isVegan(): bool
    {
        return $this->vegan;
    }

    public function setVegan(bool $vegan): void
    {
        $this->vegan = $vegan;
    }

    public function isGlutenFree(): bool
    {
        return $this->glutenFree;
    }

    public function setGlutenFree(bool $glutenFree): void
    {
        $this->glutenFree = $glutenFree;
    }

    public function isDairyFree(): bool
    {
        return $this->dairyFree;
    }

    public function setDairyFree(bool $dairyFree): void
    {
        $this->dairyFree = $dairyFree;
    }

    public function isVeryHealthy(): bool
    {
        return $this->veryHealthy;
    }

    public function setVeryHealthy(bool $veryHealthy): void
    {
        $this->veryHealthy = $veryHealthy;
    }

    public function isCheap(): bool
    {
        return $this->cheap;
    }

    public function setCheap(bool $cheap): void
    {
        $this->cheap = $cheap;
    }

    public function isVeryPopular(): bool
    {
        return $this->veryPopular;
    }

    public function setVeryPopular(bool $veryPopular): void
    {
        $this->veryPopular = $veryPopular;
    }

    public function isSustainable(): bool
    {
        return $this->sustainable;
    }

    public function setSustainable(bool $sustainable): void
    {
        $this->sustainable = $sustainable;
    }

    public function isLowFodmap(): bool
    {
        return $this->lowFodmap;
    }

    public function setLowFodmap(bool $lowFodmap): void
    {
        $this->lowFodmap = $lowFodmap;
    }

    public function getWeightWatcherSmartPoints(): int
    {
        return $this->weightWatcherSmartPoints;
    }

    public function setWeightWatcherSmartPoints(int $weightWatcherSmartPoints): void
    {
        $this->weightWatcherSmartPoints = $weightWatcherSmartPoints;
    }

    public function getGaps(): string
    {
        return $this->gaps;
    }

    public function setGaps(string $gaps): void
    {
        $this->gaps = $gaps;
    }

    public function getPreparationMinutes(): int
    {
        return $this->preparationMinutes;
    }

    public function setPreparationMinutes(int $preparationMinutes): void
    {
        $this->preparationMinutes = $preparationMinutes;
    }

    public function getCookingMinutes(): int
    {
        return $this->cookingMinutes;
    }

    public function setCookingMinutes(int $cookingMinutes): void
    {
        $this->cookingMinutes = $cookingMinutes;
    }

    public function getAggregateLikes(): int
    {
        return $this->aggregateLikes;
    }

    public function setAggregateLikes(int $aggregateLikes): void
    {
        $this->aggregateLikes = $aggregateLikes;
    }

    public function getHealthScore(): int
    {
        return $this->healthScore;
    }

    public function setHealthScore(int $healthScore): void
    {
        $this->healthScore = $healthScore;
    }

    public function getCreditsText(): ?string
    {
        return $this->creditsText;
    }

    public function setCreditsText(?string $creditsText): void
    {
        $this->creditsText = $creditsText;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(?string $license): void
    {
        $this->license = $license;
    }

    public function getSourceName(): ?string
    {
        return $this->sourceName;
    }

    public function setSourceName(?string $sourceName): void
    {
        $this->sourceName = $sourceName;
    }

    public function getPricePerServing(): float
    {
        return $this->pricePerServing;
    }

    public function setPricePerServing(float $pricePerServing): void
    {
        $this->pricePerServing = $pricePerServing;
    }

    public function getExtendedIngredients(): array
    {
        return $this->extendedIngredients;
    }

    public function setExtendedIngredients(array $extendedIngredients): void
    {
        $this->extendedIngredients = $extendedIngredients;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getReadyInMinutes(): int
    {
        return $this->readyInMinutes;
    }

    public function setReadyInMinutes(int $readyInMinutes): void
    {
        $this->readyInMinutes = $readyInMinutes;
    }

    public function getServings(): int
    {
        return $this->servings;
    }

    public function setServings(int $servings): void
    {
        $this->servings = $servings;
    }

    public function getSourceUrl(): string
    {
        return $this->sourceUrl;
    }

    public function setSourceUrl(string $sourceUrl): void
    {
        $this->sourceUrl = $sourceUrl;
    }

    public function getOpenLicense(): int
    {
        return $this->openLicense;
    }

    public function setOpenLicense(int $openLicense): void
    {
        $this->openLicense = $openLicense;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getImageType(): string
    {
        return $this->imageType;
    }

    public function setImageType(string $imageType): void
    {
        $this->imageType = $imageType;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    public function getCuisines(): array
    {
        return $this->cuisines;
    }

    public function setCuisines(array $cuisines): void
    {
        $this->cuisines = $cuisines;
    }

    public function getDishTypes(): array
    {
        return $this->dishTypes;
    }

    public function setDishTypes(array $dishTypes): void
    {
        $this->dishTypes = $dishTypes;
    }

    public function getDiets(): array
    {
        return $this->diets;
    }

    public function setDiets(array $diets): void
    {
        $this->diets = $diets;
    }

    public function getOccasions(): array
    {
        return $this->occasions;
    }

    public function setOccasions(array $occasions): void
    {
        $this->occasions = $occasions;
    }

    public function getInstructions(): string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions): void
    {
        $this->instructions = $instructions;
    }

    public function getAnalyzedInstructions(): array
    {
        return $this->analyzedInstructions;
    }

    public function setAnalyzedInstructions(array $analyzedInstructions): void
    {
        $this->analyzedInstructions = $analyzedInstructions;
    }

    public function getOriginalId(): ?int
    {
        return $this->originalId;
    }

    public function setOriginalId(?int $originalId): void
    {
        $this->originalId = $originalId;
    }

    public function getSpoonacularSourceUrl(): string
    {
        return $this->spoonacularSourceUrl;
    }

    public function setSpoonacularSourceUrl(string $spoonacularSourceUrl): void
    {
        $this->spoonacularSourceUrl = $spoonacularSourceUrl;
    }

    public function populateByData(array $data): void
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        };
    }

    public function jsonSerialize(): array
    {
        return [
            'vegetarian' => $this->isVegetarian(),
            'vegan' => $this->isVegan(),
            'glutenFree' => $this->isGlutenFree(),
            'dairyFree' => $this->isDairyFree(),
            'veryHealthy' => $this->isVeryHealthy(),
            'cheap' => $this->isCheap(),
            'veryPopular' => $this->isVeryPopular(),
            'sustainable' => $this->isSustainable(),
            'lowFodmap' => $this->isLowFodmap(),
            'weightWatcherSmartPoints' => $this->getWeightWatcherSmartPoints(),
            'gaps' => $this->getGaps(),
            'preparationMinutes' => $this->getPreparationMinutes(),
            'cookingMinutes' => $this->getCookingMinutes(),
            'aggregateLikes' => $this->getAggregateLikes(),
            'healthScore' => $this->getHealthScore(),
            'creditsText' => $this->getCreditsText(),
            'license' => $this->getLicense(),
            'sourceName' => $this->getSourceName(),
            'pricePerServing' => $this->getPricePerServing(),
            'extendedIngredients' => $this->getExtendedIngredients(),
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'readyInMinutes' => $this->getReadyInMinutes(),
            'servings' => $this->getServings(),
            'sourceUrl' => $this->getSourceUrl(),
            'openLicense' => $this->getOpenLicense(),
            'image' => $this->getImage(),
            'imageType' => $this->getImageType(),
            'summary' => $this->getSummary(),
            'cuisines' => $this->getCuisines(),
            'dishTypes' => $this->getDishTypes(),
            'diets' => $this->getDiets(),
            'occasions' => $this->getOccasions(),
            'instructions' => $this->getInstructions(),
            'analyzedInstructions' => $this->getAnalyzedInstructions(),
            'originalId' => $this->getOriginalId(),
            'spoonacularSourceUrl' => $this->getSpoonacularSourceUrl()
        ];
    }
}
