<?php

namespace WeatherProductRecommender\Tests\Infrastructure\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use WeatherProductRecommender\Domain\Model\Product;
use WeatherProductRecommender\Infrastructure\Repository\ProductRepository;

class ProductRepositoryTest extends KernelTestCase
{
    private ?EntityManagerInterface $entityManager;
    private ?ProductRepository $productRepository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);

        // Clean up the table before each test
        $this->entityManager->createQuery('DELETE FROM WeatherProductRecommender\Domain\Model\Product')->execute();
    }

    public function testAddAndFindByWeather()
    {
        $productHot = new Product('1', 'Tshirt pourpre', 15.99, 'hot');
        $productCold = new Product('2', 'Pull en verre', 99.99, 'cold');

        $this->productRepository->add($productHot);
        $this->productRepository->add($productCold);

        $hotProducts = $this->productRepository->findProductsByWeather('hot');
        $coldProducts = $this->productRepository->findProductsByWeather('cold');

        $this->assertCount(1, $hotProducts);
        $this->assertSame('Tshirt pourpre', $hotProducts[0]->name);

        $this->assertCount(1, $coldProducts);
        $this->assertSame('Pull en verre', $coldProducts[0]->name);
    }
}
