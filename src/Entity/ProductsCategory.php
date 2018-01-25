<?php

namespace AppBundle\Entity;

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
     * @var \AppBundle\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     * })
     */
    private $product;


}

