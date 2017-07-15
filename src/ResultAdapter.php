<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 6/1/2017
 * Time: 8:00 PM
 */

namespace vector\DistanceMatrix;


class ResultAdapter  {


    /** Returns the origin address */
    public function origin () {
        return $this->originAddress;
    }
    /** Returns the destination address */
    public function destination () {
        return $this->destinationAddress;
    }
    public function status() {
        return $this->googleResult['status'];
    }

    public function duration() {
        return $this->googleResult['duration']['value'];
    }
    public function distance() {
        return $this->googleResult['distance']['value'];
    }
    public function durationInTraffic() {
        if (isset($this->googleResult['duration_in_traffic']['value'])) {
            return $this->googleResult['duration_in_traffic']['value'];
        }
        return false;
    }

    public function durationText() {
        return $this->googleResult['duration']['text'];
    }
    public function distanceText() {
        return $this->googleResult['distance']['text'];
    }
    public function durationInTrafficText() {
        if (isset($this->googleResult['duration_in_traffic']['text'])) {
            return $this->googleResult['duration_in_traffic']['text'];
        }
        return false;
    }


    /**
     * @throws MaxRouteLengthExceededException
     * @throws NotFoundException
     * @throws ZeroResultsException
     */
    private function checkStatus () {
        $status = $this->googleResult['status'];
        if ($status === "OK") { return; }
        switch ($status) {
            case "NOT_FOUND" :
                throw new NotFoundException("($this->originAddress) or ($this->destinationAddress) could not be geocoded");
                break;
            case "ZERO_RESULTS" :
                throw new ZeroResultsException("No route could be found between ($this->originAddress) and ($this->destinationAddress)");
                break;
            case "MAX_ROUTE_LENGTH_EXCEEDED" :
                throw new MaxRouteLengthExceededException("The route between ($this->originAddress) and ($this->destinationAddress) is too long and could not be processed");
                break;
        }
    }

    private $googleResult;
    private $originAddress;
    private $destinationAddress;

    /**
     * ResultAdapter constructor.
     * @param $googleResult array
     * @param $originAddress string
     * @param $destinationAddress string
     */
    function __construct( $googleResult, $originAddress, $destinationAddress ){
        // Depends on..
        // Google Geocoder API: https://developers.google.com/maps/documentation/geocoding/start
        $this->googleResult =       $googleResult;
        $this->originAddress =      $originAddress;
        $this->destinationAddress = $destinationAddress;
        $this->checkStatus();
    }
}
