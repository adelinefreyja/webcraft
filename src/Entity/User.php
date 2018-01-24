<?php
// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 5,
     *     max = 25,
     *     minMessage = "Le pseudo doit avoir au minimum {{ limit }} caractères",
     *     maxMessage = "Le pseudo doit avoir au maximum {{ limit }} caractères"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    
    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(
     *      message = "L'Email '{{ value }}' n'est pas correct.",
     * 		checkMX = true
     * )
     */
    private $user_email;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    private $user_first_name;

    /**
    * @ORM\Column(type="string", length=64)
    * @Assert\NotBlank()
    */
    private $user_last_name;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank()
    */
    private $user_gender;

    /**
    * @ORM\Column(type="string", length=64, nullable=true)
    */
    private $user_profile_picture;

    /**
    * @ORM\Column(type="string", length=64, nullable=true)
    */
    private $user_ip;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
    * @ORM\Column(type="array")
    */
    private $roles;



    public function __construct()
    {
        $this->setIsActive(true);
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
        // 
        $this->setRoles(['ROLE_SUPER_ADMIN']);
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     *
     * @return self
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserFirstName()
    {
        return $this->user_first_name;
    }

    /**
     * @param mixed $user_first_name
     *
     * @return self
     */
    public function setUserFirstName($user_first_name)
    {
        $this->user_first_name = $user_first_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserLastName()
    {
        return $this->user_last_name;
    }

    /**
     * @param mixed $user_last_name
     *
     * @return self
     */
    public function setUserLastName($user_last_name)
    {
        $this->user_last_name = $user_last_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserGender()
    {
        return $this->user_gender;
    }

    /**
     * @param mixed $user_gender
     *
     * @return self
     */
    public function setUserGender($user_gender)
    {
        $this->user_gender = $user_gender;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserProfilePicture()
    {
        return $this->user_profile_picture;
    }

    /**
     * @param mixed $user_profile_picture
     *
     * @return self
     */
    public function setUserProfilePicture($user_profile_picture)
    {
        $this->user_profile_picture = $user_profile_picture;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserIp()
    {
        return $this->user_ip;
    }

    /**
     * @param mixed $user_ip
     *
     * @return self
     */
    public function setUserIp($user_ip)
    {
        $this->user_ip = $user_ip;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     *
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     *
     * @return self
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}