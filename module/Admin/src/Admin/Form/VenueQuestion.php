<?php
namespace Admin\Form;

use Zend\Form\Form;

class VenueQuestion extends Form
{
    public function init()
    {
        // we want to ignore the name passed
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'body',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'venue question',
                'required' => 'required',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Question',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }
}