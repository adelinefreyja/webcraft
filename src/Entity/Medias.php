<?php

namespace AppBundle\Entity;

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


}

