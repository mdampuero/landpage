<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stat
 *
 * @ORM\Table(name="stat")
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\StatRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Stat
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
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Landing")
     * @ORM\JoinColumn(name="landing_id", referencedColumnName="id",nullable=true)
     */
    private $landingId;
    
    /**
     * One Cart has One Landing.
     * @ORM\ManyToOne(targetEntity="LandingContact")
     * @ORM\JoinColumn(name="contact", referencedColumnName="id",nullable=true)
     */
    private $contact;


    /**
     * @var string|null
     *
     * @ORM\Column(name="browser", type="string", length=255, nullable=true)
     */
    private $browser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lat", type="string", length=255, nullable=true)
     */
    private $lat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lng", type="string", length=255, nullable=true)
     */
    private $lng;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="acc", type="integer", nullable=true)
     */
    private $acc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="browser_version", type="string", length=255, nullable=true)
     */
    private $browserVersion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="os", type="string", length=255, nullable=true)
     */
    private $os;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="finger_print", type="string", length=255, nullable=true)
     */
    private $fingerPrint;

    /**
     * @var string|null
     *
     * @ORM\Column(name="os_version", type="string", length=255, nullable=true)
     */
    private $osVersion;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_mobile", type="boolean", nullable=true)
     */
    private $isMobile;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_mobile_major", type="boolean", nullable=true)
     */
    private $isMobileMajor;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_mobile_android", type="boolean", nullable=true)
     */
    private $isMobileAndroid;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_mobile_opera", type="boolean", nullable=true)
     */
    private $isMobileOpera;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_mobile_windows", type="boolean", nullable=true)
     */
    private $isMobileWindows;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_mobile_blackberry", type="boolean", nullable=true)
     */
    private $isMobileBlackberry;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_mobile_ios", type="boolean", nullable=true)
     */
    private $isMobileIos;
    
    /**
     * @var bool|null
     *
     * @ORM\Column(name="lead_valid", type="boolean", nullable=true)
     */
    private $validLead=false;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_iphone", type="boolean", nullable=true)
     */
    private $isIphone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="language", type="string", length=255, nullable=true)
     */
    private $language;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
    
    /**
     * @var \Date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

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
     * Set landingId.
     *
     * @param string $landingId
     *
     * @return Stat
     */
    public function setLandingId($landingId)
    {
        $this->landingId = $landingId;

        return $this;
    }

    
    /**
     * Get landingId.
     *
     * @return string
     */
    public function getLandingId()
    {
        return $this->landingId;
    }
    
    /**
     * Set contact.
     *
     * @param string $contact
     *
     * @return Stat
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
     * Set browser.
     *
     * @param string|null $browser
     *
     * @return Stat
     */
    public function setBrowser($browser = null)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * Get browser.
     *
     * @return string|null
     */
    public function getBrowser()
    {
        return $this->browser;
    }
    
    /**
     * Set lat.
     *
     * @param string|null $lat
     *
     * @return Stat
     */
    public function setLat($lat = null)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat.
     *
     * @return string|null
     */
    public function getLat()
    {
        return $this->lat;
    }
    
    /**
     * Set lng.
     *
     * @param string|null $lng
     *
     * @return Stat
     */
    public function setLng($lng = null)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng.
     *
     * @return string|null
     */
    public function getLng()
    {
        return $this->lng;
    }
    
    /**
     * Set acc.
     *
     * @param string|null $acc
     *
     * @return Stat
     */
    public function setAcc($acc = null)
    {
        $this->acc = $acc;

        return $this;
    }

    /**
     * Get acc.
     *
     * @return string|null
     */
    public function getAcc()
    {
        return $this->acc;
    }
    
    /**
     * Set fingerPrint.
     *
     * @param string|null $fingerPrint
     *
     * @return Stat
     */
    public function setFingerPrint($fingerPrint = null)
    {
        $this->fingerPrint = $fingerPrint;

        return $this;
    }

    /**
     * Get fingerPrint.
     *
     * @return string|null
     */
    public function getFingerPrint()
    {
        return $this->fingerPrint;
    }

    /**
     * Set browserVersion.
     *
     * @param string|null $browserVersion
     *
     * @return Stat
     */
    public function setBrowserVersion($browserVersion = null)
    {
        $this->browserVersion = $browserVersion;

        return $this;
    }

    /**
     * Get browserVersion.
     *
     * @return string|null
     */
    public function getBrowserVersion()
    {
        return $this->browserVersion;
    }

    /**
     * Set os.
     *
     * @param string|null $os
     *
     * @return Stat
     */
    public function setOs($os = null)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os.
     *
     * @return string|null
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set osVersion.
     *
     * @param string|null $osVersion
     *
     * @return Stat
     */
    public function setOsVersion($osVersion = null)
    {
        $this->osVersion = $osVersion;

        return $this;
    }

    /**
     * Get osVersion.
     *
     * @return string|null
     */
    public function getOsVersion()
    {
        return $this->osVersion;
    }

    /**
     * Set isMobile.
     *
     * @param bool|null $isMobile
     *
     * @return Stat
     */
    public function setIsMobile($isMobile = null)
    {
        $this->isMobile = $isMobile;

        return $this;
    }

    /**
     * Get isMobile.
     *
     * @return bool|null
     */
    public function getIsMobile()
    {
        return $this->isMobile;
    }

    /**
     * Set isMobileMajor.
     *
     * @param bool|null $isMobileMajor
     *
     * @return Stat
     */
    public function setIsMobileMajor($isMobileMajor = null)
    {
        $this->isMobileMajor = $isMobileMajor;

        return $this;
    }

    /**
     * Get isMobileMajor.
     *
     * @return bool|null
     */
    public function getIsMobileMajor()
    {
        return $this->isMobileMajor;
    }
    
    /**
     * Set validLead.
     *
     * @param bool|null $validLead
     *
     * @return Stat
     */
    public function setValidLead($validLead = false)
    {
        $this->validLead = $validLead;

        return $this;
    }

    /**
     * Get validLead.
     *
     * @return bool|null
     */
    public function getValidLead()
    {
        return $this->validLead;
    }

    /**
     * Set isMobileAndroid.
     *
     * @param bool|null $isMobileAndroid
     *
     * @return Stat
     */
    public function setIsMobileAndroid($isMobileAndroid = null)
    {
        $this->isMobileAndroid = $isMobileAndroid;

        return $this;
    }

    /**
     * Get isMobileAndroid.
     *
     * @return bool|null
     */
    public function getIsMobileAndroid()
    {
        return $this->isMobileAndroid;
    }

    /**
     * Set isMobileOpera.
     *
     * @param bool|null $isMobileOpera
     *
     * @return Stat
     */
    public function setIsMobileOpera($isMobileOpera = null)
    {
        $this->isMobileOpera = $isMobileOpera;

        return $this;
    }

    /**
     * Get isMobileOpera.
     *
     * @return bool|null
     */
    public function getIsMobileOpera()
    {
        return $this->isMobileOpera;
    }

    /**
     * Set isMobileWindows.
     *
     * @param bool|null $isMobileWindows
     *
     * @return Stat
     */
    public function setIsMobileWindows($isMobileWindows = null)
    {
        $this->isMobileWindows = $isMobileWindows;

        return $this;
    }

    /**
     * Get isMobileWindows.
     *
     * @return bool|null
     */
    public function getIsMobileWindows()
    {
        return $this->isMobileWindows;
    }

    /**
     * Set isMobileBlackberry.
     *
     * @param bool|null $isMobileBlackberry
     *
     * @return Stat
     */
    public function setIsMobileBlackberry($isMobileBlackberry = null)
    {
        $this->isMobileBlackberry = $isMobileBlackberry;

        return $this;
    }

    /**
     * Get isMobileBlackberry.
     *
     * @return bool|null
     */
    public function getIsMobileBlackberry()
    {
        return $this->isMobileBlackberry;
    }

    /**
     * Set isMobileIos.
     *
     * @param bool|null $isMobileIos
     *
     * @return Stat
     */
    public function setIsMobileIos($isMobileIos = null)
    {
        $this->isMobileIos = $isMobileIos;

        return $this;
    }

    /**
     * Get isMobileIos.
     *
     * @return bool|null
     */
    public function getIsMobileIos()
    {
        return $this->isMobileIos;
    }

    /**
     * Set isIphone.
     *
     * @param bool|null $isIphone
     *
     * @return Stat
     */
    public function setIsIphone($isIphone = null)
    {
        $this->isIphone = $isIphone;

        return $this;
    }

    /**
     * Get isIphone.
     *
     * @return bool|null
     */
    public function getIsIphone()
    {
        return $this->isIphone;
    }

    /**
     * Set language.
     *
     * @param string|null $language
     *
     * @return Stat
     */
    public function setLanguage($language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language.
     *
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Demo
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
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Demo
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Demo
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
     * @return Demo
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
        $this->date=new \DateTime();
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
