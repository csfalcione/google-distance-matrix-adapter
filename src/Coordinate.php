<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 6/1/2017
 * Time: 8:00 PM
 */

namespace vector\DistanceMatrix;


class Coordinate
{
    private $latitude;
    private $longitude;

    /**
     * Returns the longitude component of this Coordinate
     * @return double
     */
    public function lng()
    {
        return $this->longitude;
    }

    /**
     * Returns the latitude component of this Coordinate
     * @return double
     */
    public function lat()
    {
        return $this->latitude;
    }

    function __construct( $latitude, $longitude )
    {
        $this->latitude = doubleval($latitude);
        $this->longitude = doubleval($longitude);
    }

    public function __toString() {
        return "$this->latitude,$this->longitude";
    }
}