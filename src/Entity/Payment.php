<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment", indexes={@ORM\Index(name="order_id", columns={"order_id"})})
 * @ORM\Entity
 */
class Payment
{
    /**
     * @var string
     *
     * @ORM\Column(name="payment_method", type="string", length=30, nullable=false)
     */
    private $paymentMethod;

    /**
     * @var integer
     *
     * @ORM\Column(name="payment_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $paymentId;

    /**
     * @var \App\Entity\Orders
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="order_id")
     * })
     */
    private $order;

    /**
     * @return integer
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param integer $paymentMethod
     *
     * @return self
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

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
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param integer $order
     *
     * @return self
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

}
