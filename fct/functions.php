<?php

//Somes utils functions
//standart request & decode JSON
function getDataFromJSON($url) {
    //standart request & decode JSON
    $content = file_get_contents($url);
    $result = json_decode($content, true);
    return $result;
}

//request with custom way & method 
function requestWS($serviceport, $chemin, $methode, $data) {
    try {
        $result = file_get_contents('' . $serviceport . '' . $chemin . '', null, stream_context_create(array(
            'http' => array(
                'method' => $methode,
                'header' => 'Content-Type: application/json' . "\r\n" . 'Content-Length: ' . strlen($data) . "\r\n",
                'content' => $data
            )
                        )
        ));
        return $result;
    } catch (Exception $ex) {
        echo "Exception catched";
    }
}

//request with custom way & method and Basic Auth 
//for the Basic Auth we user variables session, uuid+token
//@TODO : replace all standart request to Basic Auth
function requestWSAuthGet($serviceport, $way, $app) {
    try {
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode($app['session']->get('uuid') . ":" . $app['session']->get('token')),
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents($serviceport . $way, false, $context);
        $result = json_decode($file, true);
        return $result;
    } catch (Exception $ex) {
        echo "Exception catched";
    }
}

//request with custom way & method and Basic Auth 
//for the Basic Auth we user variables session, uuid+token
//@TODO : replace all standart request to Basic Auth
function requestWSAuthOther($serviceport, $chemin, $methode, $app) {
    try {
        $opts = array(
            'http' => array(
                'method' => $methode,
                'header' => "Authorization: Basic " . base64_encode($app['session']->get('uuid') . ":" . $app['session']->get('token')),
                'content'=> $data
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents($serviceport . $chemin, false, $context);
        $result = json_decode($file, true);
        return $result;
    } catch (Exception $ex) {
        echo "Exception catched";
    }
}
