<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LandingSocial
 *
 * @ORM\Table(name="landing_social")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\LandingSocialRepository")
 */
class LandingSocial
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
     * @ORM\Column(name="facebook", type="text", nullable=true)
     */
    private $facebook;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="web", type="text", nullable=true)
     */
    private $web;

    /**
     * @var string|null
     *
     * @ORM\Column(name="google_plus", type="text", nullable=true)
     */
    private $googlePlus;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="twitter", type="text", nullable=true)
     */
    private $twitter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="youtube", type="text", nullable=true)
     */
    private $youtube;

    /**
     * @var string|null
     *
     * @ORM\Column(name="linkedin", type="text", nullable=true)
     */
    private $linkedin;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="instagram", type="text", nullable=true)
     */
    private $instagram;

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
     * Set facebook.
     *
     * @param string|null $facebook
     *
     * @return LandingSocial
     */
    public function setFacebook($facebook = null)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook.
     *
     * @return string|null
     */
    public function getFacebook()
    {
        return $this->facebook;
    }
    
    /**
     * Set web.
     *
     * @param string|null $web
     *
     * @return LandingSocial
     */
    public function setWeb($web = null)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web.
     *
     * @return string|null
     */
    public function getWeb()
    {
        return $this->web;
    }
    
    /**
     * Set googlePlus.
     *
     * @param string|null $googlePlus
     *
     * @return LandingSocial
     */
    public function setGooglePlus($googlePlus = null)
    {
        $this->googlePlus = $googlePlus;

        return $this;
    }

    /**
     * Get googlePlus.
     *
     * @return string|null
     */
    public function getGooglePlus()
    {
        return $this->googlePlus;
    }
    
    /**
     * Set twitter.
     *
     * @param string|null $twitter
     *
     * @return LandingSocial
     */
    public function setTwitter($twitter = null)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter.
     *
     * @return string|null
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
    
    /**
     * Set youtube.
     *
     * @param string|null $youtube
     *
     * @return LandingSocial
     */
    public function setYoutube($youtube = null)
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * Get youtube.
     *
     * @return string|null
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * Set instagram.
     *
     * @param string|null $instagram
     *
     * @return LandingSocial
     */
    public function setInstagram($instagram = null)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get instagram.
     *
     * @return string|null
     */
    public function getInstagram()
    {
        return $this->instagram;
    }
    
    /**
     * Set linkedin.
     *
     * @param string|null $linkedin
     *
     * @return LandingSocial
     */
    public function setLinkedin($linkedin = null)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get linkedin.
     *
     * @return string|null
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }
    
    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return LandingSocial
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
     * @return LandingSocial
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
     * @return LandingSocial
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


