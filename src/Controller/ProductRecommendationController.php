<?php

namespace WeatherProductRecommender\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//TODO use WeatherProductRecommender\Application\Service\ProductRecommendationService;

class ProductRecommendationController extends AbstractController
{
   // private ProductRecommendationService $productRecommendationService;

    public function __construct()
    {
       // $this->productRecommendationService = $productRecommendationService;
    }

    /**
     * @Route("/recommendations", name="product_recommendations", methods={"GET"})
     */
    public function recommendProducts(Request $request): JsonResponse
    {
        $city = $request->query->get('city');

        if (!$city) {
            return $this->json(['error' => 'City not provided'], Response::HTTP_BAD_REQUEST);
        }


        return $this->json([
            'products' => [[
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'price' => $product->getPrice()
                ]],
            
            'weather' => [
                'city' => $city,
                'is' => 'hot', 
                'date' => 'today' 
            ]
        ]);
    }
}
