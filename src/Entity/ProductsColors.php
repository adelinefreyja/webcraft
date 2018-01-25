<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsColors
 *
 * @ORM\Table(name="products_colors", indexes={@ORM\Index(name="constraint_products_color", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductsColors
{
    /**
     * @var string
     *
     * @ORM\Column(name="color_value", type="string", length=15, nullable=false)
     */
    private $colorValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="color_stock", type="integer", nullable=false)
     */
    private $colorStock;

    /**
     * @var integer
     *
     * @ORM\Column(name="productColor_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productcolorId;

    /**
     * @var \AppBundle\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
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
     * @return integer
     */
    public function getColorStock()
    {
        return $this->colorStock;
    }

    /**
     * @param integer $colorStock
     *
     * @return self
     */
    public function setColorStock($colorStock)
    {
        $this->colorStock = $colorStock;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductcolorId()
    {
        return $this->productcolorId;
    }

    /**
     * @param integer $productcolorId
     *
     * @return self
     */
    public function setProductcolorId($productcolorId)
    {
        $this->productcolorId = $productcolorId;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Products
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param \AppBundle\Entity\Products $product
     *
     * @return self
     */
    public function setProduct(\AppBundle\Entity\Products $product)
    {
        $this->product = $product;

        return $this;
    }
}

