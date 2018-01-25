<?php

namespace App\Entity;

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

    /**
     * @return string
     */
    public function getUserAddressname()
    {
        return $this->userAddressname;
    }

    /**
     * @param string $userAddressname
     *
     * @return self
     */
    public function setUserAddressname($userAddressname)
    {
        $this->userAddressname = $userAddressname;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAddress()
    {
        return $this->userAddress;
    }

    /**
     * @param string $userAddress
     *
     * @return self
     */
    public function setUserAddress($userAddress)
    {
        $this->userAddress = $userAddress;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUserZipcode()
    {
        return $this->userZipcode;
    }

    /**
     * @param integer $userZipcode
     *
     * @return self
     */
    public function setUserZipcode($userZipcode)
    {
        $this->userZipcode = $userZipcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserCity()
    {
        return $this->userCity;
    }

    /**
     * @param string $userCity
     *
     * @return self
     */
    public function setUserCity($userCity)
    {
        $this->userCity = $userCity;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserComment()
    {
        return $this->userComment;
    }

    /**
     * @param string $userComment
     *
     * @return self
     */
    public function setUserComment($userComment)
    {
        $this->userComment = $userComment;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUserAddressId()
    {
        return $this->userAddressId;
    }

    /**
     * @param integer $userAddressId
     *
     * @return self
     */
    public function setUserAddressId($userAddressId)
    {
        $this->userAddressId = $userAddressId;

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

