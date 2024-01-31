<?php

namespace App\Tests\Domain\Model;

use App\Domain\Model\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductAttributes()
    {
        $id = 55;
        $name = "Pull en bois";
        $price = 55.3;
        $type = 'pull';
        $forWeather = 'cold'; // FIXME: Should be an Enum

        $product = new Product($id,
                               $price, 
                               $type,
                               $forWeather);

        $this->assertEquals($id, $product->id);
        $this->assertEquals($name, $product->name);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($type, $product->type);
        $this->assertEquals($forWeather, $product->forWeather);

    }
}
