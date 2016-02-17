<?php

namespace IKKA\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ConnectionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        //add inputs
        $builder->add('username', 'text');
        $builder->add('password', 'password');
    }

    //find the form
    public function getName() {
        return 'connection';
    }

}
