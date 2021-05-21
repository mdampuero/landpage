<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Business
 *
 * @ORM\Table(name="business")
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\BusinessRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Business
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
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 100
     * )
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255,nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address_lat", type="string", length=255,nullable=true)
     */
    private $addressLat;
    
    /**
     * @var string
     *
     * @ORM\Column(name="reply_email", type="text")
     * @Assert\NotBlank()
     */
    private $replyEmail="Hemos recibido tu consulta, a la brevedad nos comunicaremos contigo.";

    /**
     * @var string
     *
     * @ORM\Column(name="address_lng", type="string", length=255,nullable=true)
     */
    private $addressLng;

    /**
     * @var string
     *
     * @ORM\Column(name="address_zoom", type="string", length=255,nullable=true)
     */
    private $addressZoom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255,nullable=true)
     */
    private $address;
    
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
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255,nullable=true)
     */
    private $brand;

    /**
     * Many features have one product. This is the owning side.
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Industry")
     * @ORM\JoinColumn(name="industry_id", referencedColumnName="id",nullable=true)
     */
    private $industry;
    
    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

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
     * Set industry.
     *
     * @param string $industry
     *
     * @return Business
     */
    public function setIndustry($industry)
    {
        $this->industry = $industry;

        return $this;
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
     * Set replyEmail.
     *
     * @param string $replyEmail
     *
     * @return Business
     */
    public function setReplyEmail($replyEmail)
    {
        $this->replyEmail = $replyEmail;

        return $this;
    }

    /**
     * Get replyEmail.
     *
     * @return string
     */
    public function getReplyEmail()
    {
        return $this->replyEmail;
    }
    
    /**
     * Set facebook.
     *
     * @param string|null $facebook
     *
     * @return Business
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
     * Set addressLat.
     *
     * @param string|null $addressLat
     *
     * @return Business
     */
    public function setAddressLat($addressLat = null)
    {
        $this->addressLat = $addressLat;

        return $this;
    }

    /**
     * Get addressLat.
     *
     * @return string|null
     */
    public function getAddressLat()
    {
        return $this->addressLat;
    }
    
    /**
     * Set addressLng.
     *
     * @param string|null $addressLng
     *
     * @return Business
     */
    public function setAddressLng($addressLng = null)
    {
        $this->addressLng = $addressLng;

        return $this;
    }

    /**
     * Get addressLng.
     *
     * @return string|null
     */
    public function getAddressLng()
    {
        return $this->addressLng;
    }
    
    /**
     * Set addressZoom.
     *
     * @param string|null $addressZoom
     *
     * @return Business
     */
    public function setAddressZoom($addressZoom = null)
    {
        $this->addressZoom = $addressZoom;

        return $this;
    }

    /**
     * Get addressZoom.
     *
     * @return string|null
     */
    public function getAddressZoom()
    {
        return $this->addressZoom;
    }
    
    /**
     * Set web.
     *
     * @param string|null $web
     *
     * @return Business
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
     * @return Business
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
     * @return Business
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
     * @return Business
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
     * @return Business
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
     * @return Business
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
     * Set customer.
     *
     * @param string $customer
     *
     * @return Business
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
     * @return Business
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
     * Set address.
     *
     * @param string $address
     *
     * @return Business
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return Business
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
   
    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Business
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Business
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
     * @return Business
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
     * @return Business
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
