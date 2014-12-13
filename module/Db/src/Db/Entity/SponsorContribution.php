<?php

namespace Db\Entity;

/**
 * SponsorContribution
 */
class SponsorContribution
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $receivedWhat;

    /**
     * @var string
     */
    private $receivedWhy;

    /**
     * @var string
     */
    private $receivedHow;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Db\Entity\Sponsor
     */
    private $sponsor;

    /**
     * @var \Db\Entity\Event
     */
    private $event;

    /**
     * Set createdAt
     *
     * @param  \DateTime           $createdAt
     * @return SponsorContribution
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
     * Set title
     *
     * @param  string              $title
     * @return SponsorContribution
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
     * Set description
     *
     * @param  string              $description
     * @return SponsorContribution
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
     * Set receivedWhat
     *
     * @param  string              $receivedWhat
     * @return SponsorContribution
     */
    public function setReceivedWhat($receivedWhat)
    {
        $this->receivedWhat = $receivedWhat;

        return $this;
    }

    /**
     * Get receivedWhat
     *
     * @return string
     */
    public function getReceivedWhat()
    {
        return $this->receivedWhat;
    }

    /**
     * Set receivedWhy
     *
     * @param  string              $receivedWhy
     * @return SponsorContribution
     */
    public function setReceivedWhy($receivedWhy)
    {
        $this->receivedWhy = $receivedWhy;

        return $this;
    }

    /**
     * Get receivedWhy
     *
     * @return string
     */
    public function getReceivedWhy()
    {
        return $this->receivedWhy;
    }

    /**
     * Set receivedHow
     *
     * @param  string              $receivedHow
     * @return SponsorContribution
     */
    public function setReceivedHow($receivedHow)
    {
        $this->receivedHow = $receivedHow;

        return $this;
    }

    /**
     * Get receivedHow
     *
     * @return string
     */
    public function getReceivedHow()
    {
        return $this->receivedHow;
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
     * Set sponsor
     *
     * @param  \Db\Entity\Sponsor  $sponsor
     * @return SponsorContribution
     */
    public function setSponsor(\Db\Entity\Sponsor $sponsor)
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    /**
     * Get sponsor
     *
     * @return \Db\Entity\Sponsor
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }

    /**
     * Set event
     *
     * @param  \Db\Entity\Event    $event
     * @return SponsorContribution
     */
    public function setEvent(\Db\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Db\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }
    /**
     * @var \Db\Entity\MeetupGroup
     */
    private $meetupGroup;


    /**
     * Set meetupGroup
     *
     * @param \Db\Entity\MeetupGroup $meetupGroup
     * @return SponsorContribution
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
}
