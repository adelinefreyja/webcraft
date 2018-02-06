<?php

namespace App\Repository;

use App\Entity\Pages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pages::class);
    }

    
    // public function orderPages($pagename):array
    // {
    // 	$rawSql = 
    //         "SELECT * FROM menu m, pages p
    //         WHERE m.page_name = p.page_name
    //         ORDER BY m.menu_rank ASC
    // 	";

    // 	$stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
    // 	$stmt->execute();

    //     return $stmt->fetchAll();
    // }

}
