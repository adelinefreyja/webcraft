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
     * @ORM\Column(name="background_color", type="string", length=20)
     */
    private $backgroundColor;

    /**
     * @var string
     *
     * @ORM\Column(name="links_color", type="string", length=20)
     */
    private $linksColor;

    /**
     * @var string
     *
     * @ORM\Column(name="text_primary_color", type="string", length=20)
     */
    private $textPrimaryColor;

    /**
     * @var string
     *
     * @ORM\Column(name="text_secondary_color", type="string", length=20)
     */
    private $textSecondaryColor;

    /**
     * @var string
     *
     * @ORM\Column(name="header_img", type="string", length=20)
     */
    private $headerImg;

    /**
     * @var string
     *
     * @ORM\Column(name="header_color", type="string", length=20)
     */
    private $headerColor;

    /**
     * @var string
     *
     * @ORM\Column(name="background_img", type="string", length=20)
     */
    private $backgroundImg;

    /**
     * @var string
     *
     * @ORM\Column(name="template_name", type="string", length=20, nullable=false)
     */
    private $templateName;

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
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param string $backgroundColor
     *
     * @return self
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getLinksColor()
    {
        return $this->linksColor;
    }

    /**
     * @param string $linksColor
     *
     * @return self
     */
    public function setLinksColor($linksColor)
    {
        $this->linksColor = $linksColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextPrimaryColor()
    {
        return $this->textPrimaryColor;
    }

    /**
     * @param string $textPrimaryColor
     *
     * @return self
     */
    public function setTextPrimaryColor($textPrimaryColor)
    {
        $this->textPrimaryColor = $textPrimaryColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextSecondaryColor()
    {
        return $this->textSecondaryColor;
    }

    /**
     * @param string $textSecondaryColor
     *
     * @return self
     */
    public function setTextSecondaryColor($textSecondaryColor)
    {
        $this->textSecondaryColor = $textSecondaryColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeaderImg()
    {
        return $this->headerImg;
    }

    /**
     * @param string $headerImg
     *
     * @return self
     */
    public function setHeaderImg($headerImg)
    {
        $this->headerImg = $headerImg;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeaderColor()
    {
        return $this->headerColor;
    }

    /**
     * @param string $headerColor
     *
     * @return self
     */
    public function setHeaderColor($headerColor)
    {
        $this->headerColor = $headerColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundImg()
    {
        return $this->backgroundImg;
    }

    /**
     * @param string $backgroundImg
     *
     * @return self
     */
    public function setBackgroundImg($backgroundImg)
    {
        $this->backgroundImg = $backgroundImg;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * @param string $templateName
     *
     * @return self
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFwId()
    {
        return $this->fwId;
    }

    /**
     * @param integer $fwId
     *
     * @return self
     */
    public function setFwId($fwId)
    {
        $this->fwId = $fwId;

        return $this;
    }
}

