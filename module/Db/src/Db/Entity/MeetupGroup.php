<?php

namespace Db\Entity;

use Zend\Stdlib\ArraySerializableInterface;
use DateTime;

/**
 * MeetupGroup
 */
class MeetupGroup implements ArraySerializableInterface
{
    public function __toString()
    {
        return $this->getName();
    }

    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'name':
                    $this->setName($value);
                    break;
                case 'created':
                    $value = DateTime::createFromFormat('U', $value / 1000);
                case 'createdAt':
                    $this->setCreatedAt($value);
                    break;
                case 'urlname':
                case 'urlName':
                    $this->setUrlName($value);
                    break;
                case 'who':
                    $this->setWho($value);
                    break;
                case 'join_mode':
                case 'joinMode':
                    $this->setJoinMode($value);
                    break;
                case 'group_lat':
                case 'latitude':
                    $this->setLatitude($value);
                    break;
                case 'group_lon':
                case 'longitude':
                    $this->setLongitude($value);
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
            'createdAt' => $this->getCreatedAt(),
            'urlName' => $this->getUrlName(),
            'who' => $this->getWho(),
            'joinMode' => $this->getJoinMode(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
        ];
    }

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $event;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sponsor;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $meetupGroupLink;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $presentationProposal;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $meetupGroupMember;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $jointEvent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sponsor = new \Doctrine\Common\Collections\ArrayCollection();
        $this->meetupGroupLink = new \Doctrine\Common\Collections\ArrayCollection();
        $this->presentationProposal = new \Doctrine\Common\Collections\ArrayCollection();
        $this->meetupGroupMember = new \Doctrine\Common\Collections\ArrayCollection();
        $this->jointEvent = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param  string      $name
     * @return MeetupGroup
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
     * Set id
     *
     * @param  integer     $id
     * @return MeetupGroup
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
     * Add event
     *
     * @param  \Db\Entity\Event $event
     * @return MeetupGroup
     */
    public function addEvent(\Db\Entity\Event $event)
    {
        $this->event[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \Db\Entity\Event $event
     */
    public function removeEvent(\Db\Entity\Event $event)
    {
        $this->event->removeElement($event);
    }

    /**
     * Get event
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Add sponsor
     *
     * @param  \Db\Entity\Sponsor $sponsor
     * @return MeetupGroup
     */
    public function addSponsor(\Db\Entity\Sponsor $sponsor)
    {
        $this->sponsor[] = $sponsor;

        return $this;
    }

    /**
     * Remove sponsor
     *
     * @param \Db\Entity\Sponsor $sponsor
     */
    public function removeSponsor(\Db\Entity\Sponsor $sponsor)
    {
        $this->sponsor->removeElement($sponsor);
    }

    /**
     * Get sponsor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }

    /**
     * Add meetupGroupLink
     *
     * @param  \Db\Entity\MeetupGroupLink $meetupGroupLink
     * @return MeetupGroup
     */
    public function addMeetupGroupLink(\Db\Entity\MeetupGroupLink $meetupGroupLink)
    {
        $this->meetupGroupLink[] = $meetupGroupLink;

        return $this;
    }

    /**
     * Remove meetupGroupLink
     *
     * @param \Db\Entity\MeetupGroupLink $meetupGroupLink
     */
    public function removeMeetupGroupLink(\Db\Entity\MeetupGroupLink $meetupGroupLink)
    {
        $this->meetupGroupLink->removeElement($meetupGroupLink);
    }

    /**
     * Get meetupGroupLink
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetupGroupLink()
    {
        return $this->meetupGroupLink;
    }

    /**
     * Add presentationProposal
     *
     * @param  \Db\Entity\PresentationProposal $presentationProposal
     * @return MeetupGroup
     */
    public function addPresentationProposal(\Db\Entity\PresentationProposal $presentationProposal)
    {
        $this->presentationProposal[] = $presentationProposal;

        return $this;
    }

    /**
     * Remove presentationProposal
     *
     * @param \Db\Entity\PresentationProposal $presentationProposal
     */
    public function removePresentationProposal(\Db\Entity\PresentationProposal $presentationProposal)
    {
        $this->presentationProposal->removeElement($presentationProposal);
    }

    /**
     * Get presentationProposal
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPresentationProposal()
    {
        return $this->presentationProposal;
    }

    /**
     * Add jointEvent
     *
     * @param  \Db\Entity\Event $jointEvent
     * @return MeetupGroup
     */
    public function addJointEvent(\Db\Entity\Event $jointEvent)
    {
        $this->jointEvent[] = $jointEvent;

        return $this;
    }

    /**
     * Remove jointEvent
     *
     * @param \Db\Entity\Event $jointEvent
     */
    public function removeJointEvent(\Db\Entity\Event $jointEvent)
    {
        $this->jointEvent->removeElement($jointEvent);
    }

    /**
     * Get jointEvent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJointEvent()
    {
        return $this->jointEvent;
    }
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $urlName;

    /**
     * @var string
     */
    private $who;

    /**
     * @var string
     */
    private $joinMode;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return MeetupGroup
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
     * Set urlName
     *
     * @param string $urlName
     * @return MeetupGroup
     */
    public function setUrlName($urlName)
    {
        $this->urlName = $urlName;

        return $this;
    }

    /**
     * Get urlName
     *
     * @return string
     */
    public function getUrlName()
    {
        return $this->urlName;
    }

    /**
     * Set who
     *
     * @param string $who
     * @return MeetupGroup
     */
    public function setWho($who)
    {
        $this->who = $who;

        return $this;
    }

    /**
     * Get who
     *
     * @return string
     */
    public function getWho()
    {
        return $this->who;
    }

    /**
     * Set joinMode
     *
     * @param string $joinMode
     * @return MeetupGroup
     */
    public function setJoinMode($joinMode)
    {
        $this->joinMode = $joinMode;

        return $this;
    }

    /**
     * Get joinMode
     *
     * @return string
     */
    public function getJoinMode()
    {
        return $this->joinMode;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return MeetupGroup
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return MeetupGroup
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $profile;


    /**
     * Add profile
     *
     * @param \Db\Entity\Profile $profile
     * @return MeetupGroup
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sponsorContact;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sponsorContribution;


    /**
     * Add sponsorContact
     *
     * @param \Db\Entity\SponsorContact $sponsorContact
     * @return MeetupGroup
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
     * Add sponsorContribution
     *
     * @param \Db\Entity\SponsorContribution $sponsorContribution
     * @return MeetupGroup
     */
    public function addSponsorContribution(\Db\Entity\SponsorContribution $sponsorContribution)
    {
        $this->sponsorContribution[] = $sponsorContribution;

        return $this;
    }

    /**
     * Remove sponsorContribution
     *
     * @param \Db\Entity\SponsorContribution $sponsorContribution
     */
    public function removeSponsorContribution(\Db\Entity\SponsorContribution $sponsorContribution)
    {
        $this->sponsorContribution->removeElement($sponsorContribution);
    }

    /**
     * Get sponsorContribution
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSponsorContribution()
    {
        return $this->sponsorContribution;
    }
}
