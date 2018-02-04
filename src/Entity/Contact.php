<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string")
     * @Assert\NotBlank()
     * @Assert\Email(
     *      message = "L'Email '{{ value }}' n'est pas correct.",
     *      checkMX = true
     * )
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string")
     * @Assert\NotBlank()
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="message_content", type="text", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 15,
     *     minMessage = "Le message ne peut pas contenir moins de {{ limit }} caractères"
     * )
     *     
     */
    private $messageContent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="message_date", type="datetime", nullable=false)
     */
    private $messageDate;

    /**
     * @var string
     *
     * @ORM\Column(name="message_object", type="string", length=20, nullable=false)
     * @Assert\NotBlank(
     *     message = "Merci de préciser l'objet de votre message"
     * )
     */
    private $messageObject;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=10, nullable=true)
     */
    private $status = "nonlu";


    /**
     * @var integer
     *
     * @ORM\Column(name="message_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $messageId;


    public function __toString()
    {
        return (string)$this->messageObject;
        return (string)$this->messageDate;
    }


    /**
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param string $userEmail
     *
     * @return self
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessageContent()
    {
        return $this->messageContent;
    }

    /**
     * @param string $messageContent
     *
     * @return self
     */
    public function setMessageContent($messageContent)
    {
        $this->messageContent = $messageContent;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessageDate()
    {
        return $this->messageDate;
    }

    /**
     * @param \DateTime $messageDate
     *
     * @return self
     */
    public function setMessageDate(\DateTime $messageDate)
    {
        $this->messageDate = $messageDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessageObject()
    {
        return $this->messageObject;
    }

    /**
     * @param string $messageObject
     *
     * @return self
     */
    public function setMessageObject($messageObject)
    {
        $this->messageObject = $messageObject;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param integer $messageId
     *
     * @return self
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     *
     * @return self
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}

