<?php

namespace Palmabit\GoogleDirections\Test\Factory;

use GuzzleHttp\Psr7\Response;
use Palmabit\GoogleDirections\GoogleDirections;
use Palmabit\GoogleDirections\Factory\Entity;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Entity */
    protected $entity;

    /** @var Response */
    protected $responseOk;

    public function setUp()
    {
        $this->responseOk = new Response(200);
        $this->entity = new Entity();
    }

    public function testProductEntityPass()
    {
        $this->responseOk = $this->responseOk->withBody(\GuzzleHttp\Psr7\stream_for(json_encode(['status' => 200])));
        $this->entity->createAppropriate($this->responseOk);
    }

}
