<?php

namespace Apachecms\BackendBundle\Entity;

use     Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Page
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Apachecms\BackendBundle\Repository\PageRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"code"}, repositoryMethod="getUniqueNotDeleted")
 * 
 */
class Page
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
     * @ORM\Column(name="name_es", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nameEs;
    
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $code;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nameEn", type="string", length=255,nullable=true)
     */
    private $nameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="description_es", type="text",nullable=true)
     */
    private $descriptionEs;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description_en", type="text",nullable=true)
     */
    private $descriptionEn;

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
     * Set nameEs.
     *
     * @param string $nameEs
     *
     * @return Page
     */
    public function setNameEs($nameEs)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * Get nameEs.
     *
     * @return string
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }
    
    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Page
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
    
    /**
     * Set descriptionEs.
     *
     * @param string $descriptionEs
     *
     * @return Page
     */
    public function setDescriptionEs($descriptionEs)
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * Get descriptionEs.
     *
     * @return string
     */
    public function getDescriptionEs()
    {
        return $this->descriptionEs;
    }
    
    /**
     * Set descriptionEn.
     *
     * @param string $descriptionEn
     *
     * @return Page
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * Get descriptionEn.
     *
     * @return string
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }
    
    
    /**
     * Set nameEn.
     *
     * @param string $nameEn
     *
     * @return Page
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get nameEn.
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
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
