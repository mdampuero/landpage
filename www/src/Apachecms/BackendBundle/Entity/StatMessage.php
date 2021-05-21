<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * StatMessage
 *
 * @ORM\Table(name="stat_message")
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\StatMessageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class StatMessage
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
     * @ORM\ManyToOne(targetEntity="Stat")
     * @ORM\JoinColumn(name="stat", referencedColumnName="id",nullable=true)
     */

    private $stat;

    /**
     * @var string
     *
     * @ORM\Column(name="user_from", type="string",nullable=true, length=255)
     */
    private $userFrom;
    
   /**
     * @var string
     *
     * @ORM\Column(name="message", type="string",nullable=true, length=255)
     */
    private $message;

    
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
     * Set stat.
     *
     * @param string $stat
     *
     * @return StatMessage
     */
    public function setStat($stat)
    {
        $this->stat = $stat;

        return $this;
    }

    /**
     * Get stat.
     *
     * @return string
     */
    public function getStat()
    {
        return $this->stat;
    }
    
    /**
     * Set userFrom.
     *
     * @param string $userFrom
     *
     * @return Landing
     */
    public function setUserFrom($userFrom)
    {
        $this->userFrom = $userFrom;

        return $this;
    }

    /**
     * Get userFrom.
     *
     * @return string
     */
    public function getUserFrom()
    {
        return $this->userFrom;
    }
    
    /**
     * Set message.
     *
     * @param string $message
     *
     * @return Landing
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return StatMessage
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
     * @return StatMessage
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
     * @return StatMessage
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
