<?php

namespace Db\Entity;

use Zend\Stdlib\ArraySerializableInterface;
use DateTime;

/**
 * Venue
 */
class Venue implements ArraySerializableInterface
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
                case 'address_1':
                case 'address1':
                    $this->setAddress1($value);
                    break;
                case 'address_2':
                case 'address2':
                    $this->setAddress2($value);
                    break;
                case 'address_3':
                case 'address3':
                    $this->setAddress3($value);
                    break;
                case 'city':
                    $this->setCity($value);
                    break;
                case 'state':
                    $this->setState($value);
                    break;
                case 'zip':
                    $this->setZip($value);
                    break;
                case 'country':
                    $this->setCountry($value);
                    break;
                case 'phone':
                    $this->setPhone($value);
                    break;
                case 'capacity':
                    $this->setCapacity($value);
                    break;
                case 'description':
                    $this->setDescription($value);
                    break;
                case 'contact':
                    $this->setContact($value);
                    break;
                case 'security':
                    $this->setSecurity($value);
                    break;
                case 'equipment':
                    $this->setEquipment($value);
                    break;
                case 'latitude':
                    $this->setLatitude($value);
                    break;
                case 'longitude':
                    $this->setLongitude($value);
                    break;
                case 'repinned':
                    $this->setRepinned($value);
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
            'address1' => $this->getAddress1(),
            'address2' => $this->getAddress2(),
            'address3' => $this->getAddress3(),
            'city' => $this->getCity(),
            'state' => $this->getState(),
            'zip' => $this->getZip(),
            'country' => $this->getCountry(),
            'phone' => $this->getPhone(),
            'capacity' => $this->getCapacity(),
            'description' => $this->getDescription(),
            'contact' => $this->getContact(),
            'security' => $this->getSecurity(),
            'equipment' => $this->getEquipment(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'repinned' => $this->getRepinned(),
        ];
    }

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address1;

    /**
     * @var string
     */
    private $address2;

    /**
     * @var string
     */
    private $address3;

    /**
     * @var string
     */
    private $cityStateCountry;

    /**
     * @var string
     */
    private $latLon;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var integer
     */
    private $capacity;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var string
     */
    private $security;

    /**
     * @var string
     */
    private $equipment;

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
    private $venueQuestion;

    /**
     * @var \Db\Entity\Sponsor
     */
    private $sponsor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
        $this->venueQuestion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return Venue
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
     * Set address1
     *
     * @param  string $address1
     * @return Venue
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param  string $address2
     * @return Venue
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set address3
     *
     * @param  string $address3
     * @return Venue
     */
    public function setAddress3($address3)
    {
        $this->address3 = $address3;

        return $this;
    }

    /**
     * Get address3
     *
     * @return string
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * Set cityStateCountry
     *
     * @param  string $cityStateCountry
     * @return Venue
     */
    public function setCityStateCountry($cityStateCountry)
    {
        $this->cityStateCountry = $cityStateCountry;

        return $this;
    }

    /**
     * Get cityStateCountry
     *
     * @return string
     */
    public function getCityStateCountry()
    {
        return $this->cityStateCountry;
    }

    /**
     * Set latLon
     *
     * @param  string $latLon
     * @return Venue
     */
    public function setLatLon($latLon)
    {
        $this->latLon = $latLon;

        return $this;
    }

    /**
     * Get latLon
     *
     * @return string
     */
    public function getLatLon()
    {
        return $this->latLon;
    }

    /**
     * Set phone
     *
     * @param  string $phone
     * @return Venue
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set zip
     *
     * @param  string $zip
     * @return Venue
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set capacity
     *
     * @param  integer $capacity
     * @return Venue
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set description
     *
     * @param  string $description
     * @return Venue
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
     * Set contact
     *
     * @param  string $contact
     * @return Venue
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
     * Set security
     *
     * @param  string $security
     * @return Venue
     */
    public function setSecurity($security)
    {
        $this->security = $security;

        return $this;
    }

    /**
     * Get security
     *
     * @return string
     */
    public function getSecurity()
    {
        return $this->security;
    }

    /**
     * Set equipment
     *
     * @param  string $equipment
     * @return Venue
     */
    public function setEquipment($equipment)
    {
        $this->equipment = $equipment;

        return $this;
    }

    /**
     * Get equipment
     *
     * @return string
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * Set id
     *
     * @param  integer $id
     * @return Venue
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
     * @return Venue
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
     * Add venueQuestion
     *
     * @param  \Db\Entity\VenueQuestion $venueQuestion
     * @return Venue
     */
    public function addVenueQuestion(\Db\Entity\VenueQuestion $venueQuestion)
    {
        $this->venueQuestion[] = $venueQuestion;

        return $this;
    }

    /**
     * Remove venueQuestion
     *
     * @param \Db\Entity\VenueQuestion $venueQuestion
     */
    public function removeVenueQuestion(\Db\Entity\VenueQuestion $venueQuestion)
    {
        $this->venueQuestion->removeElement($venueQuestion);
    }

    /**
     * Get venueQuestion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVenueQuestion()
    {
        return $this->venueQuestion;
    }

    /**
     * Set sponsor
     *
     * @param  \Db\Entity\Sponsor $sponsor
     * @return Venue
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
     * @var string
     */
    private $city;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $country;

    /**
     * @var boolean
     */
    private $repinned;


    /**
     * Set city
     *
     * @param string $city
     * @return Venue
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
     * Set latitude
     *
     * @param float $latitude
     * @return Venue
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
     * @return Venue
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
     * Set state
     *
     * @param string $state
     * @return Venue
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
     * Set country
     *
     * @param string $country
     * @return Venue
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
     * Set repinned
     *
     * @param boolean $repinned
     * @return Venue
     */
    public function setRepinned($repinned)
    {
        $this->repinned = $repinned;

        return $this;
    }

    /**
     * Get repinned
     *
     * @return boolean
     */
    public function getRepinned()
    {
        return $this->repinned;
    }
}
