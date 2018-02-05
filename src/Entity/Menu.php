<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pages
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity
 */
class Menu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="rank_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rankId;

    /**
     * @var integer
     *
     * @ORM\Column(name="menu_rank", type="integer", nullable=false)
     *
     */
    private $menuRank;

    /**
     * @var string
     *
     * @ORM\Column(name="page_name", type="string")
     */
    private $pageName;



    /**
     * @return integer
     */
    public function getMenuRank()
    {
        return $this->menuRank;
    }

    /**
     * @param integer $menuRank
     *
     * @return self
     */
    public function setMenuRank($menuRank)
    {
        $this->menuRank = $menuRank;

        return $this;
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @param string $pageName
     *
     * @return self
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRankId()
    {
        return $this->rankId;
    }

    /**
     * @param integer $rankId
     *
     * @return self
     */
    public function setRankId($rankId)
    {
        $this->rankId = $rankId;

        return $this;
    }
}
