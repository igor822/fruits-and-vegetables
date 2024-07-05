<?php

namespace App\Tests\App\Entity;

use App\Entity\Food;
use PHPUnit\Framework\TestCase;

class FoodTest extends TestCase
{
    private $data;

    protected function setUp(): void
    {
        $this->data = [
            'id' => 1,
            'name' => 'Carrot',
            'type' => 'vegetable',
            'quantity' => 10922,
            'unit' => 'g'
        ];
    }

    public function testCreateEntity(): void
    {
        $food = Food::fromArray($this->data);

        $this->assertInstanceOf(Food::class, $food);
    }

    public function testEntityData(): void
    {
        $food = Food::fromArray($this->data);

        $this->assertEquals($this->data['id'], $food->getId());
        $this->assertEquals($this->data['name'], $food->getName());
        $this->assertEquals($this->data['type'], $food->getType());
        $this->assertEquals($this->data['quantity'], $food->getQuantity());
        $this->assertEquals($this->data['unit'], $food->getUnit());
    }
}
