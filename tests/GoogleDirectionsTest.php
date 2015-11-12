<?php

namespace Palmabit\GoogleDirections\Test;

use Palmabit\GoogleDirections\GoogleDirections;
use Palmabit\GoogleDirections\Exceptions\GoogleDirectionsException;

/**
 * @runTestsInSeparateProcesses
 */
class GoogleDirectionsTest extends \PHPUnit_Framework_TestCase
{
    public function invalidApikeys()
    {
        return [
              'empty' => [''],
              'a' => ['a'],
              'ab' => ['ab'],
              'abc' => ['abc'],
              'digit' => [1],
              'double-digit' => [12],
              'triple-digit' => [123],
              'bool' => [true],
              'array' => [['apikey']],
          ];
    }

    public function validApikeys()
    {
        return [
                'short-hash' => ['123456789'],
                'full-hash' => ['akrwejhtn983z420qrzc8397r4'],
            ];
    }

    /**
     * @dataProvider invalidApikeys
     */
    public function testSetApikeyRaisesExceptionOnInvalidApikey($apikey)
    {
        $this->setExpectedException('InvalidArgumentException');
        GoogleDirections::setApikey($apikey);
    }

    /**
     * @dataProvider validApikeys
     */
    public function testSetApikeysSucceedsOnValidApikey($apikey)
    {
        GoogleDirections::setApikey($apikey);
        $gdir = new GoogleDirections();
        $this->assertInstanceOf('\Palmabit\GoogleDirections\GoogleDirections', $gdir);
    }

    public function testInstantiationWithNoGlobalApikeyAndNoArgumentRaisesAnException()
    {
        $this->setExpectedException('\Palmabit\GoogleDirections\Exceptions\GoogleDirectionsException');
        new GoogleDirections();
    }

    public function testInstantiationWithGlobalApikeyAndNoArgumentSucceeds()
    {
        GoogleDirections::setApikey('apikey');
        $gdir = new GoogleDirections();
        $this->assertInstanceOf('\Palmabit\GoogleDirections\GoogleDirections', $gdir);
    }

    public function testInstantiationWithNoGlobalApikeyButWithArgumentSucceeds()
    {
        $gdir = new GoogleDirections('apikey');
        $this->assertInstanceOf('\Palmabit\GoogleDirections\GoogleDirections', $gdir);
    }

    public function testGetToken()
    {
        GoogleDirections::setApikey('apikey');
        $gd = new GoogleDirections;
        $this->assertEquals('apikey', $gd->getApikey());
        $apikey_example = 'abcdef';
        $gd2 = new GoogleDirections($apikey_example);
        $this->assertEquals($apikey_example, $gd2->getApikey());
    }

    public function testDirectionApiCreation()
    {
        $gd = new GoogleDirections('apikey');
        $directionApi = $gd->createDirectionApi();
        $this->assertInstanceOf('\Palmabit\GoogleDirections\Api\Directions', $directionApi);
    }

}
