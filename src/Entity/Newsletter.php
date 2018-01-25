<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter")
 * @ORM\Entity
 */
class Newsletter
{
    /**
     * @var string
     *
     * @ORM\Column(name="email_value", type="string", length=255, nullable=false)
     */
    private $emailValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="email_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $emailId;


}

