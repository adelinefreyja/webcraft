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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * })
     */
    private $id;

    /**
     * @return integer
     */
    public function getUserAddressId()
    {
        return $this->userAddressId;
    }

    /**
     * @param integer $userAddressId
     */
    public function setUserAddressId($userAddressId)
    {
        $this->userAddressId = $userAddressId;
    }

    /**
     * @return integer
     */
    public function getUserLandphone()
    {
        return $this->userLandphone;
    }

    /**
     * @param int $userLandphone
     */
    public function setUserLandphone($userLandphone)
    {
        $this->userLandphone = $userLandphone;
    }

    /**
     * @return integer
     */
    public function getUserMobilephone()
    {
        return $this->userMobilephone;
    }

    /**
     * @param integer $userMobilephone
     */
    public function setUserMobilephone($userMobilephone)
    {
        $this->userMobilephone = $userMobilephone;
    }

    /**
     * @return integer
     */
    public function getCutomersId()
    {
        return $this->cutomersId;
    }

    /**
     * @param integer $cutomersId
     */
    public function setCutomersId($cutomersId)
    {
        $this->cutomersId = $cutomersId;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}

