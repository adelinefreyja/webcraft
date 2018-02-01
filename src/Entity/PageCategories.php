<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pages
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class PageCategories
{
    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", length=255, nullable=false)
     */
    private $category_name;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;



    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param string $category_name
     *
     * @return self
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param integer $categoryId
     *
     * @return self
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }
}