<?php

namespace Test;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents the name and description of a product in a given locale
 * (eg, "en_US").
 * 
 * @ORM\Entity
 * @ORM\Table(name="product_description")
 */
class ProductDescription
{
    /** 
     * @var Test\Product
     * @ORM\Id 
     * @ORM\ManyToOne(targetEntity="Test\Product", 
     *      inversedBy="descriptions") 
     * @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     */
    private $product;
    
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $locale;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

    public function __construct(product $product)
    {
        $this->product = $product;
    }
    
    public function getLocale()
    {
        return $this->locale;
    }

    public function getDescription()
    {
        return $this->description;
    }
    
    public function getProductId()
    {
        return $this->product->getId();
    }
}
