<?php

namespace App\Tests\App\Service;

use App\Collection\Collection;
use App\Entity\Food;
use App\Service\StorageService;
use PHPUnit\Framework\TestCase;

class StorageServiceTest extends TestCase
{
    public function testReceivingRequest()
    {
        $request = file_get_contents('request.json');

        $storageService = new StorageService($request);

        $this->assertNotEmpty($storageService->getRequest());
        $this->assertIsString($storageService->getRequest());

        return $storageService;
    }

    /**
     * @depends testReceivingRequest
     */
    public function testSeparateCollection($storageService): array
    {
        $storageService->storeFood();
        $fruitCollection = $storageService->getFruitsCollection();
        foreach ($fruitCollection->list() as $item) {
            $this->assertEquals(Food::TYPE_FRUIT, $item->getType());
        }

        $veggiesCollection = $storageService->getVeggiesCollection();
        foreach ($veggiesCollection->list() as $item) {
            $this->assertEquals(Food::TYPE_VEGGIE, $item->getType());
        }

        return [
            'veggies' => $veggiesCollection,
            'fruits' => $fruitCollection
        ];
    }

    /**
     * @depends testSeparateCollection
     */
    public function testSearchItemByName($collections): void
    {
        $items = $collections['veggies']->search('Beans');
        $this->assertSame(1, $items->count());
    }
}
