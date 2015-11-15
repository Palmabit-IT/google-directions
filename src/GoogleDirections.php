<?php

namespace Palmabit\GoogleDirections;

use Palmabit\GoogleDirections\Exceptions\GoogleDirectionsException;
use Palmabit\GoogleDirections\Api\Directions;
use Palmabit\GoogleDirections\Factory\Entity;
use Palmabit\GoogleDirections\Interfaces\Api;
use Palmabit\GoogleDirections\Interfaces\EntityFactory;
use GuzzleHttp\Client;


/**
 * Class GoogleDirections.
 *
 * see https://developers.google.com/maps/documentation/directions/intro for a Google directions API intro
 */
class GoogleDirections
{
    /** @var Client The HTTP clients to perform requests with */
    protected $client;

    /** @var  EntityFactory The Factory which created Entities from Responses */
    protected $factory;

    /** @var string The google apikey */
    private static $apikey = null;

    /** @var string The instance $apikey, settable once per new instance */
    private $instanceApikey;

    /**
     * @param string|null $apikey The google API apikey, as obtained on https://developers.google.com/maps/documentation/directions/get-api-key
     *
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
     * Sets the apikey for all future new instances.
     *
     * @param $apikey string The google API apikey, as obtained on https://developers.google.com/maps/documentation/directions/get-api-key
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
            throw new \InvalidArgumentException('Apikey "'.$apikey.'" is too short, and thus invalid.');
        }

        return true;
    }

    /**
     * Returns the apikey that has been defined.
     *
     * @return null|string
     */
    public function getApikey()
    {
        return ($this->instanceApikey) ? $this->instanceApikey : self::$apikey;
    }

    /**
     * Creates a Directions API interface.
     *
     * @return Direction
     */
    public function createDirectionApi()
    {
        // return new Directions($this->getApikey());
        $api = new Directions($this->getApikey());
        if (!$this->getHttpClient()) {
            $this->setHttpClient();
        }
        if (!$this->getEntityFactory()) {
            $this->setEntityFactory();
        }
        return $api->registerGoogleDirection($this);
    }

    /**
     * Sets the Entity Factory which will create the Entities from Responses.
     *
     * @param EntityFactory $factory
     *
     * @return $this
     */
    public function setEntityFactory(EntityFactory $factory = null)
    {
        if ($factory === null) {
            $factory = new Entity();
        }
        $this->factory = $factory;

        return $this;
    }

    /**
     * Returns the Factory responsible for creating Entities from Responses.
     *
     * @return EntityFactory
     */
    public function getEntityFactory()
    {
        return $this->factory;
    }

    /**
     * Sets the client to be used for querying the API endpoints.
     *
     * @param Client $client
     *
     * @return $this
     */
    public function setHttpClient(Client $client = null)
    {
        if ($client === null) {
            $client = new Client();
        }
        $this->client = $client;

        return $this;
    }

    /**
     * Returns either the instance of the Guzzle client that has been defined, or null.
     *
     * @return Client|null
     */
    public function getHttpClient()
    {
        return $this->client;
    }

}
