<?php
namespace Palmabit\GoogleDirections\Api;
use GuzzleHttp\Client;
use Palmabit\GoogleDirections\Abstracts\Api;

class Directions extends Api
{
    /** @var string API URL to which to send the request */
    protected $apiUrl = 'https://maps.googleapis.com/maps/api/directions/json';

    protected static $optionalFields = [
        'origin',
        'destination'
    ];

    public static function getOptionalFields()
    {
        return self::$optionalFields;
    }

}
