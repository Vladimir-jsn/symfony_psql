<?php


namespace App\Project\Infrastructure\Order;

use App\Project\App\Support\AppEntityRepository;
use App\Project\Domain\Order\Entity\Order;
use Symfony\Component\HttpFoundation\Request;

class OrderRepository extends AppEntityRepository
{

    public function getOrders()
    {
        $qb = $this->createQueryBuilder('a');

        return $qb->getQuery();
    }

    public function save(Order $Order)
    {
        $this->_em->persist($Order);
        $this->_em->flush();
    }
}