<?php

namespace IKKA\Form\Type;

use IKKA\DAO\RoleDAO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        //find all roles
        $roleChoices = array();
        $roleDao = new RoleDAO();
        $roles = $roleDao->findAll();
        //if reuslt build a array K/V for select input
        if ($roles != null) {
            foreach ($roles as $row) {
                $roleChoices[$row->id] = $row->label;
            }
        }
        //add inputs
        $builder->add('pseudo', 'text');
        $builder->add('uuid', 'text');
        $builder->add('idRole', 'choice', array(
            'label' => 'Roles',
            'choices' => $roleChoices
        ));
        $builder->add('account_description', 'text');
        $builder->add('account_balance', 'number');
    }

    //find the form
    public function getName() {
        return 'user';
    }

}
