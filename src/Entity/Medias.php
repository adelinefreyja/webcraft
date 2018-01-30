<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @return string
     */
    public function getMediaType(): string
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
    public function getMediaSrc(): string
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
    public function getMediaName(): string
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
    public function getMediaDescription(): string
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

