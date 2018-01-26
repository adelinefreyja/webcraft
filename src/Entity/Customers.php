<?php

namespace App\Entity;

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
     * @var \App\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    /**
     * @return int
     */
    public function getUserAddressId(): int
    {
        return $this->userAddressId;
    }

    /**
     * @param int $userAddressId
     */
    public function setUserAddressId(int $userAddressId): void
    {
        $this->userAddressId = $userAddressId;
    }

    /**
     * @return int
     */
    public function getUserLandphone(): int
    {
        return $this->userLandphone;
    }

    /**
     * @param int $userLandphone
     */
    public function setUserLandphone(int $userLandphone): void
    {
        $this->userLandphone = $userLandphone;
    }

    /**
     * @return int
     */
    public function getUserMobilephone(): int
    {
        return $this->userMobilephone;
    }

    /**
     * @param int $userMobilephone
     */
    public function setUserMobilephone(int $userMobilephone): void
    {
        $this->userMobilephone = $userMobilephone;
    }

    /**
     * @return int
     */
    public function getCutomersId(): int
    {
        return $this->cutomersId;
    }

    /**
     * @param int $cutomersId
     */
    public function setCutomersId(int $cutomersId): void
    {
        $this->cutomersId = $cutomersId;
    }


}

