<?php

namespace Palmabit\GoogleDirections\Test\Api;

use Palmabit\GoogleDirections\GoogleDirections;

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

    // protected function getValidMock()
    // {
    //     if (!$this->validMock) {
    //         $this->validMock = new MockHandler([
    //             new Response(200, [],
    //                 file_get_contents(__DIR__ . '/../Mocks/Directions/mi-ve.json'))
    //         ]);
    //     }
    //     return $this->validMock;
    // }

    public function testCall()
    {
        // $directions = $this->apiWithMock()->call();
    }

    public function testBuildUrlNoCustomFields()
    {
        $url = $this
            ->apiWithMock
            ->buildUrl();
        $expectedUrl = 'https://maps.googleapis.com/maps/api/directions/json?key=apikey';
        $this->assertEquals($expectedUrl, $url);
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
