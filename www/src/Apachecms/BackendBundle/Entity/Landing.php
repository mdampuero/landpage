<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\Criteria;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Landing
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\LandingRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class Landing
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
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=false)
     */
    private $slug;
    
    /**
     * One customer has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="LandingService", mappedBy="landing",cascade={"persist"})
     * @ORM\OrderBy({"createdAt" = "ASC"})
     */
    private $services;

    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id",nullable=true)
     */
    private $customer;

    /**
     * One Product has One Label.
     * @ORM\OneToOne(targetEntity="LandingLabel")
     * @ORM\JoinColumn(name="label_id", referencedColumnName="id",nullable=true)
     */
    private $labels;
    
    /**
     * One Product has One Social.
     * @ORM\OneToOne(targetEntity="LandingSocial")
     * @ORM\JoinColumn(name="social_id", referencedColumnName="id",nullable=true)
     */
    private $socials;
   
    /**
     * One Product has One Plugin.
     * @ORM\OneToOne(targetEntity="LandingPlugin")
     * @ORM\JoinColumn(name="plugin_id", referencedColumnName="id",nullable=true)
     */
    private $plugins;
    
    /**
     * One Product has One Chatbot.
     * @ORM\OneToOne(targetEntity="LandingChatbot")
     * @ORM\JoinColumn(name="chatbot_id", referencedColumnName="id",nullable=true)
     */
    private $chatbot;
    
    /**
     * @ORM\Column(name="background_image", type="string", length=255,nullable=true)
     */
    private $backgroundImage;
    
    /**
     * @ORM\Column(name="navbar_top", type="string", length=255,nullable=true)
     */
    private $navBarTop='rgba(0,0,0,0)';
    
    /**
     * @ORM\Column(name="brightness", type="string", length=255,nullable=true)
     */
    private $brightness='0.5';
    
    /**
     * @ORM\Column(name="colors_suggested", type="string", length=255,nullable=true)
     */
    private $colorsSuggested='rgba(0,0,0,0.5)';
    
    /**
     * @ORM\Column(name="navbar_top_text", type="string", length=255,nullable=true)
     */
    private $navBarTopText='#FFFFFF';
    
    /**
     * @ORM\Column(name="navbar_fixed", type="string", length=255,nullable=true)
     */
    private $navBarFixed='#FFFFFF';
    
    /**
     * @ORM\Column(name="navbar_fixed_text", type="string", length=255,nullable=true)
     */
    private $navBarFixedText='#4f4f4f';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255,nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 50
     * )
     */
    private $name;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="current_step", type="integer",nullable=true)
     */
    private $currentStep=2;
    
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 50
     * )
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255,nullable=true)
     */
    private $status;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title_1", type="string", length=255,nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 50
     * )
     */
    private $title_1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="color_primary", type="string", length=255,nullable=true)
     */
    private $colorPrimary;
   
    /**
     * @var string
     *
     * @ORM\Column(name="title_2", type="string", length=255,nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 50
     * )
     */
    private $title_2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=255,nullable=true)
     */
    private $template="template_1";
    
    /**
     * @var string
     *
     * @ORM\Column(name="contact_phone", type="string", length=255,nullable=true)
     */
    private $contactPhone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="contact_address_lat", type="string", length=255,nullable=true)
     */
    private $contactAddressLat;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="contact_address_map", type="boolean", nullable=true)
     */
    private $contactAddressMap=true;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="contact_social", type="boolean", nullable=true)
     */
    private $social=true;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="use_whatsapp", type="boolean", nullable=true)
     */
    private $useWhatsapp=true;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="use_whatsapp_mobile", type="boolean", nullable=true)
     */
    private $useWhatsappMobile=true;
    
    /**
     * @var string
     *
     * @ORM\Column(name="contact_address_lng", type="string", length=255,nullable=true)
     */
    private $contactAddressLng;
    
    /**
     * @var string
     *
     * @ORM\Column(name="contact_address_zoom", type="string", length=255,nullable=true)
     */
    private $contactAddressZoom='6';
    
    /**
     * @var string
     *
     * @ORM\Column(name="contact_address", type="string", length=255,nullable=true)
     */
    private $contactAddress;
    
    /**
     * @var string
     *
     * @ORM\Column(name="contact_email", type="string", length=255,nullable=true)
     */
    private $contactEmail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="contact_email_reply", type="text")
     */
    private $contactReplyEmail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="reason_for_rejection", type="text",nullable=true)
     */
    private $reasonForRejection;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="description_1", type="text",nullable=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 70
     * )
     */
    private $description_1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description_2", type="text",nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 70
     * )
     */
    private $description_2;

    /**
     * @var string
     *
     * @ORM\Column(name="description_3", type="text",nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 70
     * )
     */
    private $description_3;

    /**
     * @var string
     *
     * @ORM\Column(name="description_4", type="text",nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 70
     * )
     */
    private $description_4;
    
    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255,nullable=true)
     */
    private $brand;
    
    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Industry")
     * @ORM\JoinColumn(name="industry_id", referencedColumnName="id",nullable=true)
     */
    private $industry;
    
    /**
     * Many features have one product. This is the owning side.
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Business")
     * @ORM\JoinColumn(name="business_id", referencedColumnName="id")
     */
    private $business;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_product_service", type="boolean",nullable=true)
     */
    private $isProductService=true;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="is_active_ai", type="boolean",nullable=true)
     */
    private $isActiveAi=true;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="use_chatbot", type="boolean",nullable=true)
     */
    private $useChatbot=true;

    /**
     * @var string
     *
     * @ORM\Column(name="grid_columns", type="string", length=255,nullable=true)
     */
    private $gridColumns='col-md-4 col-sm-6';
    
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
     * @var \DateTime
     *
     * @ORM\Column(name="published_to_at", type="datetime",nullable=true)
     */
    private $publishedToAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_from_at", type="datetime",nullable=true)
     */
    private $publishedFromAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_delete", type="boolean")
     */
    private $isDelete;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="is_review", type="boolean",nullable=true)
     */
    private $isReview;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="is_published", type="boolean")
     */
    private $isPublished;
    


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
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set customer.
     *
     * @param string $customer
     *
     * @return Customer
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
     * Set name.
     *
     * @param string $name
     *
     * @return Landing
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set currentStep.
     *
     * @param string $currentStep
     *
     * @return Landing
     */
    public function setCurrentStep($currentStep)
    {
        $this->currentStep = $currentStep;

        return $this;
    }

    /**
     * Get currentStep.
     *
     * @return string
     */
    public function getCurrentStep()
    {
        return $this->currentStep;
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
     * Set template.
     *
     * @param string $template
     *
     * @return Landing
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
    
    /**
     * Set colorsSuggested.
     *
     * @param string $colorsSuggested
     *
     * @return Landing
     */
    public function setColorsSuggested($colorsSuggested)
    {
        $this->colorsSuggested = $colorsSuggested;

        return $this;
    }

    /**
     * Get colorsSuggested.
     *
     * @return string
     */
    public function getColorsSuggested()
    {
        return json_decode($this->colorsSuggested,true);
    }
    
    /**
     * Set contactPhone.
     *
     * @param string $contactPhone
     *
     * @return Landing
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone.
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }
    
    /**
     * Set contactAddress.
     *
     * @param string $contactAddress
     *
     * @return Landing
     */
    public function setContactAddress($contactAddress)
    {
        $this->contactAddress = $contactAddress;

        return $this;
    }

    /**
     * Get contactAddress.
     *
     * @return string
     */
    public function getContactAddress()
    {
        return $this->contactAddress;
    }
    
    /**
     * Set contactAddressLat.
     *
     * @param string $contactAddressLat
     *
     * @return Landing
     */
    public function setContactAddressLat($contactAddressLat)
    {
        $this->contactAddressLat = $contactAddressLat;

        return $this;
    }

    /**
     * Get contactAddressLat.
     *
     * @return string
     */
    public function getContactAddressLat()
    {
        return $this->contactAddressLat;
    }
    
    /**
     * Set contactAddressMap.
     *
     * @param boolean $contactAddressMap
     *
     * @return Landing
     */
    public function setContactAddressMap($contactAddressMap)
    {
        $this->contactAddressMap = $contactAddressMap;

        return $this;
    }

    /**
     * Get contactAddressMap.
     *
     * @return boolean
     */
    public function getContactAddressMap()
    {
        return $this->contactAddressMap;
    }
    
    /**
     * Set social.
     *
     * @param boolean $social
     *
     * @return Landing
     */
    public function setSocial($social)
    {
        $this->social = $social;

        return $this;
    }

    /**
     * Get social.
     *
     * @return boolean
     */
    public function getSocial()
    {
        return $this->social;
    }
    
    /**
     * Set useWhatsapp.
     *
     * @param boolean $useWhatsapp
     *
     * @return Landing
     */
    public function setUseWhatsapp($useWhatsapp)
    {
        $this->useWhatsapp = $useWhatsapp;

        return $this;
    }

    /**
     * Get useWhatsapp.
     *
     * @return boolean
     */
    public function getUseWhatsapp()
    {
        return $this->useWhatsapp;
    }
    
    /**
     * Set useWhatsappMobile.
     *
     * @param boolean $useWhatsappMobile
     *
     * @return Landing
     */
    public function setUseWhatsappMobile($useWhatsappMobile)
    {
        $this->useWhatsappMobile = $useWhatsappMobile;

        return $this;
    }

    /**
     * Get useWhatsappMobile.
     *
     * @return boolean
     */
    public function getUseWhatsappMobile()
    {
        return $this->useWhatsappMobile;
    }
    
    /**
     * Set contactAddressLng.
     *
     * @param string $contactAddressLng
     *
     * @return Landing
     */
    public function setContactAddressLng($contactAddressLng)
    {
        $this->contactAddressLng = $contactAddressLng;

        return $this;
    }

    /**
     * Get contactAddressLng.
     *
     * @return string
     */
    public function getContactAddressLng()
    {
        return $this->contactAddressLng;
    }
    
    /**
     * Set contactAddressZoom.
     *
     * @param string $contactAddressZoom
     *
     * @return Landing
     */
    public function setContactAddressZoom($contactAddressZoom)
    {
        $this->contactAddressZoom = $contactAddressZoom;

        return $this;
    }

    /**
     * Get contactAddressZoom.
     *
     * @return string
     */
    public function getContactAddressZoom()
    {
        return $this->contactAddressZoom;
    }
    
    /**
     * Set contactEmail.
     *
     * @param string $contactEmail
     *
     * @return Landing
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail.
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }
    
    /**
     * Set contactReplyEmail.
     *
     * @param string $contactReplyEmail
     *
     * @return Landing
     */
    public function setContactReplyEmail($contactReplyEmail)
    {
        $this->contactReplyEmail = $contactReplyEmail;

        return $this;
    }

    /**
     * Get contactReplyEmail.
     *
     * @return string
     */
    public function getContactReplyEmail()
    {
        return $this->contactReplyEmail;
    }
    
    /**
     * Set reasonForRejection.
     *
     * @param string $reasonForRejection
     *
     * @return Landing
     */
    public function setReasonForRejection($reasonForRejection)
    {
        $this->reasonForRejection = $reasonForRejection;

        return $this;
    }

    /**
     * Get reasonForRejection.
     *
     * @return string
     */
    public function getReasonForRejection()
    {
        return $this->reasonForRejection;
    }
    
    /**
     * Set gridColumns.
     *
     * @param string $gridColumns
     *
     * @return Landing
     */
    public function setGridColumns($gridColumns)
    {
        $this->gridColumns = $gridColumns;

        return $this;
    }

    /**
     * Get gridColumns.
     *
     * @return string
     */
    public function getGridColumns()
    {
        return $this->gridColumns;
    }
    
    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Landing
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set title_1.
     *
     * @param string $title_1
     *
     * @return Landing
     */
    public function setTitle1($title_1)
    {
        $this->title_1 = $title_1;

        return $this;
    }

    /**
     * Get title_1.
     *
     * @return string
     */
    public function getTitle1()
    {
        return $this->title_1;
    }
    
    /**
     * Set colorPrimary.
     *
     * @param string $colorPrimary
     *
     * @return Landing
     */
    public function setColorPrimary($colorPrimary)
    {
        $this->colorPrimary = $colorPrimary;

        return $this;
    }

    /**
     * Get colorPrimary.
     *
     * @return string
     */
    public function getColorPrimary()
    {
        return $this->colorPrimary;
    }
    
    /**
     * Set title_2.
     *
     * @param string $title_2
     *
     * @return Landing
     */
    public function setTitle2($title_2)
    {
        $this->title_2 = $title_2;

        return $this;
    }

    /**
     * Get title_2.
     *
     * @return string
     */
    public function getTitle2()
    {
        return $this->title_2;
    }
    
    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Landing
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description_1.
     *
     * @param string $description_1
     *
     * @return Landing
     */
    public function setDescription1($description_1)
    {
        $this->description_1 = $description_1;

        return $this;
    }

    /**
     * Get description_1.
     *
     * @return string
     */
    public function getDescription1()
    {
        return $this->description_1;
    }
    
    /**
     * Set description_3.
     *
     * @param string $description_3
     *
     * @return Landing
     */
    public function setDescription3($description_3)
    {
        $this->description_3 = $description_3;

        return $this;
    }

    /**
     * Get description_3.
     *
     * @return string
     */
    public function getDescription3()
    {
        return $this->description_3;
    }
    
    /**
     * Set description_4.
     *
     * @param string $description_4
     *
     * @return Landing
     */
    public function setDescription4($description_4)
    {
        $this->description_4 = $description_4;

        return $this;
    }

    /**
     * Get description_4.
     *
     * @return string
     */
    public function getDescription4()
    {
        return $this->description_4;
    }
    /**
     * Set description_2.
     *
     * @param string $description_2
     *
     * @return Landing
     */
    public function setDescription2($description_2)
    {
        $this->description_2 = $description_2;

        return $this;
    }

    /**
     * Get description_2.
     *
     * @return string
     */
    public function getDescription2()
    {
        return $this->description_2;
    }
    
    /**
     * Set brand.
     *
     * @param string $brand
     *
     * @return Landing
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand.
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }
    
    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Landing
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
     * Set industry.
     *
     * @param string $industry
     *
     * @return Landing
     */
    public function setIndustry($industry)
    {
        $this->industry = $industry;

        return $this;
    }
    
    /**
     * Set business.
     *
     * @param string $business
     *
     * @return Landing
     */
    public function setBusiness($business)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Set labels.
     *
     * @param string $labels
     *
     * @return LandingLabel
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * Get labels.
     *
     * @return string
     */
    public function getLabels()
    {
        return $this->labels;
    }
    
    /**
     * Set socials.
     *
     * @param string $socials
     *
     * @return LandingSocial
     */
    public function setSocials($socials)
    {
        $this->socials = $socials;

        return $this;
    }

    /**
     * Get socials.
     *
     * @return string
     */
    public function getSocials()
    {
        return $this->socials;
    }
    
    /**
     * Set plugins.
     *
     * @param string $plugins
     *
     * @return LandingPlugin
     */
    public function setPlugins($plugins)
    {
        $this->plugins = $plugins;

        return $this;
    }

    /**
     * Get plugins.
     *
     * @return string
     */
    public function getPlugins()
    {
        return $this->plugins;
    }
    
    /**
     * Set chatbot.
     *
     * @param string $chatbot
     *
     * @return LandingChatbot
     */
    public function setChatbot($chatbot)
    {
        $this->chatbot = $chatbot;

        return $this;
    }

    /**
     * Get chatbot.
     *
     * @return string
     */
    public function getChatbot()
    {
        return $this->chatbot;
    }

    /**
     * Get industry.
     *
     * @return string
     */
    public function getIndustry()
    {
        return $this->industry;
    }
    
    /**
     * Get business.
     *
     * @return string
     */
    public function getBusiness()
    {
        return $this->business;
    }
    
    /**
     * Set backgroundImage.
     *
     * @param string $backgroundImage
     *
     * @return Landing
     */
    public function setBackgroundImage($backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

    /**
     * Get backgroundImage.
     *
     * @return string
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }
    
    /**
     * Set navBarTop.
     *
     * @param string $navBarTop
     *
     * @return Landing
     */
    public function setNavBarTop($navBarTop)
    {
        $this->navBarTop = $navBarTop;

        return $this;
    }

    /**
     * Get navBarTop.
     *
     * @return string
     */
    public function getNavBarTop()
    {
        return $this->navBarTop;
    }
    
    /**
     * Set brightness.
     *
     * @param string $brightness
     *
     * @return Landing
     */
    public function setBrightness($brightness)
    {
        $this->brightness = $brightness;

        return $this;
    }

    /**
     * Get brightness.
     *
     * @return string
     */
    public function getBrightness()
    {
        return $this->brightness;
    }
    
    /**
     * Set navBarTopText.
     *
     * @param string $navBarTopText
     *
     * @return Landing
     */
    public function setNavBarTopText($navBarTopText)
    {
        $this->navBarTopText = $navBarTopText;

        return $this;
    }

    /**
     * Get navBarTopText.
     *
     * @return string
     */
    public function getNavBarTopText()
    {
        return $this->navBarTopText;
    }
    
    
    /**
     * Set navBarFixed.
     *
     * @param string $navBarFixed
     *
     * @return Landing
     */
    public function setNavBarFixed($navBarFixed)
    {
        $this->navBarFixed = $navBarFixed;

        return $this;
    }

    /**
     * Get navBarFixed.
     *
     * @return string
     */
    public function getNavBarFixed()
    {
        return $this->navBarFixed;
    }
    
    /**
     * Set navBarFixedText.
     *
     * @param string $navBarFixedText
     *
     * @return Landing
     */
    public function setNavBarFixedText($navBarFixedText)
    {
        $this->navBarFixedText = $navBarFixedText;

        return $this;
    }

    /**
     * Get navBarFixedText.
     *
     * @return string
     */
    public function getNavBarFixedText()
    {
        return $this->navBarFixedText;
    }
    
    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return Landing
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
     * Set isReview.
     *
     * @param bool $isReview
     *
     * @return Landing
     */
    public function setIsReview($isReview)
    {
        $this->isReview = $isReview;

        return $this;
    }

    /**
     * Get isReview.
     *
     * @return bool
     */
    public function getIsReview()
    {
        return $this->isReview;
    }
    
    /**
     * Set isPublished.
     *
     * @param bool $isPublished
     *
     * @return Landing
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished.
     *
     * @return bool
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }
    
    /**
     * Set isProductService
     *
     * @param bool $isProductService
     *
     * @return Landing
     */
    public function setIsProductService($isProductService)
    {
        $this->isProductService = $isProductService;

        return $this;
    }

    /**
     * Get isProductService
     *
     * @return bool
     */
    public function getIsProductService()
    {
        return $this->isProductService;
    }
    
    /**
     * Set useChatbot
     *
     * @param bool $useChatbot
     *
     * @return Landing
     */
    public function setUseChatbot($useChatbot)
    {
        $this->useChatbot = $useChatbot;

        return $this;
    }

    /**
     * Get useChatbot
     *
     * @return bool
     */
    public function getUseChatbot()
    {
        return $this->useChatbot;
    }
    
    /**
     * Set isActiveAi
     *
     * @param bool $isActiveAi
     *
     * @return Landing
     */
    public function setIsActiveAi($isActiveAi)
    {
        $this->isActiveAi = $isActiveAi;

        return $this;
    }

    /**
     * Get isActiveAi
     *
     * @return bool
     */
    public function getIsActiveAi()
    {
        return $this->isActiveAi;
    }
    
    /**
     * Get services
     *
     * @return string
     */
    public function getServices()
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('isDelete', false))
        ->orderBy(
            array(
                'createdAt' => Criteria::ASC
                )
        );
        return $this->services->matching($criteria);
    }


    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Landing
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
     * Set publishedToAt.
     *
     * @param \DateTime $publishedToAt
     *
     * @return Landing
     */
    public function setPublishedToAt($publishedToAt)
    {
        $this->publishedToAt = $publishedToAt;

        return $this;
    }

    /**
     * Get publishedToAt.
     *
     * @return \DateTime
     */
    public function getPublishedToAt()
    {
        return $this->publishedToAt;
    }
    
    /**
     * Set publishedFromAt.
     *
     * @param \DateTime $publishedFromAt
     *
     * @return Landing
     */
    public function setPublishedFromAt($publishedFromAt)
    {
        $this->publishedFromAt = $publishedFromAt;

        return $this;
    }

    /**
     * Get publishedFromAt.
     *
     * @return \DateTime
     */
    public function getPublishedFromAt()
    {
        return $this->publishedFromAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Landing
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
        $this->isPublished=false;
        $this->status='draft';
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
