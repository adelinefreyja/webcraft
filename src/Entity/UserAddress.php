<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAddress
 *
 * @ORM\Table(name="user_address", indexes={@ORM\Index(name="constraint_address", columns={"id"})})
 * @ORM\Entity
 */
class UserAddress
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_addressName", type="string", length=255, nullable=false)
     */
    private $userAddressname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_address", type="string", length=255, nullable=false)
     */
    private $userAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_zipCode", type="integer", nullable=false)
     */
    private $userZipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="user_city", type="string", length=255, nullable=false)
     */
    private $userCity;

    /**
     * @var string
     *
     * @ORM\Column(name="user_comment", type="string", length=255, nullable=false)
     */
    private $userComment;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_address_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userAddressId;

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

