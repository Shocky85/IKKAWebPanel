<?php

namespace IKKA\Domain;

use IKKA\DAO\CategoryDAO;

class Badge {

    //Atributes
    private $id;
    private $idCategorie;
    private $title;
    private $description;
    private $imageUrl;
    private $parameters;
    private $class;
    private $status;
    private $remaining;

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
    function getIdCategorie() {
        return $this->idCategorie;
    }

    /**
     * 
     * @return string
     */
    function getTitle() {
        return $this->title;
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
     * @return string
     */
    function getImageUrl() {
        return $this->imageUrl;
    }

    /**
     * 
     * @return string
     */
    function getParameters() {
        return $this->parameters;
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
    function setIdCategorie($idCategorie) {
        $this->idCategorie = $idCategorie;
    }

    /**
     * 
     * @param type string
     */
    function setTitle($title) {
        $this->title = $title;
    }

    /**
     * 
     * @param type string
     */
    function setDescription($description) {
        $this->description = $description;
    }

    /**
     * 
     * @param type string
     */
    function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    /**
     * 
     * @param type string
     */
    function setParameters($parameters) {
        $this->parameters = $parameters;
    }

    /**
     * 
     * @return string
     */
    function getClass() {
        return $this->class;
    }

    /**
     * 
     * @param type int
     */
    function setClass($idCategory) {
        $categoryDao=new CategoryDAO();
        $category=$categoryDao->find($idCategory);
        $this->class = $category->getLabel();
    }
    
    /**
     * 
     * @return string
     */
    function getStatus() {
        return $this->status;
    }

    /**
     * 
     * @return int
     */
    function getRemaining() {
        return $this->remaining;
    }

    /**
     * 
     * @param type string
     */
    function setStatus($status) {
        $this->status = $status;
    }

    /**
     * 
     * @param type int
     */
    function setRemaining($remaining) {
        $this->remaining = $remaining;
    }




}
