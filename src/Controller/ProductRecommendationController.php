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

    public function __construct()//FIXME injection de dep
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
        //mock
        $product = [
            'id'=>'1',
            'name'=> "pull beige fluo",
            'price'=>22.3
        ];

        return $this->json([
            'products' => [$product],
            
            'weather' => [
                'city' => $city,
                'is' => 'hot', 
                'date' => 'today' 
            ]
        ]);
    }
}
