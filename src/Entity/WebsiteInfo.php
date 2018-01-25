<?php
// src/Entity/WebsiteInfo.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="options")
 * @ORM\Entity(repositoryClass="App\Repository\WebsiteRepository")
 */
class WebsiteInfo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 3,
     *     max = 50,
     *     minMessage = "Le nom du site doit avoir au minimum {{ limit }} caractères",
     *     maxMessage = "Le nom du site doit avoir au maximum {{ limit }} caractères"
     * )
     */
    private $optionname;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 3,
     *     max = 50,
     *     minMessage = "La desciption du site doit avoir au minimum {{ limit }} caractères",
     *     maxMessage = "La desciption du site doit avoir au maximum {{ limit }} caractères"
     * )
     */
    private $optionvalue;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank()
    */
    private $sitetype;

    /**
     * @return mixed
     */
    public function getSitetype()
    {
        return $this->sitetype;
    }

    /**
     * @param mixed $sitetype
     *
     * @return self
     */
    public function setSitetype($sitetype)
    {
        $this->sitetype = $sitetype;

        return $this;
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
    public function getOptionname()
    {
        return $this->optionname;
    }

    /**
     * @param mixed $optionname
     *
     * @return self
     */
    public function setOptionname($optionname)
    {
        $this->optionname = $optionname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionvalue()
    {
        return $this->optionvalue;
    }

    /**
     * @param mixed $optionvalue
     *
     * @return self
     */
    public function setOptionvalue($optionvalue)
    {
        $this->optionvalue = $optionvalue;

        return $this;
    }
    }
