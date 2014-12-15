<?php

namespace Db\Entity;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Stdlib\ArraySerializableInterface;

/**
 * SponsorContact
 */
class SponsorContact implements InputFilterAwareInterface, ArraySerializableInterface
{
    public function __toString()
    {
        return $this->getTitle();
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
            'meetupGroup' => $this->getMeetupGroup()->getId(),
        ];
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();
        $factory = new InputFactory();

        $inputFilter->add($factory->createInput([
            'name' => 'meetupGroup',
            'required' => true,
            'filters' => array(
                array('name' => 'Int'),
            ),
        ]));

        $inputFilter->add($factory->createInput([
            'name' => 'title',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        ]));

        $inputFilter->add($factory->createInput([
            'name' => 'description',
            'required' => false,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
        ]));

        return $inputFilter;
    }

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Db\Entity\Sponsor
     */
    private $sponsor;

    /**
     * @var \Db\Entity\Member
     */
    private $member;

    /**
     * Set title
     *
     * @param  string         $title
     * @return SponsorContact
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
     * @param  string         $description
     * @return SponsorContact
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
     * @param  \Db\Entity\Sponsor $sponsor
     * @return SponsorContact
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
     * Set member
     *
     * @param  \Db\Entity\Member $member
     * @return SponsorContact
     */
    public function setMember(\Db\Entity\Member $member)
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
     * @var \Db\Entity\MeetupGroup
     */
    private $meetupGroup;


    /**
     * Set meetupGroup
     *
     * @param \Db\Entity\MeetupGroup $meetupGroup
     * @return SponsorContact
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
}
