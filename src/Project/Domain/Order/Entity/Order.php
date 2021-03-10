<?php

namespace App\Project\Domain\Order\Entity;


use App\Project\Domain\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Order
 */
class Order
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var string
     */
    protected $customer;

    /**
     * @var string
     */
    protected $address1;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $postcode;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $deleted;

    /**
     * @var DateTime
     */
    protected $lastModified;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
 
    /**
     * @return string
     */
    public function getCustomer(): string
    {
        return $this->customer;
    }

    /**
     * Set Customer
     * 
     * @param string $customer Customer
     * 
     * @return void
     */
    public function setCustomer(string $customer)
    {
        $this->customer = $customer;
    }

    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    public function getAddress1()
    {
        return $this->address1;
    }

    public function setDate($date)
    {
        $this->date = new \DateTime($date);
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setLastModified($lastModified)
    {
        $this->lastModified = new \DateTime($lastModified);
    }

    public function getLastModified()
    {
        return $this->lastModified;
    }
}