<?php
namespace Admin\Form;

use Zend\Form\Form;

class Sponsor extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('sponsor');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'sponsor name',
                'required' => 'required',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));
        $this->add(array(
            'name' => 'url',
            'attributes' => array(
                'type'  => 'url',
                'placeholder' => '',
                'required' => false,
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'URL',
            ),
        ));
        $this->add(array(
            'name' => 'logoUrl',
            'attributes' => array(
                'type'  => 'url',
                'placeholder' => '',
                'required' => false,
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Logo URL',
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
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }
}