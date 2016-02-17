<?php

namespace IKKA\DAO;

use IKKA\Domain\User;

/**
 * Data Access Object for the User type
 */
class UserDAO extends DAO {

//method to build a User Object
    protected function buildDomainObject($row) {
//set attributes of the Object
        $user = new User();
        $user->setUuid($row['uuid']);
        $user->setIdAccount($row['account_id']);
        $user->setIdRole($row['role_id']);
        $user->setPseudo($row['pseudo']);
        $user->setFlagConnection($row['flag_connection']);
        $user->setAvatar($row['pseudo']);
//return the final Object
        return $user;
    }

    /* METHOD WITHOUT BASIC AUTH
      public function findAll($app) {

      $url = '' . WSIKKAUSER . '/users';
      $result = getDataFromJSON($url);
      $users = array();
      if ($result != null) {
      foreach ($result as $row) {
      $userUuid = $row['uuid'];
      $users[$userUuid] = $this->buildDomainObject($row);
      }
      }
      return $users;
      }
     */

    //method to request all accounts on the WeService
    //  ****   METHOD WITH BASIC AUTH  !IMPORTANT
    // : GET
    public function findAll($app) {
        //call WebService With Basic Auth
        $result = requestWSAuthGet(WSIKKAUSER, "/users", $app);
        $users = array();
        //id result build Objects
        if ($result != null) {
            foreach ($result as $row) {
                $userUuid = $row['uuid'];
                $users[$userUuid] = $this->buildDomainObject($row);
            }
        }
        return $users;
    }

    //find a specific User
    // : GET
    public function find($uuid, $app) {
        //$url = '' . WSIKKAUSER . '/users/' . $uuid . '';
        //$user = getDataFromJSON($url);
        $user = requestWSAuthGet(WSIKKAUSER, "/users/" . $uuid, $app);
        var_dump($user);
        //if result
        if ($user) {
            return $this->buildDomainObject($user);
        } else {
            throw new \Exception("No user matching id " . $uuid);
        }
    }

    //Method called when validation of User Form
    // : POST
    public function create() {
        //Encode data to JSON WITH POST Variable
        $userData = json_encode(array(
            'pseudo' => $_POST['user']['pseudo'],
            'uuid' => $_POST['user']['uuid'],
            'role_id' => (int) $_POST['user']['idRole'],
            'account_description' => $_POST['user']['account_description'],
            'account_balance' => $_POST['user']['account_balance'],
        ));
        requestWS(WSIKKAUSER, "/users", "POST", $userData);
    }

    //Method to Delete a specific User with a DELETE Header HTTP
    // : DELETE
    public function delete($uuid) {

        try {
            $url = '' . WSIKKAUSER . '/users/' . $uuid . '';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            $output = curl_exec($ch);
            echo($output) . PHP_EOL;
        } catch (Exception $ex) {
            echo "Exception catched";
        }
    }

}
