<?php

namespace IKKA\Domain;

class User {

    //Atributes
    private $uuid;
    private $idAccount;
    private $idTown;
    private $idRole;
    private $pseudo;
    private $token;
    private $flagConnection;
    private $avatar;
    private $password;
    private $username;
    private $salt;
    private $role;

    //Getters and Setters

    /**
     * 
     * @return string (UUID)
     */
    function getUuid() {
        return $this->uuid;
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
     * @return int
     */
    function getIdTown() {
        return $this->idTown;
    }

    /**
     * 
     * @return int
     */
    function getIdRole() {
        return $this->idRole;
    }

    /**
     * 
     * @return string
     */
    function getPseudo() {
        return $this->pseudo;
    }

    /**
     * 
     * @return string
     */
    function getToken() {
        return $this->token;
    }

    /**
     * 
     * @return int
     */
    function getFlagConnection() {
        return $this->flagConnection;
    }

    /**
     * 
     * @param type string (UUID)
     */
    function setUuid($uuid) {
        $this->uuid = $uuid;
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
     * @param type id
     */
    function setIdTown($idTown) {
        $this->idTown = $idTown;
    }

    /**
     * 
     * @param type id
     */
    function setIdRole($idRole) {
        $this->idRole = $idRole;
    }

    /**
     * 
     * @param type string
     */
    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    /**
     * 
     * @param type string
     */
    function setToken($token) {
        $this->token = $token;
    }

    /**
     * 
     * @param type int
     */
    function setFlagConnection($flagConnection) {
        $this->flagConnection = $flagConnection;
    }

    /**
     * 
     * @return string
     */
    function getAvatar() {
        return $this->avatar;
    }

    /**
     * 
     * @return int
     */
    function getStateConnect() {
        return $this->stateConnect;
    }

    /**
     * 
     * @param type string
     */
    function setAvatar($pseudo) {
        $avatar = "https://minotar.net/body/$pseudo";
        $this->avatar = $avatar;
    }

}
