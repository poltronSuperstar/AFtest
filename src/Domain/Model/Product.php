<?php
/**
 * Note: La mutabilité c'est le mal.
 *       Je ne pense pas avoir le temps de faire plus propre, mais 
 */

namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private string $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="float")
     */
    private float $price;

    /**
     * @ORM\Column(type="string")
     */
    private string $type;

    public function __construct(string $id, string $name, float $price, string $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
    }

    // Getters and potentially setters...
}
