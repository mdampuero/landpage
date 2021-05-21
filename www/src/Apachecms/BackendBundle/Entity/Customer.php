<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\Criteria;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\CustomerRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"email"}, repositoryMethod="getUniqueNotDeleted")
 * @ExclusionPolicy("all")
 */
class Customer implements AdvancedUserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @Expose
     */
    private $id;

    /**
     * One customer has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Landing", mappedBy="customer",cascade={"persist"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $landings;
    
    /**
     * One customer has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="LandingContact", mappedBy="customer",cascade={"persist"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $contacts;

    /**
     * One customer has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="File", mappedBy="customer",cascade={"persist"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $files;
    
    /**
     * One customer has many business. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Business", mappedBy="customer",cascade={"persist"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $business;
    
    /**
     * One customer has many business. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Notification", mappedBy="customer",cascade={"persist"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $notifications;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 64
     * )
     * @Expose
     */
    private $firstName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 64
     * )
     * @Expose
     */
    private $lastName;
   
    /**
     * @var string
     *
     * @ORM\Column(name="username_url", type="string", length=100, nullable=true)
     * @Expose
     */
    private $usernameUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=64, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64)
     * @Assert\NotBlank()     
     * @Assert\Length(
     *      min = 2,
     *      max = 64
     * )
     * @Assert\Email() 
     * @Expose
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=255,nullable=true)
     */
    private $facebookId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", length=255,nullable=true)
     */
    private $googleId;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255,nullable=true)
     * @Expose
     */
    private $phone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="business_name", type="string", length=255,nullable=true)
     * @Expose
     */
    private $businessName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="business_cuit", type="string", length=255,nullable=true)
     * @Expose
     */
    private $businessCuit;
    
    /**
     * @var string
     *
     * @ORM\Column(name="business_address", type="string", length=255,nullable=true)
     * @Expose
     */
    private $businessAddress;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="document", type="string", length=255,nullable=true)
     * @Expose
     */
    private $document;

    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumn(name="plan_id", referencedColumnName="id",nullable=true)
     */
    private $plan;
    
    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id",nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 6
     * )
     */

    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=50)
     */
    private $role='ROLE_USER';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float", scale=2, precision=10)
     * @Assert\NotBlank()
     * @Assert\Type(
     *      type="float"
     * )
     */
    private $balance=0.0;

    /**
     * @var string
     *
     * @ORM\Column(name="code_active", type="string", length=255,nullable=true)
     */
    private $codeActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration_code", type="datetime",nullable=true)
     */
    private $expirationCode;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive=true;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="is_validate", type="boolean")
     * @Expose
     */
    private $isValidate=false;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="is_locked", type="boolean")
     */
    private $isLocked=false;

     /**
     * @var string
     *
     * @ORM\Column(name="locked_description", type="text", nullable=true)
     */
    private $lockedDescription;
    
    /**
     * @var string
     *
     * @ORM\Column(name="locked_type", type="string", length=255,nullable=true)
     */
    private $lockedType;
    /**
     * @var string
     *
     * @ORM\Column(name="url_destination", type="text", nullable=true)
     */
    private $urlDestination;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=64, nullable=true)
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"image/png","image/jpeg","image/pjpeg","image/gif"},
     *     mimeTypesMessage = "Seleccione un formato de imagen válido"
     * )
     * @Expose
     */
    private $picture;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration_plan", type="datetime",nullable=true)
     * @Expose
     */
    private $expirationPlan;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Expose
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Expose
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
     * @ORM\Column(name="use_trial", type="boolean",nullable=true)
     */
    private $useTrial;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="profile_is_complete", type="boolean")
     */
    private $profileIsComplete=false;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="accept_terms_and_conditions", type="boolean")
     */
    private $acceptTermsAndConditions=false;

    public function __construct()
    {
        // $this->landings = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get landings
     *
     * @return string
     */
    public function getLandings()
    {
        $criteria = Criteria::create();
        $criteria
        ->where(Criteria::expr()->eq('isDelete', false))
        ->orderBy(
            array(
                'createdAt' => Criteria::DESC,
                'isPublished' => Criteria::DESC
                // 'publishedAt' => Criteria::DESC
                )
        );
        return $this->landings->matching($criteria);
    }
    
    /**
     * Get contacts
     *
     * @return string
     */
    public function getContacts()
    {
        $criteria = Criteria::create();
        $criteria
        ->where(Criteria::expr()->eq('isDelete', false))
        ->orderBy(array('createdAt' => Criteria::DESC));
        return $this->contacts->matching($criteria);
    }
    
    /**
     * Get files
     *
     * @return string
     */
    public function getFiles()
    {
        $criteria = Criteria::create();
        $criteria
        ->where(Criteria::expr()->eq('isDelete', false))
        ->orderBy(
            array(
                'createdAt' => Criteria::DESC
                )
        )
        ;
        return $this->files->matching($criteria);
    }
    
    /**
     * Get business
     *
     * @return string
     */
    public function getBusiness()
    {
        $criteria = Criteria::create();
        $criteria
        ->where(Criteria::expr()->eq('isDelete', false))
        ->orderBy(
            array(
                'createdAt' => Criteria::DESC
                )
        )
        ;
        return $this->business->matching($criteria);
    }
    
    /**
     * Get notifications
     *
     * @return string
     */
    public function getNotification()
    {
        $criteria = Criteria::create();
        $criteria
        ->where(Criteria::expr()->eq('isDelete', false))
        ->andWhere(Criteria::expr()->eq('isRead', false))
        ->orderBy(
            array(
                'createdAt' => Criteria::DESC
                )
        )
        ;
        return $this->notifications->matching($criteria);
    }

    /**
    * Set businessCuit
    *
    * @param string $businessCuit
    *
    * @return Entity
    */
    public function setBusinessCuit($businessCuit)
    {
         $this->businessCuit = $businessCuit;
    
         return $this;
    }
    
    /**
    * Get businessCuit
    *
    * @return Entity
    */
    public function getBusinessCuit()
    {
        return $this->businessCuit;
    }
    
    /**
    * Set balance
    *
    * @param float $balance
    *
    * @return Entity
    */
    public function setBalance($balance)
    {
         $this->balance = $balance;
    
         return $this;
    }
    
    /**
    * Get balance
    *
    * @return Entity
    */
    public function getBalance()
    {
        return $this->balance;
    }
    
    /**
    * Set usernameUrl
    *
    * @param string $usernameUrl
    *
    * @return Entity
    */
    public function setUsernameUrl($usernameUrl)
    {
         $this->usernameUrl = $usernameUrl;
    
         return $this;
    }
    
    /**
    * Get usernameUrl
    *
    * @return Entity
    */
    public function getUsernameUrl()
    {
        return $this->usernameUrl;
    }
    
    /**
    * Set businessName
    *
    * @param string $businessName
    *
    * @return Entity
    */
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;
    
        return $this;
    }
    
    /**
    * Get businessName
    *
    * @return Entity
    */
    public function getBusinessName()
    {
         return $this->businessName;
    }
    
    /**
    * Set businessAddress
    *
    * @param string $businessAddress
    *
    * @return Entity
    */
    public function setBusinessAddress($businessAddress)
    {
        $this->businessAddress = $businessAddress;
        
        return $this;
    }
    
    /**
    * Get businessAddress
    *
    * @return Entity
    */
    public function getBusinessAddress()
    {    
        return $this->businessAddress;
    }
    
    /**
     * Set username
     *
     * @param string $username
     *
     * @return Customer
     */
    public function setUsername($username)
    {
        $this->username = $this->email;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Set codeActive
     *
     * @param string $codeActive
     *
     * @return Customer
     */
    public function setCodeActive($codeActive)
    {
        $this->codeActive = $codeActive;
        $date= new \DateTime();
        $date->add(new \DateInterval('PT24H'));
        $this->setExpirationCode($date);

        return $this;
    }

    /**
     * Get codeActive
     *
     * @return string
     */
    public function getCodeActive()
    {
        return $this->codeActive;
    }


    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Customer
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * Set urlDestination
     *
     * @param string $urlDestination
     *
     * @return Customer
     */
    public function setUrlDestination($urlDestination)
    {
        $this->urlDestination = $urlDestination;

        return $this;
    }

    /**
     * Get urlDestination
     *
     * @return string
     */
    public function getUrlDestination()
    {
        return $this->urlDestination;
    }
    
    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->firstName. " ".$this->lastName;
    }
    
    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Customer
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

   
    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return Customer
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }
    
    /**
     * Set googleId
     *
     * @param string $googleId
     *
     * @return Customer
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * Get googleId
     *
     * @return string
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Customer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * Set plan.
     *
     * @param string $plan
     *
     * @return Plan
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan.
     *
     * @return string
     */
    public function getPlan()
    {
        return $this->plan;
    }
    
    /**
     * Set country.
     *
     * @param string $country
     *
     * @return Plan
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    /**
     * Set document
     *
     * @param string $document
     *
     * @return Customer
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Customer
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set plainPassword
     *
     * @param string $plainPassword
     *
     * @return Customer
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get plainPassword
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Customer
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Customer
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    /**
     * Set acceptTermsAndConditions
     *
     * @param boolean $acceptTermsAndConditions
     *
     * @return Customer
     */
    public function setAcceptTermsAndConditions($acceptTermsAndConditions)
    {
        $this->acceptTermsAndConditions = $acceptTermsAndConditions;

        return $this;
    }

    /**
     * Get acceptTermsAndConditions
     *
     * @return bool
     */
    public function getAcceptTermsAndConditions()
    {
        return $this->acceptTermsAndConditions;
    }
    
    /**
     * Set isValidate
     *
     * @param boolean $isValidate
     *
     * @return Customer
     */
    public function setIsValidate($isValidate)
    {
        $this->isValidate = $isValidate;

        return $this;
    }

    /**
     * Get isValidate
     *
     * @return bool
     */
    public function getIsValidate()
    {
        return $this->isValidate;
    }
    
    /**
     * Set isLocked
     *
     * @param boolean $isLocked
     *
     * @return Customer
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;

        return $this;
    }

    /**
     * Get isLocked
     *
     * @return bool
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Customer
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }



    /** Set description
     *
     * @param string $description
     *
     * @return Customer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /** Set lockedDescription
     *
     * @param string $lockedDescription
     *
     * @return Customer
     */
    public function setLockedDescription($lockedDescription)
    {
        $this->lockedDescription = $lockedDescription;

        return $this;
    }

    /**
     * Get lockedDescription
     *
     * @return string
     */
    public function getLockedDescription()
    {
        return $this->lockedDescription;
    }
    
    /** Set lockedType
     *
     * @param string $lockedType
     *
     * @return Customer
     */
    public function setLockedType($lockedType)
    {
        $this->lockedType = $lockedType;

        return $this;
    }

    /**
     * Get lockedType
     *
     * @return string
     */
    public function getLockedType()
    {
        return $this->lockedType;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Customer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * Set expirationPlan
     *
     * @param \DateTime $expirationPlan
     *
     * @return Customer
     */
    public function setExpirationPlan($expirationPlan)
    {
        $this->expirationPlan = $expirationPlan;

        return $this;
    }

    /**
     * Get expirationPlan
     *
     * @return \DateTime
     */
    public function getExpirationPlan()
    {
        return $this->expirationPlan;
    }

    /**
     * Set expirationCode
     *
     * @param \DateTime $expirationCode
     *
     * @return Customer
     */
    public function setExpirationCode($expirationCode)
    {
        $this->expirationCode = $expirationCode;

        return $this;
    }

    /**
     * Get expirationCode
     *
     * @return \DateTime
     */
    public function getExpirationCode()
    {
        return $this->expirationCode;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Customer
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Customer
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return bool
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }
    
    /**
     * Set useTrial
     *
     * @param boolean $useTrial
     *
     * @return Customer
     */
    public function setUseTrial($useTrial)
    {
        $this->useTrial = $useTrial;

        return $this;
    }

    /**
     * Get useTrial
     *
     * @return bool
     */
    public function getUseTrial()
    {
        return $this->useTrial;
    }
    
    /**
     * Set profileIsComplete
     *
     * @param boolean $profileIsComplete
     *
     * @return Customer
     */
    public function setProfileIsComplete($profileIsComplete)
    {
        $this->profileIsComplete = $profileIsComplete;

        return $this;
    }

    /**
     * Get profileIsComplete
     *
     * @return bool
     */
    public function getProfileIsComplete()
    {
        return $this->profileIsComplete;
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

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    

    public function getRoles()
    {
        return array($this->getRole());
    }

    public function eraseCredentials()
    {
    }


    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
            ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
    /**
     * Checks whether the user's account has expired.
     *
     * @return Boolean true if the user's account is non expired, false otherwise
     */
    public function isAccountNonExpired(){
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * @return Boolean true if the user is not locked, false otherwise
     */
    public function isAccountNonLocked(){
        return true;

    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * @return Boolean true if the user's credentials are non expired, false otherwise
     */
    public function isCredentialsNonExpired(){
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * @return Boolean true if the user is enabled, false otherwise
     */
    public function isEnabled(){
        return $this->isActive;
    }

}