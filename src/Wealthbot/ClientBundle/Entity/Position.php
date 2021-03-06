<?php

namespace Wealthbot\ClientBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Wealthbot\AdminBundle\Entity\Security;

/**
 * Trade Position, aggregates from lots for that account, security and date.
 */
class Position
{
    const POSITION_STATUS_INITIAL = 1; //status when shares was bought, i.e. first position.
    const POSITION_STATUS_IS_OPEN = 2;
    const POSITION_STATUS_IS_CLOSE = 3; //status when shares was sold, i.e. last position.
    const POSITION_STATUS_IS_NOT_VERIFIED = 4;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $quantity;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var SystemAccount
     */
    private $clientSystemAccount;

    /**
     * @var Security
     */
    private $security;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var ArrayCollection|Lot[]
     */
    private $lots;


    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->status = self::POSITION_STATUS_IS_OPEN;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param float $quantity
     * @return Position
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return float 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return Position
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Position
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set clientSystemAccount
     *
     * @param \Wealthbot\ClientBundle\Entity\SystemAccount $clientSystemAccount
     * @return Position
     */
    public function setClientSystemAccount(\Wealthbot\ClientBundle\Entity\SystemAccount $clientSystemAccount = null)
    {
        $this->clientSystemAccount = $clientSystemAccount;
    
        return $this;
    }

    /**
     * Get clientSystemAccount
     *
     * @return \Wealthbot\ClientBundle\Entity\SystemAccount 
     */
    public function getClientSystemAccount()
    {
        return $this->clientSystemAccount;
    }

    /**
     * Set security
     *
     * @param \Wealthbot\AdminBundle\Entity\Security $security
     * @return Position
     */
    public function setSecurity(\Wealthbot\AdminBundle\Entity\Security $security = null)
    {
        $this->security = $security;
    
        return $this;
    }

    /**
     * Get security
     *
     * @return \Wealthbot\AdminBundle\Entity\Security
     */
    public function getSecurity()
    {
        return $this->security;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection|\Wealthbot\ClientBundle\Entity\Lot[] $lots
     */
    public function setLots($lots)
    {
        $this->lots = $lots;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\Wealthbot\ClientBundle\Entity\Lot[]
     */
    public function getLots()
    {
        return $this->lots;
    }

    /**
     * @param Lot $lot
     * @return $this
     */
    public function addLot(Lot $lot)
    {
        $this->lots->add($lot);
        return $this;
    }

    /**
     * @param Lot $lot
     * @return $this
     */
    public function removeLot(Lot $lot)
    {
        $this->lots->removeElement($lot);
        return $this;
    }

}
