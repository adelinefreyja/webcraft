<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shipment
 *
 * @ORM\Table(name="shipment")
 * @ORM\Entity
 */
class Shipment
{
    /**
     * @var string
     *
     * @ORM\Column(name="shipment_method", type="string", length=30, nullable=false)
     */
    private $shipmentMethod;

    /**
     * @var integer
     *
     * @ORM\Column(name="shipment_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $shipmentId;

    /**
     * @var float
     *
     * @ORM\Column(name="shipment_price", type="float")
     * 
     */
    private $shipment_price;

    /**
     * @return string
     */
    public function getShipmentMethod()
    {
        return $this->shipmentMethod;
    }

    /**
     * @param string $shipmentMethod
     *
     * @return self
     */
    public function setShipmentMethod($shipmentMethod)
    {
        $this->shipmentMethod = $shipmentMethod;

        return $this;
    }

    /**
     * @return integer
     */
    public function getShipmentId()
    {
        return $this->shipmentId;
    }

    /**
     * @param integer $shipmentId
     *
     * @return self
     */
    public function setShipmentId($shipmentId)
    {
        $this->shipmentId = $shipmentId;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->shipment_price;
    }

    /**
     * @param float $shipment_price
     */
    public function setPrice($shipment_price)
    {
        $this->shipment_price = $shipment_price;
    }
}

