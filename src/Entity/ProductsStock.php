<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsColors
 *
 * @ORM\Table(name="products_stock", indexes={@ORM\Index(name="constraint_products_stock", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductsStock
{
    /**
     * @var string
     *
     * @ORM\Column(name="color_value", type="string", length=15, nullable=false)
     */
    private $colorValue;

    /**
     * @var string
     *
     * @ORM\Column(name="size_value", type="string", length=15, nullable=false)
     */
    private $sizeValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock_value", type="integer", nullable=false)
     */
    private $stockValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="productStock_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productStockId;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     * })
     */
    private $product;

    /**
     * @return string
     */
    public function getColorValue()
    {
        return $this->colorValue;
    }

    /**
     * @param string $colorValue
     *
     * @return self
     */
    public function setColorValue($colorValue)
    {
        $this->colorValue = $colorValue;

        return $this;
    }

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
    public function getStockValue()
    {
        return $this->stockValue;
    }

    /**
     * @param integer $stockValue
     *
     * @return self
     */
    public function setStockValue($stockValue)
    {
        $this->stockValue = $stockValue;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductStockId()
    {
        return $this->productStockId;
    }

    /**
     * @param integer $productStockId
     *
     * @return self
     */
    public function setProductStockId($productStockId)
    {
        $this->productStockId = $productStockId;

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

