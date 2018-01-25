<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsComments
 *
 * @ORM\Table(name="products_comments", indexes={@ORM\Index(name="constraint_comment", columns={"product_id"}), @ORM\Index(name="constraint_comment1", columns={"id"})})
 * @ORM\Entity
 */
class ProductsComments
{
    /**
     * @var string
     *
     * @ORM\Column(name="note_value", type="string", length=20, nullable=false)
     */
    private $noteValue = '4';

    /**
     * @var string
     *
     * @ORM\Column(name="comment_text", type="text", length=65535, nullable=false)
     */
    private $commentText;

    /**
     * @var integer
     *
     * @ORM\Column(name="productComment_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productcommentId;

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
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;


}

