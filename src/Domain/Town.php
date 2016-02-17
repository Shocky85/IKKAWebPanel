<?php

namespace IKKA\Domain;

class Town {
    
    //Atributes
    private $id;
    private $idAccount;
    private $name;
    
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
     * @return int
     */
    function getIdAccount() {
        return $this->idAccount;
    }

    /**
     * 
     * @return string
     */
    function getName() {
        return $this->name;
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
     * @param type int
     */
    function setIdAccount($idAccount) {
        $this->idAccount = $idAccount;
    }

    /**
     * 
     * @param type string
     */
    function setName($name) {
        $this->name = $name;
    }



}
