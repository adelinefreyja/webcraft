<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsSizes
 *
 * @ORM\Table(name="products_sizes", indexes={@ORM\Index(name="constraint_products_size", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductsSizes
{
    /**
     * @var string
     *
     * @ORM\Column(name="size_value", type="string", length=15, nullable=false)
     */
    private $sizeValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="size_stock", type="integer", nullable=false)
     */
    private $sizeStock;

    /**
     * @var integer
     *
     * @ORM\Column(name="productSize_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productsizeId;

    /**
     * @var integer
     * @ORM\Column(name="product_id", type="integer")
     */
    private $product;

    /**
     * @return string
     */
    public function getSizeValue()
    {
        return $this->sizeValue;
    }

    /**
     * @param string $sizeValue
     *
     * @return self
     */
    public function setSizeValue($sizeValue)
    {
        $this->sizeValue = $sizeValue;

        return $this;
    }

    /**
     * @return integer
     */
    public function getSizeStock()
    {
        return $this->sizeStock;
    }

    /**
     * @param integer $sizeStock
     *
     * @return self
     */
    public function setSizeStock($sizeStock)
    {
        $this->sizeStock = $sizeStock;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductsizeId()
    {
        return $this->productsizeId;
    }

    /**
     * @param integer $productsizeId
     *
     * @return self
     */
    public function setProductsizeId($productsizeId)
    {
        $this->productsizeId = $productsizeId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param integer $product
     *
     * @return self
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }
}

