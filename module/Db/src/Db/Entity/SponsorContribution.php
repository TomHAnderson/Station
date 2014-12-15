<?php

namespace Db\Entity;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Stdlib\ArraySerializableInterface;
use DateTime;

/**
 * SponsorContribution
 */
class SponsorContribution implements InputFilterAwareInterface, ArraySerializableInterface
{
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();
        $factory = new InputFactory();

        $inputFilter->add($factory->createInput([
            'name' => 'title',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
        ]));

        $inputFilter->add($factory->createInput([
            'name' => 'description',
            'required' => false,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
        ]));

        $inputFilter->add($factory->createInput([
            'name' => 'receivedWhat',
            'required' => false,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
        ]));

        $inputFilter->add($factory->createInput([
            'name' => 'receivedWhy',
            'required' => false,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
        ]));

        $inputFilter->add($factory->createInput([
            'name' => 'receivedHow',
            'required' => false,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
        ]));

        return $inputFilter;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'title':
                    $this->setTitle($value);
                    break;
                case 'description':
                    $this->setDescription($value);
                    break;
                case 'receivedWhat':
                    $this->setReceivedWhat($value);
                    break;
                case 'receivedWhy':
                    $this->setReceivedWhy($value);
                    break;
                case 'receivedHow':
                    $this->setReceivedHow($value);
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
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'createdAt' => $this->getCreatedAt(),
            'receivedWhat' => $this->getReceivedWhat(),
            'receivedWhy' => $this->getReceivedWhy(),
            'receivedHow' => $this->getReceivedHow(),
            'event' => ($this->getEvent()) ? $this->getEvent()->getId(): null,
            'sponsor' => $this->getSponsor()->getId(),
            'meetupGroup' => $this->getMeetupGroup()->getId(),
        ];
    }

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
