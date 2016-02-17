<?php

namespace IKKA\DAO;

use IKKA\Domain\Role;

/**
 * Data Access Object for the Role type
 */
class RoleDAO extends DAO {

    //method to build a Role Object
    protected function buildDomainObject($row) {
        //set attributes of the Object
        $role = new Role();
        $role->setId($row['role_id']);
        $role->setLabel($row['label']);
        //return the final Object
        return $role;
    }

    //method to request all roles on the WeService
    // : GET
    public function findAll() {
        $url = '' . WSIKKAUSER . '/users/roles';
        $result = getDataFromJSON($url);
        $roles = array();
        //if result
        if ($result != null) {
            foreach ($result as $row) {
                $roleId = $row['role_id'];
                $roles[$roleId] = $this->buildDomainObject($row);
            }
        }
        return $roles;
    }

    //find a specific role
    // : GET
    public function find($id) {
        $url = '' . WSIKKAUSER . '/roles/' . $id . '';
        $role = getDataFromJSON($url);
        //if result
        if ($role) {
            return $this->buildDomainObject($role);
        } else {
            throw new \Exception("No role matching id " . $id);
        }
    }

}
