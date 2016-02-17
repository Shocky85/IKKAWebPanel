<?php

namespace IKKA\DAO;

require_once '/../fct/functions.php';


//abstract class with one method
abstract class DAO {

    //method to build Final Object
    protected abstract function buildDomainObject($row);
}
