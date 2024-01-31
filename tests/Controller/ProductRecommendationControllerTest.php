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
    }
}
