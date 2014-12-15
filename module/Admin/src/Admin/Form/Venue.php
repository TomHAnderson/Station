<?php
namespace Admin\Form;

use Zend\Form\Form;

class Venue extends Form
{
    public function init()
    {
        // we want to ignore the name passed
        parent::__construct('sponsor');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'capacity',
            'type'  => 'number',
            'attributes' => array(
                'placeholder' => '',
                'required' => false,
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Capacity',
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'type'  => 'textarea',
            'attributes' => array(
                'placeholder' => 'description',
                'required' => false,
                'class' => 'form-control',
                'rows' => 5,
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));
        $this->add(array(
            'name' => 'contact',
            'type'  => 'textarea',
            'attributes' => array(
                'placeholder' => 'contact',
                'required' => false,
                'class' => 'form-control',
                'rows' => 5,
            ),
            'options' => array(
                'label' => 'Contact',
            ),
        ));
        $this->add(array(
            'name' => 'security',
            'type'  => 'textarea',
            'attributes' => array(
                'placeholder' => 'security',
                'required' => false,
                'class' => 'form-control',
                'rows' => 5,
            ),
            'options' => array(
                'label' => 'Security',
            ),
        ));
        $this->add(array(
            'name' => 'equipment',
            'type'  => 'textarea',
            'attributes' => array(
                'placeholder' => 'equipment',
                'required' => false,
                'class' => 'form-control',
                'rows' => 5,
            ),
            'options' => array(
                'label' => 'Equipment',
            ),
        ));

        $this->add(array(
            'name' => 'sponsor',
            'type' => 'SponsorSelect',
            'attributes' => array(
                'placeholder' => 'sponsor',
                'required' => false,
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Sponsor',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }
}