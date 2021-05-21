<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LandingChatbot
 *
 * @ORM\Table(name="landing_chatbot")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\LandingChatbotRepository")
 */
class LandingChatbot
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
     * One Cart has One Landing.
     * @ORM\OneToOne(targetEntity="Landing", inversedBy="cart")
     * @ORM\JoinColumn(name="landing_id", referencedColumnName="id")
     */
    private $landing;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avatar_name", type="text", nullable=true)
     */
    private $avatarName='Carolina';
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="welcome", type="text", nullable=true)
     */
    private $welcome='Hola ¿En qué te puedo ayudar?';
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="avatar_picture", type="text", nullable=true)
     */
    private $avatarPicture=null;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title='Chat';
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="label_button", type="text", nullable=true)
     */
    private $labelButton='Click para chatear';
    
    /**
     * @var int|null
     *
     * @ORM\Column(name="timeout_open", type="integer", nullable=true)
     */
    private $timeoutOpen=8;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="colour", type="text", nullable=true)
     */
    private $colour='#4f4f4f';
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="position", type="text", nullable=true)
     */
    private $position='left';    

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
     * Get landing.
     *
     * @return Landing
     */
    public function getLanding()
    {
        return $this->landing;
    }
    
    /**
     * Set avatarName.
     *
     * @param string|null $avatarName
     *
     * @return LandingChatbot
     */
    public function setAvatarName($avatarName = null)
    {
        $this->avatarName = $avatarName;

        return $this;
    }

    /**
     * Get avatarName.
     *
     * @return string|null
     */
    public function getAvatarName()
    {
        return $this->avatarName;
    }
    
    /**
     * Set title.
     *
     * @param string|null $title
     *
     * @return LandingChatbot
     */
    public function setTitle($title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set welcome.
     *
     * @param string|null $welcome
     *
     * @return LandingChatbot
     */
    public function setWelcome($welcome = null)
    {
        $this->welcome = $welcome;

        return $this;
    }

    /**
     * Get welcome.
     *
     * @return string|null
     */
    public function getWelcome()
    {
        return $this->welcome;
    }
    
    /**
     * Set avatarPicture.
     *
     * @param string|null $avatarPicture
     *
     * @return LandingChatbot
     */
    public function setAvatarPicture($avatarPicture = null)
    {
        $this->avatarPicture = $avatarPicture;

        return $this;
    }

    /**
     * Get avatarPicture.
     *
     * @return string|null
     */
    public function getAvatarPicture()
    {
        return $this->avatarPicture;
    }
    
    /**
     * Set labelButton.
     *
     * @param string|null $labelButton
     *
     * @return LandingChatbot
     */
    public function setLabelButton($labelButton = null)
    {
        $this->labelButton = $labelButton;

        return $this;
    }

    /**
     * Get labelButton.
     *
     * @return string|null
     */
    public function getLabelButton()
    {
        return $this->labelButton;
    }
    
    /**
     * Set timeoutOpen.
     *
     * @param string|null $timeoutOpen
     *
     * @return LandingChatbot
     */
    public function setTimeoutOpen($timeoutOpen = null)
    {
        $this->timeoutOpen = $timeoutOpen;

        return $this;
    }

    /**
     * Get timeoutOpen.
     *
     * @return string|null
     */
    public function getTimeoutOpen()
    {
        return $this->timeoutOpen;
    }
    
    /**
     * Set colour.
     *
     * @param string|null $colour
     *
     * @return LandingChatbot
     */
    public function setColour($colour = null)
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * Get colour.
     *
     * @return string|null
     */
    public function getColour()
    {
        return $this->colour;
    }
    
    /**
     * Set position.
     *
     * @param string|null $position
     *
     * @return LandingChatbot
     */
    public function setPosition($position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position.
     *
     * @return string|null
     */
    public function getPosition()
    {
        return $this->position;
    }
    
    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return LandingChatbot
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
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return LandingChatbot
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
     * @return LandingChatbot
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


