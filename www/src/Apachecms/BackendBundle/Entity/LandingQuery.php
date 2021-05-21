<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Criteria;
/**
 * LandingQuery
 *
 * @ORM\Table(name="landing_query")
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\LandingQueryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class LandingQuery
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
     * One customer has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="LandingReply", mappedBy="query",cascade={"persist"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $answers;

    /**
     * @var string
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Landing")
     * @ORM\JoinColumn(name="landing", referencedColumnName="id",nullable=true)
     */

    private $landing;

    /**
     * @var string
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="LandingContact")
     * @ORM\JoinColumn(name="contact", referencedColumnName="id",nullable=true)
     */

    private $contact;
    
    /**
     * @var string
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Stat")
     * @ORM\JoinColumn(name="stats", referencedColumnName="id",nullable=true)
     */

    private $stats;

    /**
     * @var string
     *
     * @ORM\Column(name="query", type="text")
     */
    private $query;
    
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string",length=255, nullable=true)
     */
    private $type;

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
     * @ORM\Column(name="is_reply", type="boolean")
     */
    private $isReply;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="is_read", type="boolean")
     */
    private $isRead;


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
     * Get answers
     *
     * @return string
     */
    public function getAnswers()
    {
        $criteria = Criteria::create();
        $criteria
        ->where(Criteria::expr()->eq('isDelete', false))
        ->orderBy(
            array(
                // 'isPublished' => Criteria::DESC,
                // 'publishedAt' => Criteria::DESC,
                'createdAt' => Criteria::DESC
                )
        );
        return $this->answers->matching($criteria);
    }

    /**
     * Set landing.
     *
     * @param string $landing
     *
     * @return LandingQuery
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
     * Set contact.
     *
     * @param string $contact
     *
     * @return LandingQuery
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact.
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }
    
    /**
     * Set type.
     *
     * @param string $type
     *
     * @return LandingQuery
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
     * Set stats.
     *‡
     * @param string $stats
     *
     * @return LandingQuery
     */
    public function setStats($stats)
    {
        $this->stats = $stats;

        return $this;
    }

    /**
     * Get stats.
     *
     * @return string
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * Set query.
     *
     * @param string $query
     *
     * @return LandingQuery
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get query.
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return LandingQuery
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
     * @return LandingQuery
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
     * @return LandingQuery
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
     * Set isReply.
     *
     * @param bool $isReply
     *
     * @return LandingQuery
     */
    public function setIsReply($isReply)
    {
        $this->isReply = $isReply;

        return $this;
    }

    /**
     * Get isReply.
     *
     * @return bool
     */
    public function getIsReply()
    {
        return $this->isReply;
    }
    
    /**
     * Set isRead.
     *
     * @param bool $isRead
     *
     * @return LandingQuery
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get isRead.
     *
     * @return bool
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->isDelete=false;
        $this->isReply=false;
        $this->isRead=false;
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
