<?php

namespace App\Entity;

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
     * @var \App\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     * })
     */
    private $product;

    /**
     * @var \App\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    /**
     * @return string
     */
    public function getNoteValue()
    {
        return $this->noteValue;
    }

    /**
     * @param string $noteValue
     *
     * @return self
     */
    public function setNoteValue($noteValue)
    {
        $this->noteValue = $noteValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getCommentText()
    {
        return $this->commentText;
    }

    /**
     * @param string $commentText
     *
     * @return self
     */
    public function setCommentText($commentText)
    {
        $this->commentText = $commentText;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductcommentId()
    {
        return $this->productcommentId;
    }

    /**
     * @param integer $productcommentId
     *
     * @return self
     */
    public function setProductcommentId($productcommentId)
    {
        $this->productcommentId = $productcommentId;

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

    /**
     * @return \AppBundle\Entity\User
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \AppBundle\Entity\User $id
     *
     * @return self
     */
    public function setId(\AppBundle\Entity\User $id)
    {
        $this->id = $id;

        return $this;
    }
}

