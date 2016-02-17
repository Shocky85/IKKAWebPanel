<?php

namespace IKKA\DAO;

require_once '/../fct/functions.php';

/**
 * Data Access Object for the Connection type
 * This class is not really a DAO because i don't stock connection infos in a custom Object
 * but in Silex Session Variable
 */
class ConnectionDAO {

    //methode called when the validation on the route "/login"
    // : POST
    public function login($app) {
        //find the POST variables and construct a JSON
        $connectionData = json_encode(array(
            'username' => $_POST['connection']['username'],
            'password' => $_POST['connection']['password'],
        ));
        //try to send Request with Data to User's WebService
        $resultConnection = requestWS(WSIKKAUSER, "/connect/web", "POST", $connectionData);
        //decode the response
        $infoConnection = json_decode($resultConnection, true);
        if (isset($infoConnection['uuid']) && isset($infoConnection['pseudo']) && isset($infoConnection['token'])) {
            //save details response in session provider silex
            $app['session']->set('uuid', $infoConnection['uuid']);
            $app['session']->set('token', $infoConnection['token']);
            $app['session']->set('pseudo', $infoConnection['pseudo']);
            //build new Object User

            $profil = new \IKKA\DAO\UserDAO();
            $profilFind = $profil->find($infoConnection['uuid'],$app);
            $app['session']->set('idRole', $profilFind->getIdRole());
            $app['session']->set('idAccount', $profilFind->getIdAccount());
            //return session infos

            return $app['session'];
        } else {
            return null;
        }
    }

    //methode called on the route "/logout"
    public function logout($app) {
        //clean all custom infos in session provider silex
        $app['session']->clear();
    }

}
