<?php

namespace App\Entity;

class Food
{
    const UNIT_GRAMS = 'g';

    const UNIT_KILOGRAMS = 'kg';

    const TYPE_VEGGIE = 'vegetable';

    const TYPE_FRUIT = 'fruit';

    public function __construct(
        private int $id,
        private string $name,
        private string $type,
        private float $quantity,
        private string $unit = self::UNIT_GRAMS
    )
    {
        if ($this->unit == self::UNIT_KILOGRAMS) {
            $this->quantity = $this->quantity * 100;
            $this->unit = self::UNIT_GRAMS;
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getQuantity(string $unit = self::UNIT_GRAMS): float
    {
        if ($unit == self::UNIT_KILOGRAMS) {
            $this->unit = self::UNIT_KILOGRAMS;
            return $this->quantity / 100;
        }
        return $this->quantity;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'type' => $this->getType(),
            'quantity' => $this->getQuantity(),
            'unit' => $this->getUnit()
        ];
    }
}
