<?php

namespace IKKA\Domain;

class Account {

    //Atributes
    public $id;
    public $accountBalance;
    public $description;

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
    function getAccountBalance() {
        return $this->accountBalance;
    }

    /**
     * 
     * @return string
     */
    function getDescription() {
        return $this->description;
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
    function setAccountBalance($accountBalance) {
        $this->accountBalance = $accountBalance;
    }

    /**
     * 
     * @param type string
     */
    function setDescription($description) {
        $this->description = $description;
    }

}
