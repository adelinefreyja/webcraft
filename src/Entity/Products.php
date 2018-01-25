<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products", indexes={@ORM\Index(name="constraint_products", columns={"tax_id"})})
 * @ORM\Entity
 */
class Products
{
    /**
     * @var integer
     *
     * @ORM\Column(name="product_price", type="integer", nullable=false)
     */
    private $productPrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_sale", type="integer", nullable=false)
     */
    private $productSale;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=255, nullable=false)
     */
    private $productName;

    /**
     * @var string
     *
     * @ORM\Column(name="product_description", type="text", length=65535, nullable=false)
     */
    private $productDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productId;

    /**
     * @var \AppBundle\Entity\ProductsTax
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProductsTax")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tax_id", referencedColumnName="tax_id")
     * })
     */
    private $tax;
    
    /**
     * @return integer
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * @param integer $productPrice
     *
     * @return self
     */
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductSale()
    {
        return $this->productSale;
    }

    /**
     * @param integer $productSale
     *
     * @return self
     */
    public function setProductSale($productSale)
    {
        $this->productSale = $productSale;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     *
     * @return self
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * @param string $productDescription
     *
     * @return self
     */
    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param integer $productId
     *
     * @return self
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\ProductsTax
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param \AppBundle\Entity\ProductsTax $tax
     *
     * @return self
     */
    public function setTax(\AppBundle\Entity\ProductsTax $tax)
    {
        $this->tax = $tax;

        return $this;
    }
}

