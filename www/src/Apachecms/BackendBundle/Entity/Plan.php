<?php

namespace Apachecms\BackendBundle\Entity;

use     Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Plan
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\PlanRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"nameEs"}, repositoryMethod="getUniqueNotDeleted")
 * 
 */
class Plan
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name_es", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nameEs;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nameEn", type="string", length=255,nullable=true)
     */
    private $nameEn;
    
    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", scale=2, precision=10)
     * @Assert\NotBlank()
     * @Assert\Type(
     *      type="float"
     * )
     */
    private $price;
    
    /**
     * @var float
     *
     * @ORM\Column(name="percent_discount", type="float", scale=2, precision=10)
     * @Assert\NotBlank()
     * @Assert\Type(
     *      type="float"
     * )
     */
    private $percentDiscount=0;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="trial_days", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(
     *      type="integer"
     * )
     */
    private $trialDays;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="max_visits", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(
     *      type="integer"
     * )
     */
    private $maxVisits=0;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="max_leads", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(
     *      type="integer"
     * )
     */
    private $maxLeads=0;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_show", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(
     *      type="integer"
     * )
     */
    private $order;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="max_landing", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(
     *      type="integer"
     * )
     */
    private $maxLanding;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="max_business", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(
     *      type="integer"
     * )
     */
    private $maxBusiness;

     /**
     * @var bool
     *
     * @ORM\Column(name="support_email", type="boolean")
     */
    private $supportEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="description_es", type="text",nullable=true)
     */
    private $descriptionEs;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description_en", type="text",nullable=true)
     */
    private $descriptionEn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_delete", type="boolean")
     */
    private $isDelete;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set nameEs.
     *
     * @param string $nameEs
     *
     * @return Plan
     */
    public function setNameEs($nameEs)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * Get nameEs.
     *
     * @return string
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }
    
    /**
     * Set descriptionEs.
     *
     * @param string $descriptionEs
     *
     * @return Plan
     */
    public function setDescriptionEs($descriptionEs)
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * Get descriptionEs.
     *
     * @return string
     */
    public function getDescriptionEs()
    {
        return $this->descriptionEs;
    }
    
    /**
     * Set descriptionEn.
     *
     * @param string $descriptionEn
     *
     * @return Plan
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * Get descriptionEn.
     *
     * @return string
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }
    
    /**
     * Set maxBusiness.
     *
     * @param integer $maxBusiness
     *
     * @return Plan
     */    
    public function setMaxBusiness($maxBusiness)
    {
        $this->maxBusiness = $maxBusiness;

        return $this;
    }

    /**
     * Get maxBusiness.
     *
     * @return integer
     */
    public function getMaxBusiness()
    {
        return $this->maxBusiness;
    }
    
    /**
     * Set order.
     *
     * @param integer $order
     *
     * @return Plan
     */    
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order.
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }
    
    /**
     * Set maxLanding.
     *
     * @param integer $maxLanding
     *
     * @return Plan
     */
    public function setMaxLanding($maxLanding)
    {
        $this->maxLanding = $maxLanding;

        return $this;
    }

    /**
     * Get maxLanding.
     *
     * @return integer
     */
    public function getMaxLanding()
    {
        return $this->maxLanding;
    }
    
    /**
     * Set maxVisits.
     *
     * @param integer $maxVisits
     *
     * @return Plan
     */
    public function setMaxVisits($maxVisits)
    {
        $this->maxVisits = $maxVisits;

        return $this;
    }

    /**
     * Get maxVisits.
     *
     * @return integer
     */
    public function getMaxVisits()
    {
        return $this->maxVisits;
    }

    /**
     * Set maxLeads.
     *
     * @param integer $maxLeads
     *
     * @return Plan
     */
    public function setMaxLeads($maxLeads)
    {
        $this->maxLeads = $maxLeads;

        return $this;
    }

    /**
     * Get maxLeads.
     *
     * @return integer
     */
    public function getMaxLeads()
    {
        return $this->maxLeads;
    }
    
    /**
     * Set trialDays.
     *
     * @param integer $trialDays
     *
     * @return Plan
     */
    public function setTrialDays($trialDays)
    {
        $this->trialDays = $trialDays;

        return $this;
    }

    /**
     * Get trialDays.
     *
     * @return integer
     */
    public function getTrialDays()
    {
        return $this->trialDays;
    }
    
    /**
     * Set nameEn.
     *
     * @param string $nameEn
     *
     * @return Plan
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get nameEn.
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }
    
    /**
     * Set percentDiscount.
     *
     * @param string $percentDiscount
     *
     * @return Plan
     */
    public function setPercentDiscount($percentDiscount)
    {
        $this->percentDiscount = $percentDiscount;

        return $this;
    }

    /**
     * Get percentDiscount.
     *
     * @return string
     */
    public function getPercentDiscount()
    {
        return $this->percentDiscount;
    }
    
    /**
     * Set price.
     *
     * @param string $price
     *
     * @return Plan
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
    
    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return Site
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete.
     *
     * @return bool
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * Set supportEmail.
     *
     * @param bool $supportEmail
     *
     * @return Site
     */
    public function setSupportEmail($supportEmail)
    {
        $this->supportEmail = $supportEmail;

        return $this;
    }

    /**
     * Get supportEmail.
     *
     * @return bool
     */
    public function getSupportEmail()
    {
        return $this->supportEmail;
    }

    /**
     * Get price.
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->isDelete=false;
        $this->createdAt=new \DateTime();
    }
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt=new \DateTime();
    }
}
