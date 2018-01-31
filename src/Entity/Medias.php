<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Medias
 *
 * @ORM\Table(name="medias")
 * @ORM\Entity
 */
class Medias
{
    /**
     * @var string
     *
     * @ORM\Column(name="media_type", type="string", length=30, nullable=false)
     */
    private $mediaType;

    /**
     * @var string
     *
     * @ORM\Column(name="media_src", type="string", length=255, nullable=false)
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg", "video/mpeg", "application/pdf", "video/webm", "video/mp4", "audio/ogg", "audio/x-wav", "audio/mpeg" })
     */
    private $mediaSrc;

    /**
     * @var string
     *
     * @ORM\Column(name="media_name", type="string", length=255, nullable=false)
     */
    private $mediaName;

    /**
     * @var string
     *
     * @ORM\Column(name="media_description", type="text", length=65535, nullable=true)
     */
    private $mediaDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="media_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mediaId;

    /**
     * @return int
     */
    public function getMediaId()
    {
        return $this->mediaId;
    }

    /**
     * @param int $mediaId
     */
    public function setMediaId(int $mediaId)
    {
        $this->mediaId = $mediaId;
    }

    /**
     * @return string
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param string $mediaType
     */
    public function setMediaType(string $mediaType): void
    {
        $this->mediaType = $mediaType;
    }

    /**
     * @return string
     */
    public function getMediaSrc()
    {
        return $this->mediaSrc;
    }

    /**
     * @param string $mediaSrc
     */
    public function setMediaSrc(string $mediaSrc): void
    {
        $this->mediaSrc = $mediaSrc;
    }

    /**
     * @return string
     */
    public function getMediaName()
    {
        return $this->mediaName;
    }

    /**
     * @param string $mediaName
     */
    public function setMediaName(string $mediaName): void
    {
        $this->mediaName = $mediaName;
    }

    /**
     * @return string
     */
    public function getMediaDescription()
    {
        return $this->mediaDescription;
    }

    /**
     * @param string $mediaDescription
     */
    public function setMediaDescription(string $mediaDescription): void
    {
        $this->mediaDescription = $mediaDescription;
    }

}

