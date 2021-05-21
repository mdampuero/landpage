<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * LandingTestOption
 *
 * @ORM\Table(name="landing_test_option")
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\LandingTestOptionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class LandingTestOption
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
     * @ORM\ManyToOne(targetEntity="LandingTest")
     * @ORM\JoinColumn(name="test", referencedColumnName="id",nullable=true)
     */

    private $test;


    /**
     * @var integer
     *
     * @ORM\Column(name="option_number", type="integer")
     */
    private $optionNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="visits", type="integer",nullable=true)
     */
    private $visits=0;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="leads", type="integer",nullable=true)
     */
    private $leads=0;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="convertions", type="float",nullable=true)
     */
    private $convertions=0;
    
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
     * Set test.
     *
     * @param string $test
     *
     * @return LandingTestOption
     */
    public function setTest($test)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test.
     *
     * @return string
     */
    public function getTest()
    {
        return $this->test;
    }
    
    /**
     * Set visits.
     *
     * @param integer $visits
     *
     * @return Landing
     */
    public function setVisits($visits)
    {
        $this->visits = $visits;

        return $this;
    }

    /**
     * Get visits.
     *
     * @return integer
     */
    public function getVisits()
    {
        return $this->visits;
    }
    
    /**
     * Set optionNumber.
     *
     * @param integer $optionNumber
     *
     * @return Landing
     */
    public function setOptionNumber($optionNumber)
    {
        $this->optionNumber = $optionNumber;

        return $this;
    }

    /**
     * Get optionNumber.
     *
     * @return integer
     */
    public function getOptionNumber()
    {
        return $this->optionNumber;
    }
    
    /**
     * Set leads.
     *
     * @param integer $leads
     *
     * @return Landing
     */
    public function setLeads($leads)
    {
        $this->leads = $leads;

        return $this;
    }

    /**
     * Get leads.
     *
     * @return integer
     */
    public function getLeads()
    {
        return $this->leads;
    }
    
    /**
     * Set convertions.
     *
     * @param integer $convertions
     *
     * @return Landing
     */
    public function setConvertions()
    {
        
        $this->convertions = ($this->getLeads()*100)/$this->getVisits();

        return $this;
    }

    /**
     * Get convertions.
     *
     * @return integer
     */
    public function getConvertions()
    {
        return $this->convertions;
    }


    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return LandingTestOption
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
     * @return LandingTestOption
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
     * @return LandingTestOption
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
