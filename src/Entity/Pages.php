<?php

namespace AppBundle\Entity;

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


}

