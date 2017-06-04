<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 6/1/2017
 * Time: 8:00 PM
 */

namespace vector\Geocoder;


class ResultAdapter
{
    protected $googleResult;

    private $formatted_address;
    private $coordinate;

    /**
     * @return mixed
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * @return mixed
     */
    public function getFormattedAddress()
    {
        return $this->formatted_address;
    }

    /**
     * @param mixed $formatted_address
     */
    public function setFormattedAddress($formatted_address)
    {
        $this->formatted_address = $formatted_address;
    }

    function __construct( $googleResult ){
        // Depends on..
        // Google Geocoder API: https://developers.google.com/maps/documentation/geocoding/start
        $this->googleResult =           $googleResult;
        $this->setFormattedAddress(     $googleResult['formatted_address'] );
        $lat =                          $googleResult['geometry']['location']['lat'];
        $lng =                          $googleResult['geometry']['location']['lng'];
        $this->coordinate = new Coordinate( $lat, $lng );
    }
}