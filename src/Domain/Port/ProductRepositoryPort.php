<?php

namespace WeatherProductRecommender\Domain\Port;

use WeatherProductRecommender\Domain\Model\Product;

interface ProductRepositoryPort
{
    public function addProduct(Product $product): void;
    public function findProductsByWeather(string $forWeather): array;
}
