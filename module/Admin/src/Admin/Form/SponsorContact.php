<?php
namespace Admin\Form;

use Zend\Form\Form;

class SponsorContact extends Form
{
    public function init()
    {
        // we want to ignore the name passed
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'sponsor contact title',
                'required' => 'required',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'textarea',
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
            'name' => 'meetupGroup',
            'type' => 'MeetupGroupSelect',
            'attributes' => array(
                'placeholder' => 'meetup group',
                'required' => 'required',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Meetup Group',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }
}