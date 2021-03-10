<?php

namespace App\DataFixtures;

use App\Project\Domain\Order\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class OrderFixtures extends Fixture  
{
    public function load(ObjectManager $manager)
    {
        $string = file_get_contents(dirname(__FILE__)."/orders.json");
        $json_a = json_decode($string, true);

        foreach ($json_a as $o) {
            $order = new Order();

            $order->setId($o["id"]);
            $order->setDate($o["date"]);
            $order->setAddress1($o["address1"]);
            $order->setCity($o["city"]);
            $order->setCustomer($o["customer"]);
            $order->setPostcode($o["postcode"]);
            $order->setCountry($o["country"]);
            $order->setAmount($o["amount"]);
            $order->setStatus($o["status"]);
            $order->setDeleted($o["deleted"]);
            $order->setLastModified($o["last_modified"]);

            $manager->persist($order);
            $manager->flush();
        }
    }
}
