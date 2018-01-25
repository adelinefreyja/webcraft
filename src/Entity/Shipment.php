<?php

namespace AppBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="order_id", type="bigint", nullable=false)
     */
    private $orderId;

    /**
     * @var string
     *
     * @ORM\Column(name="shipment_method", type="string", length=30, nullable=false)
     */
    private $shipmentMethod = 'Colissimo';

    /**
     * @var integer
     *
     * @ORM\Column(name="shipment_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $shipmentId;


}

