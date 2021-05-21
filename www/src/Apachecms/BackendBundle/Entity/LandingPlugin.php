<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LandingPlugin
 *
 * @ORM\Table(name="landing_plugin")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\LandingPluginRepository")
 */
class LandingPlugin
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
     * @ORM\Column(name="google_analitycs", type="text", nullable=true)
     */
    private $googleAnalitycs;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="google_ads_landing", type="text", nullable=true)
     */
    private $googleAdsLanding;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="google_ads_success", type="text", nullable=true)
     */
    private $googleAdsSuccess;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="pixel_facebook", type="text", nullable=true)
     */
    private $pixelFacebook;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="meta_tags_description", type="text", nullable=true)
     */
    private $metaTagsDescription;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="meta_index", type="boolean")
     */
    private $metaIndex=true;

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
     * Set googleAnalitycs.
     *
     * @param string|null $googleAnalitycs
     *
     * @return LandingPlugin
     */
    public function setGoogleAnalitycs($googleAnalitycs = null)
    {
        $this->googleAnalitycs = $googleAnalitycs;

        return $this;
    }

    /**
     * Get googleAnalitycs.
     *
     * @return string|null
     */
    public function getGoogleAnalitycs()
    {
        return $this->googleAnalitycs;
    }
    
    /**
     * Set googleAdsLanding.
     *
     * @param string|null $googleAdsLanding
     *
     * @return LandingPlugin
     */
    public function setGoogleAdsLanding($googleAdsLanding = null)
    {
        $this->googleAdsLanding = $googleAdsLanding;

        return $this;
    }

    /**
     * Get googleAdsLanding.
     *
     * @return string|null
     */
    public function getGoogleAdsLanding()
    {
        return $this->googleAdsLanding;
    }
    
    /**
     * Set pixelFacebook.
     *
     * @param string|null $pixelFacebook
     *
     * @return LandingPlugin
     */
    public function setPixelFacebook($pixelFacebook = null)
    {
        $this->pixelFacebook = $pixelFacebook;

        return $this;
    }

    /**
     * Get pixelFacebook.
     *
     * @return string|null
     */
    public function getPixelFacebook()
    {
        return $this->pixelFacebook;
    }
    
    /**
     * Set googleAdsSuccess.
     *
     * @param string|null $googleAdsSuccess
     *
     * @return LandingPlugin
     */
    public function setGoogleAdsSuccess($googleAdsSuccess = null)
    {
        $this->googleAdsSuccess = $googleAdsSuccess;

        return $this;
    }

    /**
     * Get googleAdsSuccess.
     *
     * @return string|null
     */
    public function getGoogleAdsSuccess()
    {
        return $this->googleAdsSuccess;
    }
    
    /**
     * Set metaTagsDescription.
     *
     * @param string|null $metaTagsDescription
     *
     * @return LandingPlugin
     */
    public function setMetaTagsDescription($metaTagsDescription = null)
    {
        $this->metaTagsDescription = $metaTagsDescription;

        return $this;
    }

    /**
     * Get metaTagsDescription.
     *
     * @return string|null
     */
    public function getMetaTagsDescription()
    {
        return $this->metaTagsDescription;
    }
    
    /**
     * Set metaIndex.
     *
     * @param boolean|null $metaIndex
     *
     * @return LandingPlugin
     */
    public function setMetaIndex($metaIndex = null)
    {
        $this->metaIndex = $metaIndex;

        return $this;
    }

    /**
     * Get metaIndex.
     *
     * @return boolean|null
     */
    public function getMetaIndex()
    {
        return $this->metaIndex;
    }
    
    
    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return LandingPlugin
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
     * @return LandingPlugin
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
     * @return LandingPlugin
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


