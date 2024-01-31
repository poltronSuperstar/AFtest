<?php

namespace WeatherProductRecommender\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ProductRecommendationControllerTest extends WebTestCase
{
    public function testRecommendProductsEndpoint()
    {

        $this->assertEquals(1,1);
        $client = static::createClient();

        //FIXME: Faire fonctionner ça avec l'url relative
        $client->request(
            'GET',
            'http://localhost:8000/recommendations?city=Paris',
        );

   
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertArrayHasKey('products', $responseData);
        $this->assertArrayHasKey('weather', $responseData);
        $this->assertIsArray($responseData['products']);
        foreach ($responseData['products'] as $product) {
            $this->assertArrayHasKey('id', $product);
            $this->assertArrayHasKey('name', $product);
            $this->assertArrayHasKey('price', $product);
        }
        $this->assertEquals('Paris', $responseData['weather']['city']);
        $this->assertContains($responseData['weather']['is'], ['hot', 'mild', 'cold']);
    }
}
