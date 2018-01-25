<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Options
 *
 * @ORM\Table(name="options", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_D035FA87A536B7BB", columns={"optionname"}), @ORM\UniqueConstraint(name="UNIQ_D035FA87A85C82CC", columns={"optionvalue"})})
 * @ORM\Entity
 */
class Options
{
    /**
     * @var string
     *
     * @ORM\Column(name="optionname", type="string", length=50, nullable=false)
     */
    private $optionname;

    /**
     * @var string
     *
     * @ORM\Column(name="optionvalue", type="string", length=50, nullable=false)
     */
    private $optionvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="sitetype", type="string", length=255, nullable=false)
     */
    private $sitetype;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

