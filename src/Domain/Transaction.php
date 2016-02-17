<?php

namespace IKKA\Domain;

class Transaction {

    //Atributes
    private $id;
    private $idCreditor;
    private $idDebitor;
    private $amount;
    private $description;

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
    function getIdCreditor() {
        return $this->idCreditor;
    }

    /**
     * 
     * @return int
     */
    function getIdDebitor() {
        return $this->idDebitor;
    }

    /**
     * 
     * @return int
     */
    function getAmount() {
        return $this->amount;
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
    function setIdCreditor($idCreditor) {
        $this->idCreditor = $idCreditor;
    }

    /**
     * 
     * @param type int
     */
    function setIdDebitor($idDebitor) {
        $this->idDebitor = $idDebitor;
    }

    /**
     * 
     * @param type int
     */
    function setAmount($amount) {
        $this->amount = $amount;
    }

    /**
     * 
     * @param type string
     */
    function setDescription($description) {
        $this->description = $description;
    }

}
