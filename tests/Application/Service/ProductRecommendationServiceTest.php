<?php

namespace WeatherProductRecommender\Tests\Application\Service;

use WeatherProductRecommender\Application\Service\ProductRecommendationService;
use WeatherProductRecommender\Domain\Model\Product;
use WeatherProductRecommender\Domain\Port\ProductRepositoryPort;
use WeatherProductRecommender\Domain\Port\WeatherFetcherPort;
use WeatherProductRecommender\Domain\ValueObject\WeatherCondition;
use PHPUnit\Framework\TestCase;

class ProductRecommendationServiceTest extends TestCase
{
    public function testRecommendProductsForHotWeather()
    {
        $weatherFetcher = $this->createMock(WeatherFetcherPort::class);
        $productRepository = $this->createMock(ProductRepositoryPort::class);

        $weatherCondition = new WeatherCondition('Paris', 25); // Assuming hot weather
        $weatherFetcher->method('fetchWeatherCondition')
            ->willReturn($weatherCondition);

        $expectedProducts = [
            new Product('1', 'T-Shirt', 20.00, 'T-Shirt')
        ];
        $productRepository->method('findProductsByTemperature')
            ->with($this->equalTo(25))
            ->willReturn($expectedProducts);

        $service = new ProductRecommendationService($productRepository);
        $recommendedProducts = $service->recommendProducts('Paris');

        $this->assertEquals($expectedProducts, $recommendedProducts);
    }

    public function testRecommendProductsForColdWeather()
    {
        $weatherFetcher = $this->createMock(WeatherFetcherPort::class);
        $productRepository = $this->createMock(ProductRepositoryPort::class);

        $weatherCondition = new WeatherCondition('Moscow', -5); // Assuming cold weather
        $weatherFetcher->method('fetchWeatherCondition')
            ->willReturn($weatherCondition);

        $expectedProducts = [
            new Product('2', 'Pull', 50.00, 'Pull')
        ];
        $productRepository->method('findProductsByTemperature')
            ->with($this->equalTo(-5))
            ->willReturn($expectedProducts);

        $service = new ProductRecommendationService($weatherFetcher, $productRepository);
        $recommendedProducts = $service->recommendProducts('Moscow');

        $this->assertEquals($expectedProducts, $recommendedProducts);
    }
}
