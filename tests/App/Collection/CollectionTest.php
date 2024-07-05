<?php

namespace App\Collection;

use App\Collection\Collection;
use App\Entity\Food;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    private array $data;

    protected function setUp(): void
    {
        $this->data = [
            [
                'id' => 1,
                'name' => 'Carrot',
                'type' => 'vegetable',
                'quantity' => 10922,
                'unit' => 'g'
            ],
            [
                'id' => 2,
                'name' => 'Apples',
                'type' => 'fruit',
                'quantity' => 20,
                'unit' => 'kg'
            ],
            [
                'id' => 3,
                'name' => 'Pears',
                'type' => 'fruit',
                'quantity' => 3500,
                'unit' => 'g'
            ],
            [
                'id' => 4,
                'name' => 'Melons',
                'type' => 'fruit',
                'quantity' => 120,
                'unit' => 'kg'
            ]
        ];
    }

    public function testCreateCollectionFromArray()
    {
        $collection = new Collection();
        foreach ($this->data as $data) {
            $food = new Food(
                $data['id'],
                $data['name'],
                $data['type'],
                $data['quantity'],
                $data['unit']
            );

            $collection->add($food);
        }

        $this->assertSame(count($this->data), $collection->count());

        return $collection;
    }

    /**
     * @depends testCreateCollectionFromArray
     */
    public function testGetAndRemoveItem($collection): void
    {
        $food = $collection->get(2);

        $this->assertInstanceOf(Food::class, $food);

        $collection->remove(2);
        $food = $collection->get(2);

        $this->assertNull($food);
    }

}
