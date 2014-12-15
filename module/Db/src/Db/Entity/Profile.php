<?php

namespace Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\ArraySerializableInterface;
use DateTime;

/**
 * Profile
 */
class Profile implements ArraySerializableInterface
{
    public function __toString()
    {
        return $this->getMeetupGroup()->getName() . ': ' . $this->getName();
    }

    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'role':
                    $this->setRole($value);
                    break;
                case 'url':
                case 'profile_url':
                    $this->setUrl($value);
                    break;
                case 'status':
                    $this->setStatus($value);
                    break;
                case 'visited':
                    $value = DateTime::createFromFormat('U', $value / 1000);
                case 'lastVisitedAt':
                    $this->setLastVisitedAt($value);
                    break;
                case 'bio':
                case 'biography':
                    $this->setBiography($value);
                    break;
                case 'created':
                    $value = DateTime::createFromFormat('U', $value / 1000);
                case 'createdAt':
                    $this->setCreatedAt($value);
                    break;
                case 'updated':
                    $value = DateTime::createFromFormat('U', $value / 1000);
                case 'updatedAt':
                    $this->setUpdatedAt($value);
                    break;
                case 'name':
                    $this->setName($value);
                    break;
                case 'title':
                    $this->setTitle($value);
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
            'name' => $this->getName(),
            'title' => $this->getTitle(),
            'role' => $this->getRole(),
            'url' => $this->getUrl(),
            'status' => $this->getStatus(),
            'lastVisitedAt' => $this->getLastVisitedAt(),
            'biography' => $this->getBiography(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
        ];
    }


    /**
     * @var string
     */
    private $role;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $lastVisitedAt;

    /**
     * @var string
     */
    private $biography;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $profilePhoto;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $profileAnswer;

    /**
     * @var \Db\Entity\MeetupGroup
     */
    private $meetupGroup;

    /**
     * @var \Db\Entity\Member
     */
    private $member;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Profile
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
     * Set url
     *
     * @param string $url
     * @return Profile
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Profile
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set lastVisitedAt
     *
     * @param \DateTime $lastVisitedAt
     * @return Profile
     */
    public function setLastVisitedAt($lastVisitedAt)
    {
        $this->lastVisitedAt = $lastVisitedAt;

        return $this;
    }

    /**
     * Get lastVisitedAt
     *
     * @return \DateTime
     */
    public function getLastVisitedAt()
    {
        return $this->lastVisitedAt;
    }

    /**
     * Set biography
     *
     * @param string $biography
     * @return Profile
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Profile
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Profile
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
     * Set name
     *
     * @param string $name
     * @return Profile
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Profile
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
     * Get profilePhoto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfilePhoto()
    {
        return $this->profilePhoto;
    }

    /**
     * Get profileAnswer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfileAnswer()
    {
        return $this->profileAnswer;
    }

    /**
     * Set meetupGroup
     *
     * @param \Db\Entity\MeetupGroup $meetupGroup
     * @return Profile
     */
    public function setMeetupGroup(\Db\Entity\MeetupGroup $meetupGroup = null)
    {
        $this->meetupGroup = $meetupGroup;

        return $this;
    }

    /**
     * Get meetupGroup
     *
     * @return \Db\Entity\MeetupGroup
     */
    public function getMeetupGroup()
    {
        return $this->meetupGroup;
    }

    /**
     * Set member
     *
     * @param \Db\Entity\Member $member
     * @return Profile
     */
    public function setMember(\Db\Entity\Member $member = null)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \Db\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
    }


    /**
     * Set profilePhoto
     *
     * @param \Db\Entity\ProfilePhoto $profilePhoto
     * @return Profile
     */
    public function setProfilePhoto(\Db\Entity\ProfilePhoto $profilePhoto = null)
    {
        $this->profilePhoto = $profilePhoto;

        return $this;
    }


    /**
     * Add profileAnswer
     *
     * @param \Db\Entity\ProfileAnswer $profileAnswer
     * @return Profile
     */
    public function addProfileAnswer(\Db\Entity\ProfileAnswer $profileAnswer)
    {
        $this->profileAnswer[] = $profileAnswer;

        return $this;
    }

    /**
     * Remove profileAnswer
     *
     * @param \Db\Entity\ProfileAnswer $profileAnswer
     */
    public function removeProfileAnswer(\Db\Entity\ProfileAnswer $profileAnswer)
    {
        $this->profileAnswer->removeElement($profileAnswer);
    }
}
