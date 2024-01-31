<?php
namespace WeatherProductRecommender\Application\Service;

use WeatherProductRecommender\Domain\Port\ProductRepositoryPort;
use WeatherProductRecommender\Domain\Port\WeatherFetcherPort;

class ProductRecommendationService
{
    private readonly ProductRepositoryPort $productRepository;
    private readonly WeatherFetcherPort $weatherFetcher;

    public function __construct(ProductRepositoryPort $productRepository, WeatherFetcherPort $weatherFetcher)
    {
        $this->productRepository = $productRepository;
        $this->weatherFetcher = $weatherFetcher;
    }

    // FIXME: `string date c'est un peu batard
    public function recommendProducts(string $city, string $date): array
    {
        //TODO Convert date
        //     Fetch weather
        //     Hydrate VO WeatherCondition (without mutation)
        //     get products for weatherType
        //return $this->productRepository->findProductsByWeather();
        return [];
    }
}
