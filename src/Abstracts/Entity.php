<?php

namespace Palmabit\GoogleDirections\Abstracts;

use GuzzleHttp\Psr7\Response;

abstract class Entity
{
    /** @var Response */
    protected $response;

    /** @var  array */
    protected $objects;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->objects = json_decode($response->getBody(), true);
    }

}
