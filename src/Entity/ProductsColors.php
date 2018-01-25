<?php

namespace AppBundle\Entity;

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


}

