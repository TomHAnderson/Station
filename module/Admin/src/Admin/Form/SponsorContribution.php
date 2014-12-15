<?php
namespace Admin\Form;

use Zend\Form\Form;

class SponsorContribution extends Form
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
            'name' => 'receivedWhat',
            'attributes' => array(
                'type'  => 'textarea',
                'placeholder' => 'received what',
                'required' => false,
                'class' => 'form-control',
                'rows' => 5,
            ),
            'options' => array(
                'label' => 'Received What',
            ),
        ));

        $this->add(array(
            'name' => 'receivedWhy',
            'attributes' => array(
                'type'  => 'textarea',
                'placeholder' => 'received why',
                'required' => false,
                'class' => 'form-control',
                'rows' => 5,
            ),
            'options' => array(
                'label' => 'Received Why',
            ),
        ));

        $this->add(array(
            'name' => 'receivedHow',
            'attributes' => array(
                'type'  => 'textarea',
                'placeholder' => 'received how',
                'required' => false,
                'class' => 'form-control',
                'rows' => 5,
            ),
            'options' => array(
                'label' => 'Received How',
            ),
        ));

        $this->add(array(
            'name' => 'sponsor',
            'type' => 'SponsorSelect',
            'attributes' => array(
                'placeholder' => 'sponsor',
                'required' => 'required',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Sponsor',
            ),
        ));

        $this->add(array(
            'name' => 'event',
            'type' => 'select',
            'attributes' => array(
                'placeholder' => 'event',
                'required' => false,
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Event',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }
}