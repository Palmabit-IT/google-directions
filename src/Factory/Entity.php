<?php

namespace Palmabit\GoogleDirections\Factory;

// use GuzzleHttp\Message\Response;
use GuzzleHttp\Psr7\Response;
use Palmabit\GoogleDirections\Exceptions\GoogleDirectionsException;
use Palmabit\GoogleDirections\Interfaces\EntityFactory;

class Entity implements EntityFactory
{
    protected $apiEntities = [
        'directions' => '\Palmabit\GoogleDirections\Entity\Directions',
    ];

    /**
     * Creates an appropriate Entity from a given Response
     *
     * @param Response $response
     * @return \almabit\GoogleDirections\Abstracts\Entity
     */
    public function createAppropriate(Response $response)
    {
        $class = $this->apiEntities['directions'];
        return new $class($response);
    }

}
