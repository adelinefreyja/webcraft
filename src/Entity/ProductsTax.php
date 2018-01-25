<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsTax
 *
 * @ORM\Table(name="products_tax")
 * @ORM\Entity
 */
class ProductsTax
{
    /**
     * @var float
     *
     * @ORM\Column(name="tax_value", type="float", precision=10, scale=0, nullable=false)
     */
    private $taxValue;

    /**
     * @var string
     *
     * @ORM\Column(name="tax_name", type="string", length=20, nullable=false)
     */
    private $taxName;

    /**
     * @var integer
     *
     * @ORM\Column(name="tax_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $taxId;


}

