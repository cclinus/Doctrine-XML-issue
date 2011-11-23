<?php

namespace Test;

use Doctrine\ORM\Mapping as ORM;

/**
 * A product that our business sells.
 * 
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @var int
     * @ORM\Id 
     * @ORM\Column(type="integer") 
     */
    private $product_id;

    /** 
     * @var ProductDescription[]
     * @ORM\OneToMany(targetEntity="Test\ProductDescription", 
     *      mappedBy="product", cascade={"persist", "remove"}) 
     */
    private $descriptions;

    public function __construct()
    {
        $this->descriptions = new ArrayCollection();
    }

    /**
     * @return ProductDescription[]
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }
    
    public function getId()
    {
        return $this->product_id;
    }
}
