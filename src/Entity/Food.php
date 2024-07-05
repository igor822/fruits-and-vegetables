<?php

namespace App\Entity;

class Food
{
    const UNIT_GRAMS = 'g';

    const UNIT_KILOGRAMS = 'kg';

    const TYPE_VEGGIE = 'vegetable';

    const TYPE_FRUIT = 'fruit';

    private int $id;

    private string $name;

    private string $type;

    private int $quantity;

    private string $unit = self::UNIT_GRAMS;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit = self::UNIT_GRAMS): self
    {
        $this->unit = $unit;

        return $this;
    }

    public static function fromArray(array $data): self
    {
        $obj = new self(); 
        $obj->setId($data['id']);
        $obj->setName($data['name']);
        $obj->setType($data['type']);
        $quantity = $data['quantity'];
        if ($data['unit'] == self::UNIT_KILOGRAMS) {
            $quantity = $quantity * 100;
        }
        $obj->setQuantity($quantity);
        $obj->setUnit($data['unit']);

        return $obj;
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
