<?php

namespace Palmabit\GoogleDirections\Entity;

use Palmabit\GoogleDirections\Abstracts\Entity;

class Directions extends Entity
{

    /**
     * Returns the geocoded waypoints
     * @return array
     */
    public function getGeocodedWaypoints()
    {
        return (array) $this->objects['geocoded_waypoints'];
    }

    /**
     * Returns the routes
     * @return array
     */
    public function getRoutes()
    {
        return (array) $this->objects['routes'];
    }


    /**
     * Returns bounds
     * @return array
     */
    public function getBounds()
    {
        return (array) $this->getRoutes()[0]['bounds'];
    }

    /**
     * Returns copy
     * @return string
     */
    public function getCopy()
    {
        return (string) $this->getRoutes()[0]['copyrights'];
    }


    /**
     * Returns the legs
     * @return array
     */
    public function getLegs()
    {
        return (array) $this->getRoutes()[0]['legs'];
    }

    /**
     * Returns the distance
     * @return array
     */
    public function getDistance()
    {
        return (array) $this->getLegs()[0]['distance'];
    }

    /**
     * Returns the duration
     * @return array
     */
    public function getDuration()
    {
        return (array) $this->getLegs()[0]['duration'];
    }

    /**
     * Returns the end address
     * @return string
     */
    public function getEndAddress()
    {
        return (string) $this->getLegs()[0]['end_address'];
    }

    /**
     * Returns the end location
     * @return array
     */
    public function getEndLocation()
    {
        return (array) $this->getLegs()[0]['end_location'];
    }

    /**
     * Returns the start address
     * @return string
     */
    public function getStartAddress()
    {
        return (string) $this->getLegs()[0]['start_address'];
    }

    /**
     * Returns the start location
     * @return array
     */
    public function getStartLocation()
    {
        return (array) $this->getLegs()[0]['start_location'];
    }

    /**
     * Returns the steps
     * @return array
     */
    public function getSteps()
    {
        return (array) $this->getLegs()[0]['steps'];
    }

    /**
     * Returns the via_waypoint
     * @return string
     */
    public function getViaWaypoint()
    {
        return $this->getLegs()[0]['via_waypoint'];
    }

    /**
     * Returns the routes overview_polyline
     * @return array
     */
    public function getOverviewPolyline()
    {
        return (array) $this->getRoutes()[0]['overview_polyline'];
    }

    /**
     * Returns the routes summary
     * @return string
     */
    public function getSummary()
    {
        return (string) $this->getRoutes()[0]['summary'];
    }

    /**
     * Returns the routes summary
     * @return string
     */
    public function getWarnings()
    {
        return (array) $this->getRoutes()[0]['warnings'];
    }

    /**
     * Returns the routes summary
     * @return array
     */
    public function getWaypointOrder()
    {
        return (array) $this->getRoutes()[0]['waypoint_order'];
    }

    /**
     * Returns the status
     * @return string
     */
    public function getStatus()
    {
        return $this->objects['status'];
    }

}
