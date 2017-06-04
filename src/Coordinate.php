<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 6/1/2017
 * Time: 8:00 PM
 */

namespace vector\Geocoder;


class Coordinate
{
    private $latitude;
    private $longitude;

    /**
     * @return double
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    function __construct( $latitude, $longitude )
    {
        $this->latitude = doubleval($latitude);
        $this->longitude = doubleval($longitude);
    }
}