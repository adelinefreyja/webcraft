<?php

namespace AppBundle\Entity;

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
     * @var \AppBundle\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     * })
     */
    private $product;


}
