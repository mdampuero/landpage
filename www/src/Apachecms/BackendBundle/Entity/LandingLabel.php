<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LandingLabel
 *
 * @ORM\Table(name="landing_label")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\LandingLabelRepository")
 */
class LandingLabel
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
     * @ORM\Column(name="navbar_about", type="string", length=255, nullable=true)
     */
    private $navbarAbout='EMPRESA';

    /**
     * @var string|null
     *
     * @ORM\Column(name="navbar_product_or_service", type="string", length=255, nullable=true)
     */
    private $navbarProductOrService='Productos';

    /**
     * @var string|null
     *
     * @ORM\Column(name="navbar_contact", type="string", length=255, nullable=true)
     */
    private $navbarContact='Contacto';

    /**
     * @var string|null
     *
     * @ORM\Column(name="header_title", type="text", nullable=true)
     */
    private $headerTitle;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="form_legend", type="text", nullable=true)
     */
    private $formLegend;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_name", type="string", length=255, nullable=true)
     */
    private $contactName='Nombre';

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_email", type="string", length=255, nullable=true)
     */
    private $contactEmail='Email';

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_phone", type="string", length=255, nullable=true)
     */
    private $contactPhone='Teléfono';

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_query", type="string", length=255, nullable=true)
     */
    private $contactQuery='Consulta';

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_btn", type="string", length=255, nullable=true)
     */
    private $contactBtn='Enviar';

    /**
     * @var string|null
     *
     * @ORM\Column(name="about_title", type="string", length=255, nullable=true)
     */
    private $aboutTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="about_description", type="text" , nullable=true)
     */
    private $aboutDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="product_or_service_title", type="string", length=255, nullable=true)
     */
    private $productOrServiceTitle='Productos';

    /**
     * @var string|null
     *
     * @ORM\Column(name="product_or_service_description", type="text", nullable=true)
     */
    private $productOrServiceDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="product_or_service_btn", type="string", length=255, nullable=true)
     */
    private $productOrServiceBtn='Contactar';

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
     * Set navbarAbout.
     *
     * @param string|null $navbarAbout
     *
     * @return LandingLabel
     */
    public function setNavbarAbout($navbarAbout = null)
    {
        $this->navbarAbout = $navbarAbout;

        return $this;
    }

    /**
     * Get navbarAbout.
     *
     * @return string|null
     */
    public function getNavbarAbout()
    {
        return $this->navbarAbout;
    }

    /**
     * Set navbarProductOrService.
     *
     * @param string|null $navbarProductOrService
     *
     * @return LandingLabel
     */
    public function setNavbarProductOrService($navbarProductOrService = null)
    {
        $this->navbarProductOrService = $navbarProductOrService;

        return $this;
    }

    /**
     * Get navbarProductOrService.
     *
     * @return string|null
     */
    public function getNavbarProductOrService()
    {
        return $this->navbarProductOrService;
    }

    /**
     * Set navbarContact.
     *
     * @param string|null $navbarContact
     *
     * @return LandingLabel
     */
    public function setNavbarContact($navbarContact = null)
    {
        $this->navbarContact = $navbarContact;

        return $this;
    }

    /**
     * Get navbarContact.
     *
     * @return string|null
     */
    public function getNavbarContact()
    {
        return $this->navbarContact;
    }
    
    /**
     * Set formLegend.
     *
     * @param string|null $formLegend
     *
     * @return LandingLabel
     */
    public function setFormLegend($formLegend = null)
    {
        $this->formLegend = $formLegend;

        return $this;
    }

    /**
     * Get formLegend.
     *
     * @return string|null
     */
    public function getFormLegend()
    {
        return $this->formLegend;
    }

    /**
     * Set headerTitle.
     *
     * @param string|null $headerTitle
     *
     * @return LandingLabel
     */
    public function setHeaderTitle($headerTitle = null)
    {
        $this->headerTitle = $headerTitle;

        return $this;
    }

    /**
     * Get headerTitle.
     *
     * @return string|null
     */
    public function getHeaderTitle()
    {
        return $this->headerTitle;
    }

    /**
     * Set contactName.
     *
     * @param string|null $contactName
     *
     * @return LandingLabel
     */
    public function setContactName($contactName = null)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * Get contactName.
     *
     * @return string|null
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set contactEmail.
     *
     * @param string|null $contactEmail
     *
     * @return LandingLabel
     */
    public function setContactEmail($contactEmail = null)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail.
     *
     * @return string|null
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set contactPhone.
     *
     * @param string|null $contactPhone
     *
     * @return LandingLabel
     */
    public function setContactPhone($contactPhone = null)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone.
     *
     * @return string|null
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set contactQuery.
     *
     * @param string|null $contactQuery
     *
     * @return LandingLabel
     */
    public function setContactQuery($contactQuery = null)
    {
        $this->contactQuery = $contactQuery;

        return $this;
    }

    /**
     * Get contactQuery.
     *
     * @return string|null
     */
    public function getContactQuery()
    {
        return $this->contactQuery;
    }

    /**
     * Set contactBtn.
     *
     * @param string|null $contactBtn
     *
     * @return LandingLabel
     */
    public function setContactBtn($contactBtn = null)
    {
        $this->contactBtn = $contactBtn;

        return $this;
    }

    /**
     * Get contactBtn.
     *
     * @return string|null
     */
    public function getContactBtn()
    {
        return $this->contactBtn;
    }

    /**
     * Set aboutTitle.
     *
     * @param string|null $aboutTitle
     *
     * @return LandingLabel
     */
    public function setAboutTitle($aboutTitle = null)
    {
        $this->aboutTitle = $aboutTitle;

        return $this;
    }

    /**
     * Get aboutTitle.
     *
     * @return string|null
     */
    public function getAboutTitle()
    {
        return $this->aboutTitle;
    }

    /**
     * Set aboutDescription.
     *
     * @param string $aboutDescription
     *
     * @return LandingLabel
     */
    public function setAboutDescription($aboutDescription)
    {
        $this->aboutDescription = $aboutDescription;

        return $this;
    }

    /**
     * Get aboutDescription.
     *
     * @return string
     */
    public function getAboutDescription()
    {
        return $this->aboutDescription;
    }

    /**
     * Set productOrServiceTitle.
     *
     * @param string|null $productOrServiceTitle
     *
     * @return LandingLabel
     */
    public function setProductOrServiceTitle($productOrServiceTitle = null)
    {
        $this->productOrServiceTitle = $productOrServiceTitle;

        return $this;
    }

    /**
     * Get productOrServiceTitle.
     *
     * @return string|null
     */
    public function getProductOrServiceTitle()
    {
        return $this->productOrServiceTitle;
    }

    /**
     * Set productOrServiceDescription.
     *
     * @param string|null $productOrServiceDescription
     *
     * @return LandingLabel
     */
    public function setProductOrServiceDescription($productOrServiceDescription = null)
    {
        $this->productOrServiceDescription = $productOrServiceDescription;

        return $this;
    }

    /**
     * Get productOrServiceDescription.
     *
     * @return string|null
     */
    public function getProductOrServiceDescription()
    {
        return $this->productOrServiceDescription;
    }

    /**
     * Set productOrServiceBtn.
     *
     * @param string|null $productOrServiceBtn
     *
     * @return LandingLabel
     */
    public function setProductOrServiceBtn($productOrServiceBtn = null)
    {
        $this->productOrServiceBtn = $productOrServiceBtn;

        return $this;
    }

    /**
     * Get productOrServiceBtn.
     *
     * @return string|null
     */
    public function getProductOrServiceBtn()
    {
        return $this->productOrServiceBtn;
    }

    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return LandingLabel
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
     * @return LandingLabel
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
     * @return LandingLabel
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


