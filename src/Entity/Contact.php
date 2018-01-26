<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="message_content", type="text", nullable=false)
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
     */
    private $messageObject;

    /**
     * @var integer
     *
     * @ORM\Column(name="message_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $messageId;

    /**
     * @return string
     */
    public function getMessageContent(): string
    {
        return $this->messageContent;
    }

    /**
     * @param string $messageContent
     */
    public function setMessageContent(string $messageContent): void
    {
        $this->messageContent = $messageContent;
    }

    /**
     * @return \DateTime
     */
    public function getMessageDate(): \DateTime
    {
        return $this->messageDate;
    }

    /**
     * @param \DateTime $messageDate
     */
    public function setMessageDate(\DateTime $messageDate): void
    {
        $this->messageDate = $messageDate;
    }

    /**
     * @return string
     */
    public function getMessageObject(): string
    {
        return $this->messageObject;
    }

    /**
     * @param string $messageObject
     */
    public function setMessageObject(string $messageObject): void
    {
        $this->messageObject = $messageObject;
    }

    /**
     * @return int
     */
    public function getMessageId(): int
    {
        return $this->messageId;
    }

    /**
     * @param int $messageId
     */
    public function setMessageId(int $messageId): void
    {
        $this->messageId = $messageId;
    }

}

