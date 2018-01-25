<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Design
 *
 * @ORM\Table(name="design")
 * @ORM\Entity
 */
class Design
{
    /**
     * @var string
     *
     * @ORM\Column(name="background_color", type="string", length=20, nullable=false)
     */
    private $backgroundColor;

    /**
     * @var string
     *
     * @ORM\Column(name="main_color", type="string", length=20, nullable=false)
     */
    private $mainColor;

    /**
     * @var string
     *
     * @ORM\Column(name="links_color", type="string", length=20, nullable=false)
     */
    private $linksColor;

    /**
     * @var string
     *
     * @ORM\Column(name="text_primary_color", type="string", length=20, nullable=false)
     */
    private $textPrimaryColor;

    /**
     * @var string
     *
     * @ORM\Column(name="text_secondary_color", type="string", length=20, nullable=false)
     */
    private $textSecondaryColor;

    /**
     * @var string
     *
     * @ORM\Column(name="header_img", type="string", length=20, nullable=false)
     */
    private $headerImg;

    /**
     * @var string
     *
     * @ORM\Column(name="header_color", type="string", length=20, nullable=false)
     */
    private $headerColor;

    /**
     * @var string
     *
     * @ORM\Column(name="background_img", type="string", length=20, nullable=false)
     */
    private $backgroundImg;

    /**
     * @var string
     *
     * @ORM\Column(name="css_add", type="string", length=20, nullable=false)
     */
    private $cssAdd;

    /**
     * @var integer
     *
     * @ORM\Column(name="fw_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fwId;


}

