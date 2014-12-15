<?php

namespace Db\Entity;

use Zend\Stdlib\ArraySerializableInterface;
use DateTime;

/**
 * Member
 */
class Member implements ArraySerializableInterface
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getProfileByMeetupGroup(MeetupGroup $meetupGroup)
    {
        foreach ($this->getProfile() as $profile) {
            if ($profile->getMeetupGroup() == $meetupGroup) {
                return $profile;
            }
        }

        return null;
    }

    public function exchangeArray(array $data)
    {
        foreach ($data as $field => $value) {
            switch ($field) {
                case 'id':
                    $this->setId($value);
                    break;
                case 'name':
                    $this->setName($value);
                    break;
                case 'status':
                    $this->setStatus($value);
                    break;
                case 'state':
                    $this->setState($value);
                    break;
                case 'language':
                case 'lang':
                    $this->setLanguage($value);
                    break;
                case 'city':
                    $this->setCity($value);
                    break;
                case 'country':
                    $this->setCountry($value);
                    break;
                case 'visited':
                    $this->setVisitedAt(DateTime::createFromFormat('U', ($value / 1000)));
                    break;
                case 'visitedAt':
                    $this->setVisitedAt($value);
                    break;
                case 'joined':
                    $this->setJoinedAt(DateTime::createFromFormat('U', ($value / 1000)));
                    break;
                case 'joinedAt':
                    $this->setJoinedAt($value);
                    break;
                default:
                    break;
            }
        }

        $this->setUpdatedAt(new \DateTime());

        return $this;
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'status' => $this->getStatus(),
            'state' => $this->getState(),
            'language' => $this->getLanguage(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'visitedAt' => $this->getVisitedAt(),
            'joinedAt' => $this->getJoinedAt(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
        ];
    }

    // Getters for auditing
    public function getDisplayName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return 'https://www.meetup.com/members/'.$this->getId();
    }

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var \DateTime
     */
    private $visitedAt;

    /**
     * @var \DateTime
     */
    private $joinedAt;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $presentation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $meetupUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sponsorContact;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $memberLink;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $meetupGroupMember;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $eventHost;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->presentation = new \Doctrine\Common\Collections\ArrayCollection();
        $this->meetupUser = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sponsorContact = new \Doctrine\Common\Collections\ArrayCollection();
        $this->memberLink = new \Doctrine\Common\Collections\ArrayCollection();
        $this->meetupGroupMember = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventHost = new \Doctrine\Common\Collections\ArrayCollection();
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return Member
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
     * Set status
     *
     * @param  string $status
     * @return Member
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
     * Set state
     *
     * @param  string $state
     * @return Member
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set language
     *
     * @param  string $language
     * @return Member
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set city
     *
     * @param  string $city
     * @return Member
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param  string $country
     * @return Member
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set visitedAt
     *
     * @param  \DateTime $visitedAt
     * @return Member
     */
    public function setVisitedAt($visitedAt)
    {
        $this->visitedAt = $visitedAt;

        return $this;
    }

    /**
     * Get visitedAt
     *
     * @return \DateTime
     */
    public function getVisitedAt()
    {
        return $this->visitedAt;
    }

    /**
     * Set joinedAt
     *
     * @param  \DateTime $joinedAt
     * @return Member
     */
    public function setJoinedAt($joinedAt)
    {
        $this->joinedAt = $joinedAt;

        return $this;
    }

    /**
     * Get joinedAt
     *
     * @return \DateTime
     */
    public function getJoinedAt()
    {
        return $this->joinedAt;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Member
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
     * Set id
     *
     * @param  integer $id
     * @return Member
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
     * Add presentation
     *
     * @param  \Db\Entity\Presentation $presentation
     * @return Member
     */
    public function addPresentation(\Db\Entity\Presentation $presentation)
    {
        $this->presentation[] = $presentation;

        return $this;
    }

    /**
     * Remove presentation
     *
     * @param \Db\Entity\Presentation $presentation
     */
    public function removePresentation(\Db\Entity\Presentation $presentation)
    {
        $this->presentation->removeElement($presentation);
    }

    /**
     * Get presentation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Add meetupUser
     *
     * @param  \Db\Entity\MeetupMember $meetupUser
     * @return Member
     */
    public function addMeetupUser(\Db\Entity\MeetupMember $meetupUser)
    {
        $this->meetupUser[] = $meetupUser;

        return $this;
    }

    /**
     * Remove meetupUser
     *
     * @param \Db\Entity\MeetupMember $meetupUser
     */
    public function removeMeetupUser(\Db\Entity\MeetupMember $meetupUser)
    {
        $this->meetupUser->removeElement($meetupUser);
    }

    /**
     * Get meetupUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetupUser()
    {
        return $this->meetupUser;
    }

    /**
     * Add sponsorContact
     *
     * @param  \Db\Entity\SponsorContact $sponsorContact
     * @return Member
     */
    public function addSponsorContact(\Db\Entity\SponsorContact $sponsorContact)
    {
        $this->sponsorContact[] = $sponsorContact;

        return $this;
    }

    /**
     * Remove sponsorContact
     *
     * @param \Db\Entity\SponsorContact $sponsorContact
     */
    public function removeSponsorContact(\Db\Entity\SponsorContact $sponsorContact)
    {
        $this->sponsorContact->removeElement($sponsorContact);
    }

    /**
     * Get sponsorContact
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSponsorContact()
    {
        return $this->sponsorContact;
    }

    /**
     * Add memberLink
     *
     * @param  \Db\Entity\MemberLink $memberLink
     * @return Member
     */
    public function addMemberLink(\Db\Entity\MemberLink $memberLink)
    {
        $this->memberLink[] = $memberLink;

        return $this;
    }

    /**
     * Remove memberLink
     *
     * @param \Db\Entity\MemberLink $memberLink
     */
    public function removeMemberLink(\Db\Entity\MemberLink $memberLink)
    {
        $this->memberLink->removeElement($memberLink);
    }

    /**
     * Get memberLink
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMemberLink()
    {
        return $this->memberLink;
    }

    /**
     * Add meetupGroupMember
     *
     * @param  \Db\Entity\MeetupGroupMember $meetupGroupMember
     * @return Member
     */
    public function addMeetupGroupMember(\Db\Entity\MeetupGroupMember $meetupGroupMember)
    {
        $this->meetupGroupMember[] = $meetupGroupMember;

        return $this;
    }

    /**
     * Remove meetupGroupMember
     *
     * @param \Db\Entity\MeetupGroupMember $meetupGroupMember
     */
    public function removeMeetupGroupMember(\Db\Entity\MeetupGroupMember $meetupGroupMember)
    {
        $this->meetupGroupMember->removeElement($meetupGroupMember);
    }

    /**
     * Get meetupGroupMember
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetupGroupMember()
    {
        return $this->meetupGroupMember;
    }

    /**
     * Add eventHost
     *
     * @param  \Db\Entity\Event $eventHost
     * @return Member
     */
    public function addEventHost(\Db\Entity\Event $eventHost)
    {
        $this->eventHost[] = $eventHost;

        return $this;
    }

    /**
     * Remove eventHost
     *
     * @param \Db\Entity\Event $eventHost
     */
    public function removeEventHost(\Db\Entity\Event $eventHost)
    {
        $this->eventHost->removeElement($eventHost);
    }

    /**
     * Get eventHost
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventHost()
    {
        return $this->eventHost;
    }

    /**
     * Add role
     *
     * @param  \Db\Entity\Role $role
     * @return Member
     */
    public function addRole(\Db\Entity\Role $role)
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Db\Entity\Role $role
     */
    public function removeRole(\Db\Entity\Role $role)
    {
        $this->role->removeElement($role);
    }

    /**
     * Get role
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Set updatedAt
     *
     * @param  \DateTime $updatedAt
     * @return Member
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
     * @var \DateTime
     */
    private $lastRequestAt;

    /**
     * Set lastRequestAt
     *
     * @param  \DateTime $lastRequestAt
     * @return Member
     */
    public function setLastRequestAt($lastRequestAt)
    {
        $this->lastRequestAt = $lastRequestAt;

        return $this;
    }

    /**
     * Get lastRequestAt
     *
     * @return \DateTime
     */
    public function getLastRequestAt()
    {
        return $this->lastRequestAt;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $profile;


    /**
     * Add profile
     *
     * @param \Db\Entity\Profile $profile
     * @return Member
     */
    public function addProfile(\Db\Entity\Profile $profile)
    {
        $this->profile[] = $profile;

        return $this;
    }

    /**
     * Remove profile
     *
     * @param \Db\Entity\Profile $profile
     */
    public function removeProfile(\Db\Entity\Profile $profile)
    {
        $this->profile->removeElement($profile);
    }

    /**
     * Get profile
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
