<?php

namespace Db\Entity;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Stdlib\ArraySerializableInterface;
use DateTime;

/**
 * VenueQuestion
 */
class VenueQuestion implements InputFilterAwareInterface, ArraySerializableInterface
{
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();
        $factory = new InputFactory();

        $inputFilter->add($factory->createInput(array(
            'name'     => 'body',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
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
        )));

        return $inputFilter;
    }

    public function __toString()
    {
        return $this->getBody();
    }

    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'body':
                    $this->setBody($value);
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
            'body' => $this->getBody(),
        ];
   }


    /**
     * @var string
     */
    private $body;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Db\Entity\Venue
     */
    private $venue;

    /**
     * Set body
     *
     * @param  string        $body
     * @return VenueQuestion
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
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
     * Set venue
     *
     * @param  \Db\Entity\Venue $venue
     * @return VenueQuestion
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
}
