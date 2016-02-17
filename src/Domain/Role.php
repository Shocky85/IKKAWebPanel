<?php

namespace IKKA\Domain;

class Role {
    
    //Atributes
    public $id;
    public $label;
    
    
    //Getters and Setters
   
    /**
     * 
     * @return int
     */
    function getId() {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    function getLabel() {
        return $this->label;
    }

    /**
     * 
     * @param type int
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     * @param type string
     */
    function setLabel($label) {
        $this->label = $label;
    }
    
}
