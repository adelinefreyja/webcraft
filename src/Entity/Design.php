<?php

namespace App\Entity;

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

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    /**
     * @param string $backgroundColor
     */
    public function setBackgroundColor(string $backgroundColor): void
    {
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * @return string
     */
    public function getMainColor(): string
    {
        return $this->mainColor;
    }

    /**
     * @param string $mainColor
     */
    public function setMainColor(string $mainColor): void
    {
        $this->mainColor = $mainColor;
    }

    /**
     * @return string
     */
    public function getLinksColor(): string
    {
        return $this->linksColor;
    }

    /**
     * @param string $linksColor
     */
    public function setLinksColor(string $linksColor): void
    {
        $this->linksColor = $linksColor;
    }

    /**
     * @return string
     */
    public function getTextPrimaryColor(): string
    {
        return $this->textPrimaryColor;
    }

    /**
     * @param string $textPrimaryColor
     */
    public function setTextPrimaryColor(string $textPrimaryColor): void
    {
        $this->textPrimaryColor = $textPrimaryColor;
    }

    /**
     * @return string
     */
    public function getTextSecondaryColor(): string
    {
        return $this->textSecondaryColor;
    }

    /**
     * @param string $textSecondaryColor
     */
    public function setTextSecondaryColor(string $textSecondaryColor): void
    {
        $this->textSecondaryColor = $textSecondaryColor;
    }

    /**
     * @return string
     */
    public function getHeaderImg(): string
    {
        return $this->headerImg;
    }

    /**
     * @param string $headerImg
     */
    public function setHeaderImg(string $headerImg): void
    {
        $this->headerImg = $headerImg;
    }

    /**
     * @return string
     */
    public function getHeaderColor(): string
    {
        return $this->headerColor;
    }

    /**
     * @param string $headerColor
     */
    public function setHeaderColor(string $headerColor): void
    {
        $this->headerColor = $headerColor;
    }

    /**
     * @return string
     */
    public function getBackgroundImg(): string
    {
        return $this->backgroundImg;
    }

    /**
     * @param string $backgroundImg
     */
    public function setBackgroundImg(string $backgroundImg): void
    {
        $this->backgroundImg = $backgroundImg;
    }

    /**
     * @return string
     */
    public function getCssAdd(): string
    {
        return $this->cssAdd;
    }

    /**
     * @param string $cssAdd
     */
    public function setCssAdd(string $cssAdd): void
    {
        $this->cssAdd = $cssAdd;
    }

    /**
     * @return int
     */
    public function getFwId(): int
    {
        return $this->fwId;
    }

    /**
     * @param int $fwId
     */
    public function setFwId(int $fwId): void
    {
        $this->fwId = $fwId;
    }


}

