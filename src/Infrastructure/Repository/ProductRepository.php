<?php

namespace WeatherProductRecommender\Infrastructure\Repository;



use WeatherProductRecommender\Domain\Model\Product;
use WeatherProductRecommender\Domain\Port\ProductRepositoryPort;

class ProductRepository implements ProductRepositoryPort
{


    public function add(Product $product): void
    {
        //persist($product);
        //flush();
    }

    /**
     * @return Product[]
     */
    public function findProductsByWeather(string $forWeather): array
    {
        /*return $this->createQueryBuilder('p')
            ->where('p.forWeather = :forWeather')
            ->setParameter('forWeather', $forWeather)
            ->getQuery()
            ->getResult();*/
            return [];
    }
}
