<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Criteria;

/**
 * LandingTest
 *
 * @ORM\Table(name="landing_test")
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\LandingTestRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class LandingTest
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
     * One test has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="LandingTestOption", mappedBy="test",cascade={"persist"})
     * @ORM\OrderBy({"convertions" = "DESC"})
     */
    private $options;

    /**
     * @var string
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Landing")
     * @ORM\JoinColumn(name="landing", referencedColumnName="id",nullable=true)
     */

    private $landing;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_at", type="datetime")
     */
    private $fromAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="to_at", type="datetime")
     */
    private $toAt;
    
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
     * @var bool
     *
     * @ORM\Column(name="is_complete", type="boolean")
     */
    private $isComplete=false;

    public function __construct($landing)
    {
        $this->landing=$landing;
        $this->fromAt = new \DateTime(); 
        $now=new \DateTime();
        $this->toAt = $now->modify('+1 week'); 
    }

    /**
     * Get options
     *
     * @return string
     */
    public function getOptions()
    {
        $criteria = Criteria::create();
        $criteria
        ->where(Criteria::expr()->eq('isDelete', false))
        ->orderBy(
            array(
                'convertions' => Criteria::DESC
                )
        );
        return $this->options->matching($criteria);
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
     * Set landing.
     *
     * @param string $landing
     *
     * @return LandingTest
     */
    public function setLanding($landing)
    {
        $this->landing = $landing;

        return $this;
    }

    /**
     * Get landing.
     *
     * @return string
     */
    public function getLanding()
    {
        return $this->landing;
    }
    

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return LandingTest
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
     * Set fromAt.
     *
     * @param \DateTime $fromAt
     *
     * @return LandingTest
     */
    public function setFromAt($fromAt)
    {
        $this->fromAt = $fromAt;

        return $this;
    }

    /**
     * Get fromAt.
     *
     * @return \DateTime
     */
    public function getFromAt()
    {
        return $this->fromAt;
    }
    
    /**
     * Set toAt.
     *
     * @param \DateTime $toAt
     *
     * @return LandingTest
     */
    public function setToAt($toAt)
    {
        $this->toAt = $toAt;

        return $this;
    }

    /**
     * Get toAt.
     *
     * @return \DateTime
     */
    public function getToAt()
    {
        return $this->toAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return LandingTest
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
     * @return LandingTest
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
     * Set isComplete.
     *
     * @param bool $isComplete
     *
     * @return LandingTest
     */
    public function setIsComplete($isComplete)
    {
        $this->isComplete = $isComplete;

        return $this;
    }

    /**
     * Get isComplete.
     *
     * @return bool
     */
    public function getIsComplete()
    {
        return $this->isComplete;
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
