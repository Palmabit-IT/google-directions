<?php

namespace Palmabit\GoogleDirections;

use Palmabit\GoogleDirections\Exceptions\GoogleDirectionsException;
//use Palmabit\GoogleDirections\Entity\Directions;
use Palmabit\GoogleDirections\Api\Directions;

/**
 * Class GoogleDirections
 *
 * see https://developers.google.com/maps/documentation/directions/intro for a Google directions API intro
 *
 * @package Palmabit\GoogleDirections
 */
class GoogleDirections
{

    /** @var Client The HTTP clients to perform requests with */
    protected $client;

    /** @var string The google apikey */
    private static $apikey = null;

    /** @var string The instance $apikey, settable once per new instance */
    private $instanceApikey;

    private $factory;

    /**
     * @param string|null $apikey The google API apikey, as obtained on https://developers.google.com/maps/documentation/directions/get-api-key
     * @throws GoogleDirectionsException When no token is provided
     */
    public function __construct($apikey = null)
    {
        if ($apikey === null) {
            if (self::$apikey === null) {
                $msg = 'No apikey provided, and none is globally set. ';
                $msg .= 'Use GoogleDirections::setApikey, or instantiate the GoogleDirections class with a $apikey parameter.';
                throw new GoogleDirectionsException($msg);
            }
        } else {
            self::validateApikey($apikey);
            $this->instanceApikey = $apikey;
        }
    }

    /**
     * Sets the apikey for all future new instances
     * @param $apikey string The google API apikey, as obtained on https://developers.google.com/maps/documentation/directions/get-api-key
     * @return void
     */
    public static function setApikey($apikey)
    {
        self::validateApikey($apikey);
        self::$apikey = $apikey;
    }

    private static function validateApikey($apikey)
    {
        if (!is_string($apikey)) {
            throw new \InvalidArgumentException('apikey is not a string.');
        }
        if (strlen($apikey) < 4) {
            throw new \InvalidArgumentException('Apikey "' . $apikey . '" is too short, and thus invalid.');
        }
        return true;
    }


    /**
     * Returns the apikey that has been defined.
     * @return null|string
     */
    public function getApikey()
    {
        return ($this->instanceApikey) ? $this->instanceApikey : self::$apikey;
    }

    /**
     * Creates a Directions API interface
     *
     * @return Direction
     */
    public function createDirectionApi()
    {
        return new Directions($this->getApikey());
    }

}
