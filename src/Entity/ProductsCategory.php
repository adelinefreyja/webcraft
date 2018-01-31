<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsCategory
 *
 * @ORM\Table(name="products_category", indexes={@ORM\Index(name="constraint_products_category", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductsCategory
{
    /**
     * @var string
     *
     * @ORM\Column(name="category_value", type="string", length=15, nullable=false)
     */
    private $categoryValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="productCat_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productcatId;

    /**
     * @var integer
     * @ORM\Column(name="product_id", type="integer")
     */
    private $product;

    /**
     * @return string
     */
    public function getCategoryValue()
    {
        return $this->categoryValue;
    }

    /**
     * @param string $categoryValue
     *
     * @return self
     */
    public function setCategoryValue($categoryValue)
    {
        $this->categoryValue = $categoryValue;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductcatId()
    {
        return $this->productcatId;
    }

    /**
     * @param integer $productcatId
     *
     * @return self
     */
    public function setProductcatId($productcatId)
    {
        $this->productcatId = $productcatId;

        return $this;
    }

    /**
     * @return \App\Entity\Products
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

