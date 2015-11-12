<?php

namespace Palmabit\GoogleDirections\Test;

use Palmabit\GoogleDirections\Abstracts\Api;

class ApiTest extends \PHPUnit_Framework_TestCase
{

    private $className = 'Palmabit\GoogleDirections\Abstracts\Api';
    private $testApikey = 'apikey';

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function buildMock()
    {
        return $this->getMockForAbstractClass($this->className, [$this->testApikey]);
    }

    public function validTimeouts()
    {
        return [
            'zero' => [0],
            '1000' => [1000],
            '2000' => [2000],
            '3000' => [3000],
            '3 mil' => [3000000],
            '40 mil' => [40000000]
        ];
    }

    public function invalidTimeouts()
    {
        return [
            'negative_big' => [-298979879827],
            'negative_small' => [-4983],
            'string ' => ['abcef'],
            'empty string' => [''],
            'bool' => [false]
        ];
    }

    public function testSetEmptyTimeoutSuccess()
    {
        /** @var Api $mock */
        $mock = $this->buildMock();
        $mock->setTimeout();
    }

    /**
     * @dataProvider invalidTimeouts
     */
    public function testSetTimeoutInvalid($timeout)
    {
        /** @var Api $mock */
        $mock = $this->buildMock();
        $this->setExpectedException('InvalidArgumentException');
        $mock->setTimeout($timeout);
    }

    /**
     * @dataProvider validTimeouts
     */
    public function testSetTimeoutValid($timeout)
    {
        /** @var Api $mock */
        $mock = $this->buildMock();
        $mock->setTimeout($timeout);
    }
}
