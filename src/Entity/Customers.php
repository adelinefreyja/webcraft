<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customers
 *
 * @ORM\Table(name="customers", indexes={@ORM\Index(name="constraint_customers", columns={"id"})})
 * @ORM\Entity
 */
class Customers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_address_id", type="integer", nullable=false)
     */
    private $userAddressId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_landPhone", type="integer", nullable=false)
     */
    private $userLandphone;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_mobilePhone", type="integer", nullable=false)
     */
    private $userMobilephone;

    /**
     * @var integer
     *
     * @ORM\Column(name="cutomers_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cutomersId;

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

