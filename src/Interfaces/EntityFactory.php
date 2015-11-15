<?php

namespace Palmabit\GoogleDirections\Interfaces;

// use GuzzleHttp\Message\Response;
use GuzzleHttp\Psr7\Response;

interface EntityFactory
{
    /**
     * Returns the appropriate entity as built by the contents of $response
     *
     * @param Response $response
     * @return Entity
     */
    public function createAppropriate(Response $response);
}
