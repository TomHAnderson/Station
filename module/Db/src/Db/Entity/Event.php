<?php

namespace Db\Entity;

use Zend\Stdlib\ArraySerializableInterface;
use DateTime;

/**
 * Event
 */
class Event implements ArraySerializableInterface
{
    public function __toString()
    {
        return $this->getName();
    }

    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'rsvp_limit':
                case 'rsvpLimit':
                    $this->setRsvpLimit($value);
                    break;
                case 'status':
                    $this->setStatus($value);
                    break;
                case 'visibility':
                    $this->setVisibility($value);
                    break;
                case 'maybe_rsvp_count':
                case 'maybeRsvpCount':
                    $this->setMaybeRsvpCount($value);
                    break;
                case 'utc_offset':
                case 'utcOffset':
                    $this->setUtcOffset($value);
                    break;
                case 'time':
                    $value = DateTime::createFromFormat('U', $value / 1000);
                case 'scheduledAt':
                    $this->setScheduledAt($value);
                    break;
                case 'waitlist_count':
                case 'waitlistCount':
                    $this->setWaitlistCount($value);
                    break;
                case 'updated':
                    $value = DateTime::createFromFormat('U', $value / 1000);
                case 'updatedAt':
                    $this->setUpdatedAt($value);
                    break;
                case 'yes_rsvp_count':
                case 'yesRsvpCount':
                    $this->setYesRsvpCount($value);
                    break;
                case 'created':
                    $value = DateTime::createFromFormat('U', $value / 1000);
                case 'createdAt':
                    $this->setCreatedAt($value);
                    break;
                case 'event_url':
                case 'url':
                    $this->setUrl($value);
                    break;
                case 'description':
                    $this->setDescription($value);
                    break;
                case 'name':
                    $this->setName($value);
                    break;
                case 'headcount':
                    $this->setHeadcount($value);
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
            'rsvpLimit' => $this->getRsvpLimit(),
            'status' => $this->getStatus(),
            'visibility' => $this->getVisibility(),
            'maybeRsvpCount' => $this->getMaybeRsvpCount(),
            'utcOffset' => $this->getUtcOffset(),
            'scheduledAt' => $this->getScheduledAt(),
            'waitlistCount' => $this->getWaitlistCount(),
            'updatedAt' => $this->getUpdatedAt(),
            'yesRsvpCount' => $this->getYesRsvpCount(),
            'createdAt' => $this->getCreatedAt(),
            'url' => $this->getUrl(),
            'description' => $this->getDescription(),
            'name' => $this->getName(),
            'headcount' => $this->getHeadcount(),
        ];
    }

    /**
     * @var \DateTime
     */
    private $scheduledAt;

    /**
     * @var string
     */
    private $videoUrl;

    /**
     * @var \DateTime
     */
    private $videoStartAt;

    /**
     * @var \DateTime
     */
    private $startAt;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $abstract;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $why;

    /**
     * @var integer
     */
    private $duration;

    /**
     * @var integer
     */
    private $guestLimit;

    /**
     * @var string
     */
    private $directions;

    /**
     * @var integer
     */
    private $isPublished;

    /**
     * @var \DateTime
     */
    private $rsvpOpen;

    /**
     * @var \DateTime
     */
    private $rsvpClose;

    /**
     * @var integer
     */
    private $rsvpLimit;

    /**
     * @var string
     */
    private $waitListing;

    /**
     * @var string
     */
    private $hostInstruction;

    /**
     * @var boolean
     */
    private $enableEmailReminders;

    /**
     * @var boolean
     */
    private $isVenuePublic;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $meetupUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $meetupLink;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sponsorContribution;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $presentationProposal;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $eventQuestion;

    /**
     * @var \Db\Entity\Venue
     */
    private $venue;

    /**
     * @var \Db\Entity\MeetupGroup
     */
    private $meetupGroup;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $jointMeetupGroup;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $host;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meetupUser = new \Doctrine\Common\Collections\ArrayCollection();
        $this->meetupLink = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sponsorContribution = new \Doctrine\Common\Collections\ArrayCollection();
        $this->presentationProposal = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventQuestion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->jointMeetupGroup = new \Doctrine\Common\Collections\ArrayCollection();
        $this->host = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set scheduledAt
     *
     * @param  \DateTime $scheduledAt
     * @return Event
     */
    public function setScheduledAt($scheduledAt)
    {
        $this->scheduledAt = $scheduledAt;

        return $this;
    }

    /**
     * Get scheduledAt
     *
     * @return \DateTime
     */
    public function getScheduledAt()
    {
        return $this->scheduledAt;
    }

    /**
     * Set videoUrl
     *
     * @param  string $videoUrl
     * @return Event
     */
    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    /**
     * Get videoUrl
     *
     * @return string
     */
    public function getVideoUrl()
    {
        return $this->videoUrl;
    }

    /**
     * Set videoStartAt
     *
     * @param  \DateTime $videoStartAt
     * @return Event
     */
    public function setVideoStartAt($videoStartAt)
    {
        $this->videoStartAt = $videoStartAt;

        return $this;
    }

    /**
     * Get videoStartAt
     *
     * @return \DateTime
     */
    public function getVideoStartAt()
    {
        return $this->videoStartAt;
    }

    /**
     * Set startAt
     *
     * @param  \DateTime $startAt
     * @return Event
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get startAt
     *
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return Event
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
     * Set abstract
     *
     * @param  string $abstract
     * @return Event
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set description
     *
     * @param  string $description
     * @return Event
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

    /**
     * Set why
     *
     * @param  string $why
     * @return Event
     */
    public function setWhy($why)
    {
        $this->why = $why;

        return $this;
    }

    /**
     * Get why
     *
     * @return string
     */
    public function getWhy()
    {
        return $this->why;
    }

    /**
     * Set duration
     *
     * @param  integer $duration
     * @return Event
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set guestLimit
     *
     * @param  integer $guestLimit
     * @return Event
     */
    public function setGuestLimit($guestLimit)
    {
        $this->guestLimit = $guestLimit;

        return $this;
    }

    /**
     * Get guestLimit
     *
     * @return integer
     */
    public function getGuestLimit()
    {
        return $this->guestLimit;
    }

    /**
     * Set directions
     *
     * @param  string $directions
     * @return Event
     */
    public function setDirections($directions)
    {
        $this->directions = $directions;

        return $this;
    }

    /**
     * Get directions
     *
     * @return string
     */
    public function getDirections()
    {
        return $this->directions;
    }

    /**
     * Set isPublished
     *
     * @param  integer $isPublished
     * @return Event
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return integer
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set rsvpOpen
     *
     * @param  \DateTime $rsvpOpen
     * @return Event
     */
    public function setRsvpOpen($rsvpOpen)
    {
        $this->rsvpOpen = $rsvpOpen;

        return $this;
    }

    /**
     * Get rsvpOpen
     *
     * @return \DateTime
     */
    public function getRsvpOpen()
    {
        return $this->rsvpOpen;
    }

    /**
     * Set rsvpClose
     *
     * @param  \DateTime $rsvpClose
     * @return Event
     */
    public function setRsvpClose($rsvpClose)
    {
        $this->rsvpClose = $rsvpClose;

        return $this;
    }

    /**
     * Get rsvpClose
     *
     * @return \DateTime
     */
    public function getRsvpClose()
    {
        return $this->rsvpClose;
    }

    /**
     * Set rsvpLimit
     *
     * @param  integer $rsvpLimit
     * @return Event
     */
    public function setRsvpLimit($rsvpLimit)
    {
        $this->rsvpLimit = $rsvpLimit;

        return $this;
    }

    /**
     * Get rsvpLimit
     *
     * @return integer
     */
    public function getRsvpLimit()
    {
        return $this->rsvpLimit;
    }

    /**
     * Set waitListing
     *
     * @param  string $waitListing
     * @return Event
     */
    public function setWaitListing($waitListing)
    {
        $this->waitListing = $waitListing;

        return $this;
    }

    /**
     * Get waitListing
     *
     * @return string
     */
    public function getWaitListing()
    {
        return $this->waitListing;
    }

    /**
     * Set hostInstruction
     *
     * @param  string $hostInstruction
     * @return Event
     */
    public function setHostInstruction($hostInstruction)
    {
        $this->hostInstruction = $hostInstruction;

        return $this;
    }

    /**
     * Get hostInstruction
     *
     * @return string
     */
    public function getHostInstruction()
    {
        return $this->hostInstruction;
    }

    /**
     * Set enableEmailReminders
     *
     * @param  boolean $enableEmailReminders
     * @return Event
     */
    public function setEnableEmailReminders($enableEmailReminders)
    {
        $this->enableEmailReminders = $enableEmailReminders;

        return $this;
    }

    /**
     * Get enableEmailReminders
     *
     * @return boolean
     */
    public function getEnableEmailReminders()
    {
        return $this->enableEmailReminders;
    }

    /**
     * Set isVenuePublic
     *
     * @param  boolean $isVenuePublic
     * @return Event
     */
    public function setIsVenuePublic($isVenuePublic)
    {
        $this->isVenuePublic = $isVenuePublic;

        return $this;
    }

    /**
     * Get isVenuePublic
     *
     * @return boolean
     */
    public function getIsVenuePublic()
    {
        return $this->isVenuePublic;
    }

    /**
     * Set id
     *
     * @param  integer $id
     * @return Event
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
     * Add meetupUser
     *
     * @param  \Db\Entity\MeetupMember $meetupUser
     * @return Event
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
     * Add meetupLink
     *
     * @param  \Db\Entity\MeetupLink $meetupLink
     * @return Event
     */
    public function addMeetupLink(\Db\Entity\MeetupLink $meetupLink)
    {
        $this->meetupLink[] = $meetupLink;

        return $this;
    }

    /**
     * Remove meetupLink
     *
     * @param \Db\Entity\MeetupLink $meetupLink
     */
    public function removeMeetupLink(\Db\Entity\MeetupLink $meetupLink)
    {
        $this->meetupLink->removeElement($meetupLink);
    }

    /**
     * Get meetupLink
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetupLink()
    {
        return $this->meetupLink;
    }

    /**
     * Add sponsorContribution
     *
     * @param  \Db\Entity\SponsorContribution $sponsorContribution
     * @return Event
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

    /**
     * Add presentationProposal
     *
     * @param  \Db\Entity\PresentationProposal $presentationProposal
     * @return Event
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
     * Add eventQuestion
     *
     * @param  \Db\Entity\EventQuestion $eventQuestion
     * @return Event
     */
    public function addEventQuestion(\Db\Entity\EventQuestion $eventQuestion)
    {
        $this->eventQuestion[] = $eventQuestion;

        return $this;
    }

    /**
     * Remove eventQuestion
     *
     * @param \Db\Entity\EventQuestion $eventQuestion
     */
    public function removeEventQuestion(\Db\Entity\EventQuestion $eventQuestion)
    {
        $this->eventQuestion->removeElement($eventQuestion);
    }

    /**
     * Get eventQuestion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventQuestion()
    {
        return $this->eventQuestion;
    }

    /**
     * Set venue
     *
     * @param  \Db\Entity\Venue $venue
     * @return Event
     */
    public function setVenue(\Db\Entity\Venue $venue = null)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return \Db\Entity\Venue
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set meetupGroup
     *
     * @param  \Db\Entity\MeetupGroup $meetupGroup
     * @return Event
     */
    public function setMeetupGroup(\Db\Entity\MeetupGroup $meetupGroup)
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
     * Add jointMeetupGroup
     *
     * @param  \Db\Entity\MeetupGroup $jointMeetupGroup
     * @return Event
     */
    public function addJointMeetupGroup(\Db\Entity\MeetupGroup $jointMeetupGroup)
    {
        $this->jointMeetupGroup[] = $jointMeetupGroup;

        return $this;
    }

    /**
     * Remove jointMeetupGroup
     *
     * @param \Db\Entity\MeetupGroup $jointMeetupGroup
     */
    public function removeJointMeetupGroup(\Db\Entity\MeetupGroup $jointMeetupGroup)
    {
        $this->jointMeetupGroup->removeElement($jointMeetupGroup);
    }

    /**
     * Get jointMeetupGroup
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJointMeetupGroup()
    {
        return $this->jointMeetupGroup;
    }

    /**
     * Add host
     *
     * @param  \Db\Entity\Member $host
     * @return Event
     */
    public function addHost(\Db\Entity\Member $host)
    {
        $this->host[] = $host;

        return $this;
    }

    /**
     * Remove host
     *
     * @param \Db\Entity\Member $host
     */
    public function removeHost(\Db\Entity\Member $host)
    {
        $this->host->removeElement($host);
    }

    /**
     * Get host
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHost()
    {
        return $this->host;
    }
    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $visibility;

    /**
     * @var integer
     */
    private $maybeRsvpCount;

    /**
     * @var integer
     */
    private $utcOffset;

    /**
     * @var integer
     */
    private $waitlistCount;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $yesRsvpCount;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $url;

    /**
     * @var integer
     */
    private $headcount;


    /**
     * Set status
     *
     * @param string $status
     * @return Event
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
     * Set visibility
     *
     * @param string $visibility
     * @return Event
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set maybeRsvpCount
     *
     * @param integer $maybeRsvpCount
     * @return Event
     */
    public function setMaybeRsvpCount($maybeRsvpCount)
    {
        $this->maybeRsvpCount = $maybeRsvpCount;

        return $this;
    }

    /**
     * Get maybeRsvpCount
     *
     * @return integer
     */
    public function getMaybeRsvpCount()
    {
        return $this->maybeRsvpCount;
    }

    /**
     * Set utcOffset
     *
     * @param integer $utcOffset
     * @return Event
     */
    public function setUtcOffset($utcOffset)
    {
        $this->utcOffset = $utcOffset;

        return $this;
    }

    /**
     * Get utcOffset
     *
     * @return integer
     */
    public function getUtcOffset()
    {
        return $this->utcOffset;
    }

    /**
     * Set waitlistCount
     *
     * @param integer $waitlistCount
     * @return Event
     */
    public function setWaitlistCount($waitlistCount)
    {
        $this->waitlistCount = $waitlistCount;

        return $this;
    }

    /**
     * Get waitlistCount
     *
     * @return integer
     */
    public function getWaitlistCount()
    {
        return $this->waitlistCount;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Event
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
     * Set yesRsvpCount
     *
     * @param integer $yesRsvpCount
     * @return Event
     */
    public function setYesRsvpCount($yesRsvpCount)
    {
        $this->yesRsvpCount = $yesRsvpCount;

        return $this;
    }

    /**
     * Get yesRsvpCount
     *
     * @return integer
     */
    public function getYesRsvpCount()
    {
        return $this->yesRsvpCount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Event
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
     * Set url
     *
     * @param string $url
     * @return Event
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
     * Set headcount
     *
     * @param integer $headcount
     * @return Event
     */
    public function setHeadcount($headcount)
    {
        $this->headcount = $headcount;

        return $this;
    }

    /**
     * Get headcount
     *
     * @return integer
     */
    public function getHeadcount()
    {
        return $this->headcount;
    }
}
