<?php


namespace App\Project\Domain\Order;


use App\Project\Domain\Order\Entity\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    /**
     * Transforms Order to Array
     * 
     * @param Order $order Order
     * 
     * @return array
     */
    public function transform(Order $order)
    {
        return [
            'id' => $order->getId(),
            'address1' => $order->getAddress1(),
            'date' => $order->getDate()->format('Y-m-d\TH:i:s.u'),
            'postcode' => $order->getPostcode(),
            'country' => $order->getCountry(),
            'amount' => $order->getAmount(),
            'status' => $order->getStatus(),
            'deleted' => $order->getDeleted(),
            'last_modified' => $order->getLastModified()->format('Y-m-d\TH:i:s.u'),
            'city' => $order->getCity(),
            'customer' => $order->getCustomer()
        ];
    }

}