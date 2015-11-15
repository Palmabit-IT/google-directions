<?php

namespace Palmabit\GoogleDirections\Test\Api;

use Palmabit\GoogleDirections\GoogleDirections;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class ProductApiTest extends \PHPUnit_Framework_TestCase
{

    protected $validMock;
    /**
     * @var \Palmabit\GoogleDirections\Api\Directions
     */
    protected $apiWithMock;

    protected function setUp()
    {
        $apikey = 'apikey';
        $gd = new GoogleDirections($apikey);
        $this->apiWithMock = $gd->createDirectionApi();
    }

    public function testCall()
    {
      $apikey = 'apikey';
      $gd_stub = $this->getMockBuilder('\Palmabit\GoogleDirections\Api\Directions')
         ->setConstructorArgs([$apikey])
         ->getMock();

      $gd_stub->expects($this->once())
         ->method('call')
         ->will($this->returnValue( json_decode( file_get_contents(__DIR__ . '/../Mocks/Directions/mi-ve.json' ),true) ));

      $directions = $gd_stub->call();

      $this->assertEquals($directions['status'], 'OK');

    }

    public function testBuildUrlNoCustomFields()
    {
        $url = $this
            ->apiWithMock
            ->buildUrl();
        $expectedUrl = 'https://maps.googleapis.com/maps/api/directions/json?key=apikey';
        $this->assertEquals($expectedUrl, $url);
    }

    public function testEmptyCustomFieldRaisesAnException()
    {
        $this->setExpectedException('\BadMethodCallException');
        $this
            ->apiWithMock
            ->aaaOrigin(null);
    }

    public function testCustomFieldNotSupportedRaisesAnException()
    {
        $this->setExpectedException('\BadMethodCallException');
        $this
            ->apiWithMock
            ->setCustomfileds();
    }

    public function testInvalidPrefixOnCustomFieldRaisesAnException()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $this
            ->apiWithMock
            ->setOrigin(null);
    }

    public function testBuildUrlMultipleCustomFields()
    {
        $url = $this
            ->apiWithMock
            ->setOrigin('Milano')
            ->setDestination('Venezia')
            ->buildUrl();
        $expectedUrl = 'https://maps.googleapis.com/maps/api/directions/json?key=apikey&origin=Milano&destination=Venezia';
        $this->assertEquals($expectedUrl, $url);
    }

}
