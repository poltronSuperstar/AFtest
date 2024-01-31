<?php

namespace WeatherProductRecommender\Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use WeatherProductRecommender\Domain\Model\Product;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $product): void
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }

    /**
     * @return Product[]
     */
    public function findProductsByWeather(string $forWeather): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.forWeather = :forWeather')
            ->setParameter('forWeather', $forWeather)
            ->getQuery()
            ->getResult();
    }
}
