<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sales
 *
 * @ORM\Table(name="sales")
 * @ORM\Entity
 */
class Sales
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     */
    private $productId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="bigint", nullable=false)
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="payment_id", type="integer", nullable=false)
     */
    private $paymentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="shipment_id", type="bigint", nullable=false)
     */
    private $shipmentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="sales_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $salesId;



    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param integer $productId
     *
     * @return self
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param integer $orderId
     *
     * @return self
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param integer $paymentId
     *
     * @return self
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;

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
     * @return integer
     */
    public function getSalesId()
    {
        return $this->salesId;
    }

    /**
     * @param integer $salesId
     *
     * @return self
     */
    public function setSalesId($salesId)
    {
        $this->salesId = $salesId;

        return $this;
    }
}

