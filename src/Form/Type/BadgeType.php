<?php

namespace IKKA\Form\Type;

use IKKA\DAO\CategoryDAO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BadgeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        //Find all Categories
        $categoryChoices = array();
        $categoryDao = new CategoryDAO();
        $categories = $categoryDao->findAll();
        //build a array K/V for select input
        if ($categories != null) {
            foreach ($categories as $row) {
                $categoryChoices[$row->id] = $row->label;
            }
        }
        //add inputs
        $builder->add('title', 'text');
        $builder->add('description', 'text');
        //build options with the array choices
        $builder->add('category', 'choice', array(
            'label' => 'Categories',
            'choices' => $categoryChoices
        ));
        $builder->add('parameters', 'text');
        $builder->add('image_url', 'text');
    }

    //find the form
    public function getName() {
        return 'badge';
    }

}
