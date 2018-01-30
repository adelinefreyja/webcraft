<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsImages
 *
 * @ORM\Table(name="products_images", indexes={@ORM\Index(name="constraint_products_image", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductsImages
{
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=150, nullable=false)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="productImg_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productimgId;

    /**
     * @var \App\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     * })
     */
    private $productId;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductimgId()
    {
        return $this->productimgId;
    }

    /**
     * @param integer $productimgId
     *
     * @return self
     */
    public function setProductimgId($productimgId)
    {
        $this->productimgId = $productimgId;

        return $this;
    }

    /**
     * @return \App\Entity\Products
     */
    public function getProduct()
    {
        return $this->productId;
    }

    /**
     * @param \App\Entity\Products $product
     *
     * @return self
     */
    public function setProduct(\App\Entity\Products $product)
    {
        $this->productId = $product;

        return $this;
    }
}

