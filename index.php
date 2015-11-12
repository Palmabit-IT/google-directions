<?php

require_once 'vendor/autoload.php';
use Palmabit\GoogleDirections\GoogleDirections;

$apikey = 'AIzaSyA0GNsG_hworSvGruSX-J2iK38pFvcIIgM';

// approach 1
$api1 = new GoogleDirections($apikey);
$api2 = new GoogleDirections($apikey);

// approach 2
GoogleDirections::setApikey($apikey);
$api1 = new GoogleDirections();
$api2 = new GoogleDirections();


//origin=Milano&destination=Brescia
$response = $api2
    ->createDirectionAPI()
    ->setTimeout(4000)
    ->setOrigin('Milano')
    ->setDestination('Verona')
    ->call();

print_r ($response);
