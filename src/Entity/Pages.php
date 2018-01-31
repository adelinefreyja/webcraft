<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pages
 *
 * @ORM\Table(name="pages")
 * @ORM\Entity
 */
class Pages
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
     * @ORM\Column(name="page_title", type="string", length=255, nullable=false)
     */
    private $pageTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="page_name", type="string", length=255, nullable=false)
     */
    private $pageName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="page_date", type="datetime", nullable=false)
     */
    private $pageDate;

    /**
     * @var string
     *
     * @ORM\Column(name="page_content", type="text", nullable=false)
     */
    private $pageContent;

    /**
     * @var string
     *
     * @ORM\Column(name="page_status", type="string", length=30, nullable=false)
     */
    private $pageStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_status", type="string", length=30, nullable=false)
     */
    private $commentStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="page_type", type="string", length=255, nullable=true)
     */
    private $pageType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="page_modified", type="datetime", nullable=true)
     */
    private $pageModified;

    /**
     * @var integer
     *
     * @ORM\Column(name="page_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pageId;

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param integer $userId
     *
     * @return self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @param integer $pageTitle
     *
     * @return self
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @param integer $pageName
     *
     * @return self
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageDate()
    {
        return $this->pageDate;
    }

    /**
     * @param \Datetime $pageDate
     *
     * @return self
     */
    public function setPageDate($pageDate)
    {
        $this->pageDate = $pageDate;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPageContent()
    {
        return $this->pageContent;
    }

    /**
     * @param integer $pageContent
     *
     * @return self
     */
    public function setPageContent($pageContent)
    {
        $this->pageContent = $pageContent;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPageStatus()
    {
        return $this->pageStatus;
    }

    /**
     * @param integer $pageStatus
     *
     * @return self
     */
    public function setPageStatus($pageStatus)
    {
        $this->pageStatus = $pageStatus;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCommentStatus()
    {
        return $this->commentStatus;
    }

    /**
     * @param integer $commentStatus
     *
     * @return self
     */
    public function setCommentStatus($commentStatus)
    {
        $this->commentStatus = $commentStatus;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPageType()
    {
        return $this->pageType;
    }

    /**
     * @param integer $pageType
     *
     * @return self
     */
    public function setPageType($pageType)
    {
        $this->pageType = $pageType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageModified()
    {
        return $this->pageModified;
    }

    /**
     * @param integer $pageModified
     *
     * @return self
     */
    public function setPageModified($pageModified)
    {
        $this->pageModified = $pageModified;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param integer $pageId
     *
     * @return self
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;

        return $this;
    }
}
