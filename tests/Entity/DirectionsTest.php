<?php

namespace Palmabit\GoogleDirections\Test\Entity;

use Palmabit\GoogleDirections\GoogleDirections;
use Palmabit\GoogleDirections\Factory\Entity;
use GuzzleHttp\Psr7\Response;

class DirectionsTest extends \PHPUnit_Framework_TestCase
{

  /** @var Response */
  protected $response;

  /** @var validMock */
  protected $validMock;

  /** @var apiWithMock */
  protected $apiWithMock;

  public function setUp()
  {
  }

  protected function direction()
  {
      $ef = new Entity();
      return $ef->createAppropriate(new Response(200, [],
          file_get_contents(__DIR__ . '/../Mocks/Directions/mi-ve.json')));
  }

  public function testGetStatus()
  {
    $this->assertEquals($this->direction()->getStatus(), 'OK');
  }

  public function testGetWaypointOrder()
  {
    $this->assertTrue(is_array($this->direction()->getWaypointOrder()));
  }

  public function testGetWarnings()
  {
    $this->assertEquals($this->direction()->getWarnings(), []);
  }

  public function testGetSummary()
  {
    $this->assertEquals($this->direction()->getSummary(), 'A4');
  }

  public function testGetViaWaypoint()
  {
    $this->assertTrue(is_array($this->direction()->getViaWaypoint()));
  }

  public function testGetOverviewPolyline()
  {
    $this->assertTrue(is_array($this->direction()->getOverviewPolyline()));
  }

  public function testGetSteps()
  {
    $this->assertTrue(is_array($this->direction()->getSteps()));
  }

  public function testGetStartLocation()
  {
    $this->assertTrue(is_array($this->direction()->getStartLocation()));
  }

  public function testGetStartAddress()
  {
    $this->assertEquals($this->direction()->getStartAddress(),'Milan, Italy');
  }

  public function testGetEndLocation()
  {
    $this->assertTrue(is_array($this->direction()->getEndLocation()));
  }

  public function testGetEndAddress()
  {
    $this->assertEquals($this->direction()->getEndAddress(),'Venice, Italy');
  }

  public function testGetDuration()
  {
    $this->assertTrue(is_array($this->direction()->getDuration()));
  }

  public function testGetDistance()
  {
    $this->assertTrue(is_array($this->direction()->getDistance()));
  }

  public function testGetLegs()
  {
    $this->assertTrue(is_array($this->direction()->getLegs()));
  }

  public function testGetCopy()
  {
    $this->assertEquals($this->direction()->getCopy(), 'Map data ©2015 Google');
  }

  public function testGetBounds()
  {
    $this->assertTrue(is_array($this->direction()->getBounds()));
  }

  public function testGetRoutes()
  {
    $this->assertTrue(is_array($this->direction()->getRoutes()));
  }

  public function testGetGeocodedWaypoints()
  {
    $this->assertTrue(is_array($this->direction()->getGeocodedWaypoints()));
  }

}
