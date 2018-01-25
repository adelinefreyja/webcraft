<?php

namespace App\Entity;

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

    /**
     * @return float
     */
    public function getTaxValue()
    {
        return $this->taxValue;
    }

    /**
     * @param float $taxValue
     *
     * @return self
     */
    public function setTaxValue($taxValue)
    {
        $this->taxValue = $taxValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getTaxName()
    {
        return $this->taxName;
    }

    /**
     * @param string $taxName
     *
     * @return self
     */
    public function setTaxName($taxName)
    {
        $this->taxName = $taxName;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * @param integer $taxId
     *
     * @return self
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;

        return $this;
    }
}

