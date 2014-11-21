<?php

namespace Db\Entity;


/**
 * Sponsor
 */
class Sponsor
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $url;

    /**
     * @var boolean
     */
    private $isSiteListed;

    /**
     * @var string
     */
    private $logoUrl;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sponsorContact;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sponsorLink;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sponsorContribution;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $venue;

    /**
     * @var \Db\Entity\MeetupGroup
     */
    private $meetupGroup;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sponsorContact = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sponsorLink = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sponsorContribution = new \Doctrine\Common\Collections\ArrayCollection();
        $this->venue = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param  string  $name
     * @return Sponsor
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
     * Set description
     *
     * @param  string  $description
     * @return Sponsor
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
     * Set url
     *
     * @param  string  $url
     * @return Sponsor
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
     * Set isSiteListed
     *
     * @param  boolean $isSiteListed
     * @return Sponsor
     */
    public function setIsSiteListed($isSiteListed)
    {
        $this->isSiteListed = $isSiteListed;

        return $this;
    }

    /**
     * Get isSiteListed
     *
     * @return boolean
     */
    public function getIsSiteListed()
    {
        return $this->isSiteListed;
    }

    /**
     * Set logoUrl
     *
     * @param  string  $logoUrl
     * @return Sponsor
     */
    public function setLogoUrl($logoUrl)
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    /**
     * Get logoUrl
     *
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * Set contact
     *
     * @param  string  $contact
     * @return Sponsor
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
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
     * Add sponsorContact
     *
     * @param  \Db\Entity\SponsorContact $sponsorContact
     * @return Sponsor
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
     * Add sponsorLink
     *
     * @param  \Db\Entity\SponsorLink $sponsorLink
     * @return Sponsor
     */
    public function addSponsorLink(\Db\Entity\SponsorLink $sponsorLink)
    {
        $this->sponsorLink[] = $sponsorLink;

        return $this;
    }

    /**
     * Remove sponsorLink
     *
     * @param \Db\Entity\SponsorLink $sponsorLink
     */
    public function removeSponsorLink(\Db\Entity\SponsorLink $sponsorLink)
    {
        $this->sponsorLink->removeElement($sponsorLink);
    }

    /**
     * Get sponsorLink
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSponsorLink()
    {
        return $this->sponsorLink;
    }

    /**
     * Add sponsorContribution
     *
     * @param  \Db\Entity\SponsorContribution $sponsorContribution
     * @return Sponsor
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
     * Add venue
     *
     * @param  \Db\Entity\Venue $venue
     * @return Sponsor
     */
    public function addVenue(\Db\Entity\Venue $venue)
    {
        $this->venue[] = $venue;

        return $this;
    }

    /**
     * Remove venue
     *
     * @param \Db\Entity\Venue $venue
     */
    public function removeVenue(\Db\Entity\Venue $venue)
    {
        $this->venue->removeElement($venue);
    }

    /**
     * Get venue
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set meetupGroup
     *
     * @param  \Db\Entity\MeetupGroup $meetupGroup
     * @return Sponsor
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
