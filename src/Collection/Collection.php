<?php

namespace App\Collection;

use App\Entity\Food;

class Collection implements CollectionInterface
{
    private array $items = [];

    public function add(Food $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function remove(int $id): self
    {
        foreach ($this->items as $index => $item) {
            if ($item->getId() == $id) {
                unset($this->items[$index]);
            }
        }

        return $this;
    }

    public function get(int $id): ?Food
    {
        foreach ($this->items as $index => $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }

        return null;
    }

    public function list(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function search(string $name): Collection
    {
        $results = new Collection();
        foreach ($this->items as $item) {
            if ($item->getName() == $name) {
                $results->add($item);
            }
        }

        return $results;
    }
}
