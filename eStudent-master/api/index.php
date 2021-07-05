<?php
require 'flight/Flight.php';
require '../inicijalizacija.php';

Flight::register('db', 'Broker', array(''));

Flight::route('/', function(){
    echo "cao braco";
});

Flight::route('GET /prijaveNI', function(){
    header("Content-Type: application/json; charset=utf-8");
    /** @var Broker $db */
	$db = Flight::db();
    $rezultati = $db->vratiPrijaveNi();
    echo json_encode($rezultati);
});

Flight::route('GET /korisnici', function(){
    header("Content-Type: application/json; charset=utf-8");
    /** @var Broker $db */
    $db = Flight::db();
    $rezultati = $db->vratiKorisnike();
    echo json_encode($rezultati);
});

Flight::route('GET /grafik', function(){
    header("Content-Type: application/json; charset=utf-8");
    /** @var Broker $db */
    $db = Flight::db();
    $rezultati = $db->vratiPodatkeZaGrafik();
    echo json_encode($rezultati);
});

Flight::route('POST /unesiKorisnika', function()
{
    header("Content-Type: application/json; charset=utf-8");
    /** @var Broker $db */
    $db = Flight::db();
    $podaci = file_get_contents('php://input');
    $niz = json_decode($podaci,true);
    $rez = $db->unesiKorisnika($niz);
    if($rez)
    {
        $response = "OK!";
    }
    else
    {
        $response = "NOK!";

    }

    echo json_encode($response);

});

Flight::start();
