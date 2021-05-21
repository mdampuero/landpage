<?php

namespace Apachecms\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Setting
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\SettingRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class Setting
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
     * @ORM\Column(name="google_maps_id", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $googleMapsId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dolar", type="float", nullable=true)
     * @Assert\NotBlank()
     */
    private $dolar;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mp_client_id", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $mpClientId;

    /**
     * @var string
     *
     * @ORM\Column(name="mp_client_secret", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $mpClientSecret;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mp_access_token", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $mpAccessToken;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mp_public_key", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $mpPublicKey;
    
    /**
     * @var string
     *
     * @ORM\Column(name="greeting_second_response", type="text")
     * @Assert\NotBlank()
     */
    private $greetingSecondResponse;
    
    /**
     * @var string
     *
     * @ORM\Column(name="greeting_second_trigger", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $greetingSecondTrigger;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pp_client_id", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $ppClientId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="more_info_response", type="text")
     * @Assert\NotBlank()
     */
    private $moreInfoResponse;
    
    /**
     * @var string
     *
     * @ORM\Column(name="more_info_trigger", type="text")
     * @Assert\NotBlank()
     */
    private $moreInfoTrigger;
    
    /**
     * @var string
     *
     * @ORM\Column(name="more_price_response", type="text")
     * @Assert\NotBlank()
     */
    private $morePriceResponse;
    
    /**
     * @var string
     *
     * @ORM\Column(name="more_price_trigger", type="text")
     * @Assert\NotBlank()
     */
    private $morePriceTrigger;
    
    /**
     * @var string
     *
     * @ORM\Column(name="not_understand", type="text")
     * @Assert\NotBlank()
     */
    private $notUnderstand;
    
    /**
     * @var string
     *
     * @ORM\Column(name="not_use_phone_trigger", type="text")
     * @Assert\NotBlank()
     */
    private $notUsePhoneTrigger;
    
    /**
     * @var string
     *
     * @ORM\Column(name="not_use_phone_response", type="text")
     * @Assert\NotBlank()
     */
    private $notUsePhoneResponse;
    
    /**
     * @var string
     *
     * @ORM\Column(name="phone_not_valid", type="text")
     * @Assert\NotBlank()
     */
    private $phoneNotValid;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email_not_valid", type="text")
     * @Assert\NotBlank()
     */
    private $emailNotValid;

    /**
     * @var string
     *
     * @ORM\Column(name="login_google_client_id", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $loginGoogleClientId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="login_facebook_app_id", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $loginFacebookAppId;

    /**
     * @var string
     *
     * @ORM\Column(name="script_google_analytics", type="text",nullable=true)
     */
    private $scriptGoogleAnalytics;
    
    /**
     * @var string
     *
     * @ORM\Column(name="meta_tags", type="text",nullable=true)
     */
    private $metaTags;

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
     * Set googleMapsId.
     *
     * @param string $googleMapsId
     *
     * @return Setting
     */
    public function setGoogleMapsId($googleMapsId)
    {
        $this->googleMapsId = $googleMapsId;

        return $this;
    }

    /**
     * Get googleMapsId.
     *
     * @return string
     */
    public function getGoogleMapsId()
    {
        return $this->googleMapsId;
    }
    
    /**
     * Set dolar.
     *
     * @param string $dolar
     *
     * @return Setting
     */
    public function setDolar($dolar)
    {
        $this->dolar = $dolar;

        return $this;
    }

    /**
     * Get dolar.
     *
     * @return string
     */
    public function getDolar()
    {
        return $this->dolar;
    }
    
    /**
     * Set mpClientId.
     *
     * @param string $mpClientId
     *
     * @return Setting
     */
    public function setMpClientId($mpClientId)
    {
        $this->mpClientId = $mpClientId;

        return $this;
    }

    /**
     * Get mpClientId.
     *
     * @return string
     */
    public function getMpClientId()
    {
        return $this->mpClientId;
    }
    
    /**
     * Set mpClientSecret.
     *
     * @param string $mpClientSecret
     *
     * @return Setting
     */
    public function setMpClientSecret($mpClientSecret)
    {
        $this->mpClientSecret = $mpClientSecret;

        return $this;
    }

    /**
     * Get mpClientSecret.
     *
     * @return string
     */
    public function getMpClientSecret()
    {
        return $this->mpClientSecret;
    }
    
    /**
     * Set mpAccessToken.
     *
     * @param string $mpAccessToken
     *
     * @return Setting
     */
    public function setMpAccessToken($mpAccessToken)
    {
        $this->mpAccessToken = $mpAccessToken;

        return $this;
    }

    /**
     * Get mpAccessToken.
     *
     * @return string
     */
    public function getMpAccessToken()
    {
        return $this->mpAccessToken;
    }
    
    /**
     * Set mpPublicKey.
     *
     * @param string $mpPublicKey
     *
     * @return Setting
     */
    public function setMpPublicKey($mpPublicKey)
    {
        $this->mpPublicKey = $mpPublicKey;

        return $this;
    }

    /**
     * Get mpPublicKey.
     *
     * @return string
     */
    public function getMpPublicKey()
    {
        return $this->mpPublicKey;
    }
    
    /**
     * Set greetingSecondResponse.
     *
     * @param string $greetingSecondResponse
     *
     * @return Setting
     */
    public function setGreetingSecondResponse($greetingSecondResponse)
    {
        $this->greetingSecondResponse = $greetingSecondResponse;

        return $this;
    }

    /**
     * Get greetingSecondResponse.
     *
     * @return string
     */
    public function getGreetingSecondResponse()
    {
        return $this->greetingSecondResponse;
    }
    
    /**
     * Set greetingSecondTrigger.
     *
     * @param string $greetingSecondTrigger
     *
     * @return Setting
     */
    public function setGreetingSecondTrigger($greetingSecondTrigger)
    {
        $this->greetingSecondTrigger = $greetingSecondTrigger;

        return $this;
    }

    /**
     * Get greetingSecondTrigger.
     *
     * @return string
     */
    public function getGreetingSecondTrigger()
    {
        return $this->greetingSecondTrigger;
    }
    
    /**
     * Set ppClientId.
     *
     * @param string $ppClientId
     *
     * @return Setting
     */
    public function setPpClientId($ppClientId)
    {
        $this->ppClientId = $ppClientId;

        return $this;
    }

    /**
     * Get ppClientId.
     *
     * @return string
     */
    public function getPpClientId()
    {
        return $this->ppClientId;
    }
    
    /**
     * Set moreInfoTrigger.
     *
     * @param string $moreInfoTrigger
     *
     * @return Setting
     */
    public function setMoreInfoTrigger($moreInfoTrigger)
    {
        $this->moreInfoTrigger = $moreInfoTrigger;

        return $this;
    }

    /**
     * Get moreInfoTrigger.
     *
     * @return string
     */
    public function getMoreInfoTrigger()
    {
        return $this->moreInfoTrigger;
    }
    
    /**
     * Set moreInfoResponse.
     *
     * @param string $moreInfoResponse
     *
     * @return Setting
     */
    public function setMoreInfoResponse($moreInfoResponse)
    {
        $this->moreInfoResponse = $moreInfoResponse;

        return $this;
    }

    /**
     * Get moreInfoResponse.
     *
     * @return string
     */
    public function getMoreInfoResponse()
    {
        return $this->moreInfoResponse;
    }
    
    /**
     * Set morePriceResponse.
     *
     * @param string $morePriceResponse
     *
     * @return Setting
     */
    public function setMorePriceResponse($morePriceResponse)
    {
        $this->morePriceResponse = $morePriceResponse;

        return $this;
    }

    /**
     * Get morePriceResponse.
     *
     * @return string
     */
    public function getMorePriceResponse()
    {
        return $this->morePriceResponse;
    }

    /**
     * Set morePriceTrigger.
     *
     * @param string $morePriceTrigger
     *
     * @return Setting
     */
    public function setMorePriceTrigger($morePriceTrigger)
    {
        $this->morePriceTrigger = $morePriceTrigger;

        return $this;
    }

    /**
     * Get morePriceTrigger.
     *
     * @return string
     */
    public function getMorePriceTrigger()
    {
        return $this->morePriceTrigger;
    }
    
    /**
     * Set notUnderstand.
     *
     * @param string $notUnderstand
     *
     * @return Setting
     */
    public function setNotUnderstand($notUnderstand)
    {
        $this->notUnderstand = $notUnderstand;

        return $this;
    }

    /**
     * Get notUnderstand.
     *
     * @return string
     */
    public function getNotUnderstand()
    {
        return $this->notUnderstand;
    }
    
    /**
     * Set notUsePhoneTrigger.
     *
     * @param string $notUsePhoneTrigger
     *
     * @return Setting
     */
    public function setNotUsePhoneTrigger($notUsePhoneTrigger)
    {
        $this->notUsePhoneTrigger = $notUsePhoneTrigger;

        return $this;
    }

    /**
     * Get notUsePhoneTrigger.
     *
     * @return string
     */
    public function getNotUsePhoneTrigger()
    {
        return $this->notUsePhoneTrigger;
    }
    
    /**
     * Set phoneNotValid.
     *
     * @param string $phoneNotValid
     *
     * @return Setting
     */
    public function setPhoneNotValid($phoneNotValid)
    {
        $this->phoneNotValid = $phoneNotValid;

        return $this;
    }

    /**
     * Get phoneNotValid.
     *
     * @return string
     */
    public function getPhoneNotValid()
    {
        return $this->phoneNotValid;
    }
    
    /**
     * Set emailNotValid.
     *
     * @param string $emailNotValid
     *
     * @return Setting
     */
    public function setEmailNotValid($emailNotValid)
    {
        $this->emailNotValid = $emailNotValid;

        return $this;
    }

    /**
     * Get emailNotValid.
     *
     * @return string
     */
    public function getEmailNotValid()
    {
        return $this->emailNotValid;
    }
    
    /**
     * Set notUsePhoneResponse.
     *
     * @param string $notUsePhoneResponse
     *
     * @return Setting
     */
    public function setNotUsePhoneResponse($notUsePhoneResponse)
    {
        $this->notUsePhoneResponse = $notUsePhoneResponse;

        return $this;
    }

    /**
     * Get notUsePhoneResponse.
     *
     * @return string
     */
    public function getNotUsePhoneResponse()
    {
        return $this->notUsePhoneResponse;
    }
    
    /**
     * Set loginGoogleClientId.
     *
     * @param string $loginGoogleClientId
     *
     * @return Setting
     */
    public function setLoginGoogleClientId($loginGoogleClientId)
    {
        $this->loginGoogleClientId = $loginGoogleClientId;

        return $this;
    }

    /**
     * Get loginGoogleClientId.
     *
     * @return string
     */
    public function getLoginGoogleClientId()
    {
        return $this->loginGoogleClientId;
    }
    
    /**
     * Set loginFacebookAppId.
     *
     * @param string $loginFacebookAppId
     *
     * @return Setting
     */
    public function setLoginFacebookAppId($loginFacebookAppId)
    {
        $this->loginFacebookAppId = $loginFacebookAppId;

        return $this;
    }

    /**
     * Get loginFacebookAppId.
     *
     * @return string
     */
    public function getLoginFacebookAppId()
    {
        return $this->loginFacebookAppId;
    }
    
    /**
     * Set scriptGoogleAnalytics.
     *
     * @param string $scriptGoogleAnalytics
     *
     * @return Setting
     */
    public function setScriptGoogleAnalytics($scriptGoogleAnalytics)
    {
        $this->scriptGoogleAnalytics = $scriptGoogleAnalytics;

        return $this;
    }

    /**
     * Get scriptGoogleAnalytics.
     *
     * @return string
     */
    public function getScriptGoogleAnalytics()
    {
        return $this->scriptGoogleAnalytics;
    }
    
    /**
     * Set metaTags.
     *
     * @param string $metaTags
     *
     * @return Setting
     */
    public function setMetaTags($metaTags)
    {
        $this->metaTags = $metaTags;

        return $this;
    }

    /**
     * Get metaTags.
     *
     * @return string
     */
    public function getMetaTags()
    {
        return $this->metaTags;
    }
    
    
    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return Site
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
