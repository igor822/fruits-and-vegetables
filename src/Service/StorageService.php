<?php

namespace App\Service;

use App\Collection\Collection;
use App\Entity\Food;

class StorageService
{
    protected string $request = '';

    private Collection $fruitCollection;

    private Collection $veggieCollection;

    public function __construct(string $request)
    {
        $this->request = $request;
        $this->veggieCollection = new Collection();
        $this->fruitCollection = new Collection();
    }

    public function storeFood(): self
    {
        $data = json_decode($this->request, true);
        foreach ($data as $item) {
            $food = new Food(
                $item['id'],
                $item['name'],
                $item['type'],
                $item['quantity'],
                $item['unit']
            );
            $this->addToCollection($food);
        }

        return $this;
    }

    public function addToCollection(Food $food): self
    {
        if ($food->getType() == Food::TYPE_FRUIT) {
            $this->fruitCollection->add($food);
        }
        if ($food->getType() == Food::TYPE_VEGGIE) {
            $this->veggieCollection->add($food);
        }

        return $this;
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    public function getFruitsCollection(): Collection
    {
        return $this->fruitCollection;
    }

    public function getVeggiesCollection(): Collection
    {
        return $this->veggieCollection;
    }
}
