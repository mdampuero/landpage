<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CustomerTransaction
 *
 * @ORM\Table(name="customer_transaction")
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\CustomerTransactionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CustomerTransaction
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
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumn(name="customer", referencedColumnName="id")
     */

    private $customer;

    /**
     * @var float
     *
     * @ORM\Column(name="import", type="float", scale=2, precision=10)
     * @Assert\Type(
     *      type="float"
     * )
     */
    private $import;
    
    /**
     * @var float
     *
     * @ORM\Column(name="status", type="string", length=64, nullable=true)
     */
    private $status='pending';
    
    /**
     * @var float
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type=1;
    
    /**
     * @var float
     *
     * @ORM\Column(name="back_url", type="string", length=255, nullable=true)
     */
    private $backUrl;
    
    /**
     * @var float
     *
     * @ORM\Column(name="collection_id", type="string", length=255, nullable=true)
     */
    private $collectionId;
    
    /**
     * @var float
     *
     * @ORM\Column(name="collection_status", type="string", length=255, nullable=true)
     */
    private $collectionStatus;
    
    /**
     * @var float
     *
     * @ORM\Column(name="external_reference", type="string", length=255, nullable=true)
     */
    private $externalReference;
    
    /**
     * @var float
     *
     * @ORM\Column(name="payment_type", type="string", length=255, nullable=true)
     */
    private $paymentType;
    
    /**
     * @var float
     *
     * @ORM\Column(name="preference_id", type="string", length=255, nullable=true)
     */
    private $preferenceId;
   
    /**
     * @var float
     *
     * @ORM\Column(name="status_description", type="string", length=255, nullable=true)
     */
    private $statusDescription='pending';

    /**
     * @var boolean|null
     *
     * @ORM\Column(name="is_trial", type="boolean")
     */
    private $isTrial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expired_at", type="datetime")
     */
    private $expiredAt;
    
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

    public function __construct($planEntity,$isTrial,$customer,$type)
    {   
        $this->isTrial=$isTrial;
        $now=new \DateTime();
        $this->type=$type;
        if($isTrial==1){
            $this->status='approved';
            $this->statusDescription='approved';
            $this->import=0;
            $this->expiredAt=$now->modify('+'.$planEntity->getTrialDays().' days');
            $customer->setExpirationPlan($this->expiredAt);
        }else{
            if($type==12){
                $this->import=(($planEntity->getPrice() * 12) * (1 - $planEntity->getPercentDiscount()/100));
                $this->expiredAt=$now->modify('+1 years');
            }else{
                $this->import=$planEntity->getPrice();
                $this->expiredAt=$now->modify('+1 months');
            }
        }
        $this->customer=$customer;
    }

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
     * Set statusDescription.
     *
     * @param string $statusDescription
     *
     * @return CustomerTransaction
     */
    public function setStatusDescription($statusDescription)
    {
        $this->statusDescription = $statusDescription;

        return $this;
    }

    /**
     * Get statusDescription.
     *
     * @return string
     */
    public function getStatusDescription()
    {
        return $this->statusDescription;
    }
    
    /**
     * Set status.
     *
     * @param string $status
     *
     * @return CustomerTransaction
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Set externalReference.
     *
     * @param string $externalReference
     *
     * @return CustomerTransaction
     */
    public function setExternalReference($externalReference)
    {
        $this->externalReference = $externalReference;

        return $this;
    }

    /**
     * Get externalReference.
     *
     * @return string
     */
    public function getExternalReference()
    {
        return $this->externalReference;
    }
    
    /**
     * Set preferenceId.
     *
     * @param string $preferenceId
     *
     * @return CustomerTransaction
     */
    public function setPreferenceId($preferenceId)
    {
        $this->preferenceId = $preferenceId;

        return $this;
    }

    /**
     * Get preferenceId.
     *
     * @return string
     */
    public function getPreferenceId()
    {
        return $this->preferenceId;
    }
    
    /**
     * Set paymentType.
     *
     * @param string $paymentType
     *
     * @return CustomerTransaction
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType.
     *
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }
    
    /**
     * Set collectionStatus.
     *
     * @param string $collectionStatus
     *
     * @return CustomerTransaction
     */
    public function setCollectionStatus($collectionStatus)
    {
        $this->collectionStatus = $collectionStatus;

        return $this;
    }

    /**
     * Get collectionStatus.
     *
     * @return string
     */
    public function getCollectionStatus()
    {
        return $this->collectionStatus;
    }
    
    /**
     * Set backUrl.
     *
     * @param string $backUrl
     *
     * @return CustomerTransaction
     */
    public function setBackUrl($backUrl)
    {
        $this->backUrl = $backUrl;

        return $this;
    }

    /**
     * Get backUrl.
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->backUrl;
    }
    
    /**
     * Set collectionId.
     *
     * @param string $collectionId
     *
     * @return CustomerTransaction
     */
    public function setCollectionId($collectionId)
    {
        $this->collectionId = $collectionId;

        return $this;
    }

    /**
     * Get collectionId.
     *
     * @return string
     */
    public function getCollectionId()
    {
        return $this->collectionId;
    }
    
    /**
     * Set customer.
     *
     * @param string $customer
     *
     * @return CustomerTransaction
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer.
     *
     * @return string
     */
    public function getCustomer()
    {
        return $this->customer;
    }
    
    /**
     * Set type.
     *
     * @param string $type
     *
     * @return CustomerTransaction
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set import.
     *
     * @param float $import
     *
     * @return CustomerTransaction
     */
    public function setImport($import)
    {
        $this->import = $import;

        return $this;
    }

    /**
     * Get import.
     *
     * @return float
     */
    public function getImport()
    {
        return $this->import;
    }
    
    /**
     * Set IsTrial.
     *
     * @param boolean $IsTrial
     *
     * @return CustomerTransaction
     */
    public function setIsTrial($IsTrial)
    {
        $this->IsTrial = $IsTrial;

        return $this;
    }

    /**
     * Get IsTrial.
     *
     * @return boolean
     */
    public function getIsTrial()
    {
        return $this->IsTrial;
    }

    /**
     * Set expiredAt.
     *
     * @param \DateTime $expiredAt
     *
     * @return CustomerTransaction
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    /**
     * Get expiredAt.
     *
     * @return \DateTime
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }
    
    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return CustomerTransaction
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return CustomerTransaction
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return CustomerTransaction
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
