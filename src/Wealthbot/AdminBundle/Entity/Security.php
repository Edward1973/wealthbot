<?php

namespace Wealthbot\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Wealthbot\AdminBundle\Entity\Security
 */
class Security
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer
     */
    private $security_type_id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $symbol
     */
    private $symbol;

    /**
     * @var float
     */
    private $expense_ratio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $securityAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $securityPrices;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->securityAssignments = new ArrayCollection();
        $this->securityPrices = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Security
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     * @return Security
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    
        return $this;
    }

    /**
     * Get symbol
     *
     * @return string 
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Add security assignment
     *
     * @param \Wealthbot\ClientBundle\Entity\AccountOutsideFund $securities
     * @return Security
     */
    public function addSecurityAssignment(\Wealthbot\ClientBundle\Entity\AccountOutsideFund $securities)
    {
        $this->securityAssignments[] = $securities;
    
        return $this;
    }

    /**
     * Remove security assignment
     *
     * @param \Wealthbot\ClientBundle\Entity\AccountOutsideFund $securities
     */
    public function removeSecurityAssignment(\Wealthbot\ClientBundle\Entity\AccountOutsideFund $securities)
    {
        $this->securityAssignments->removeElement($securities);
    }

    /**
     * Get securityAssignments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSecurityAssignments()
    {
        return $this->securityAssignments;
    }

    /**
     * Set security_type_id
     *
     * @param integer $securityTypeId
     * @return Security
     */
    public function setSecurityTypeId($securityTypeId)
    {
        $this->security_type_id = $securityTypeId;
    
        return $this;
    }

    /**
     * Get security_type_id
     *
     * @return integer 
     */
    public function getSecurityTypeId()
    {
        return $this->security_type_id;
    }

    /**
     * Set expense_ratio
     *
     * @param float $expenseRatio
     * @return Security
     */
    public function setExpenseRatio($expenseRatio)
    {
        $this->expense_ratio = $expenseRatio;
    
        return $this;
    }

    /**
     * Get expense_ratio
     *
     * @return float 
     */
    public function getExpenseRatio()
    {
        return $this->expense_ratio;
    }
    /**
     * @var \Wealthbot\AdminBundle\Entity\SecurityType
     */
    private $securityType;


    /**
     * Set securityType
     *
     * @param \Wealthbot\AdminBundle\Entity\SecurityType $securityType
     * @return Security
     */
    public function setSecurityType(\Wealthbot\AdminBundle\Entity\SecurityType $securityType = null)
    {
        $this->securityType = $securityType;
    
        return $this;
    }

    /**
     * Get securityType
     *
     * @return \Wealthbot\AdminBundle\Entity\SecurityType 
     */
    public function getSecurityType()
    {
        return $this->securityType;
    }

    /**
     * Add securityPrices
     *
     * @param SecurityPrice $securityPrices
     * @return Security
     */
    public function addSecurityPrice(\Wealthbot\AdminBundle\Entity\SecurityPrice $securityPrices)
    {
        $this->securityPrices[] = $securityPrices;
    
        return $this;
    }

    /**
     * Remove securityPrices
     *
     * @param SecurityPrice $securityPrices
     */
    public function removeSecurityPrice(\Wealthbot\AdminBundle\Entity\SecurityPrice $securityPrices)
    {
        $this->securityPrices->removeElement($securityPrices);
    }

    /**
     * Get securityPrices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSecurityPrices()
    {
        return $this->securityPrices;
    }

    /**
     * Get security type description
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->getSecurityType() ? $this->getSecurityType()->getDescription() : null;
    }

    /**
     * Get security type code
     *
     * @return string|null
     */
    public function getTypeCode()
    {
        return $this->getSecurityType() ? $this->getSecurityType()->getName() : null;
    }
}
