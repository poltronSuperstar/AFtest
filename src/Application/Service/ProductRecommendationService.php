<?php
namespace WeatherProductRecommender\Application\Service;

use WeatherProductRecommender\Domain\Port\ProductRepositoryPort;

class ProductRecommendationService
{
    private ProductRepositoryPort $productRepository;

    public function __construct(ProductRepositoryPort $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // FIXME: `string date c'est un peu batard
    public function recommendProducts(string $city, string $date): array
    {
        return $this->productRepository->findProductsByWeather($city, $date);
    }
}
