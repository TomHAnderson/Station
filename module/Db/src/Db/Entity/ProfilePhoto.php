<?php

namespace Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\ArraySerializableInterface;
use DateTime;

/**
 * ProfilePhoto
 */
class ProfilePhoto implements ArraySerializableInterface
{
    public function __toString()
    {
        return $this->getId();
    }

    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'photo_link':
                case 'photo':
                    $this->setPhoto($value);
                    break;
                case 'highres_link':
                case 'highResolution':
                    $this->setHighResolution($value);
                    break;
                case 'thumb_link':
                case 'thumb':
                    $this->setThumb($value);
                    break;
                default:
                    break;
            }
        }

        return $this;
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'photo' => $this->getPhoto(),
            'highResolution' => $this->getHighResolution(),
            'thumb' => $this->getThumb(),
        ];
    }



    /**
     * @var string
     */
    private $photo;

    /**
     * @var string
     */
    private $highResolution;

    /**
     * @var string
     */
    private $thumb;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Db\Entity\Profile
     */
    private $profile;


    /**
     * Set photo
     *
     * @param string $photo
     * @return ProfilePhoto
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set highResolution
     *
     * @param string $highResolution
     * @return ProfilePhoto
     */
    public function setHighResolution($highResolution)
    {
        $this->highResolution = $highResolution;

        return $this;
    }

    /**
     * Get highResolution
     *
     * @return string
     */
    public function getHighResolution()
    {
        return $this->highResolution;
    }

    /**
     * Set thumb
     *
     * @param string $thumb
     * @return ProfilePhoto
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * Get thumb
     *
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return ProfilePhoto
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set profile
     *
     * @param \Db\Entity\Profile $profile
     * @return ProfilePhoto
     */
    public function setProfile(\Db\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Db\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
