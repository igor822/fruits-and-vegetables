<?php

namespace App\Collection;

use App\Entity\Food;

interface CollectionInterface
{
    public function add(Food $item): self;

    public function remove(int $id): self;

    public function get(int $id): ?Food;

    public function list(): array;

    public function count(): int;
}
