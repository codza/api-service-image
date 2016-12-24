<?php

namespace Extia\ServiceImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="tbl_image")
 * @ORM\Entity(repositoryClass="Extia\ServiceImageBundle\Repository\ImageRepository")
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="image_code", type="string", length=255)
     */
    private $imageCode;

    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=255)
     */
    private $imageName;

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageFullName()
    {
        return $this->imageFullName;
    }

    /**
     * @param string $imageFullName
     */
    public function setImageFullName($imageFullName)
    {
        $this->imageFullName = $imageFullName;
    }

    /**
     * @return mixed
     */
    public function getImageType()
    {
        return $this->imageType;
    }

    /**
     * @param mixed $imageType
     */
    public function setImageType($imageType)
    {
        $this->imageType = $imageType;
    }

    /**
     * @return mixed
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * @param mixed $imageSize
     */
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;
    }

    /**
     * @return mixed
     */
    public function getImageExtension()
    {
        return $this->imageExtension;
    }

    /**
     * @param mixed $imageExtension
     */
    public function setImageExtension($imageExtension)
    {
        $this->imageExtension = $imageExtension;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="image_full_name", type="string", length=255)
     */
    private $imageFullName;

    /**
     * @ORM\Column(name="media_type", type="string", nullable=false )
     */
    private $imageType;

    /**
     * @ORM\Column(name="media_size", type="string", nullable=false )
     */
    private $imageSize;

    /**
     * @ORM\Column(name="media_extension", type="string", nullable=false )
     */
    private $imageExtension;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set imageCode
     *
     * @param string $imageCode
     *
     * @return Image
     */
    public function setImageCode($imageCode)
    {
        $this->imageCode = $imageCode;

        return $this;
    }

    /**
     * Get imageCode
     *
     * @return string
     */
    public function getImageCode()
    {
        return $this->imageCode;
    }





}

