<?php

namespace IKKA\Domain;

class Category {

    //Atributes
    public $id;
    public $label;
    
    //Getters and Setters

    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * 
     * @param type int
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     * @param type string
     */
    public function setLabel($label) {
        $this->label = $label;
    }



}

