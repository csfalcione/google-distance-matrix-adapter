<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 6/1/2017
 * Time: 7:58 PM
 */

namespace vector\Geocoder;


class Geocoder
{
    const API_ENDPOINT = "https://maps.googleapis.com/maps/api/geocode/json";

    /**
     * @param $address
     * @return ResultAdapter[]
     */
    function search( $address ){
        $k = $this->api_key;
        $a = urlencode($address);
        $query = self::API_ENDPOINT."?address=$a&key=$k";
        $json = file_get_contents( $query );
        $googleData = json_decode( $json, true );

        $results = [];
        foreach ( $googleData['results'] as $result ){
            $results[] = new ResultAdapter( $result );
        }
        return $results;
    }

    function firstResult( $address ){
        $results = $this->search( $address );
        if( count( $results ) > 0 ){
            return $results[0];
        }
        return false;
    }

    private $api_key;
    function __construct( $api_key )
    {
        $this->api_key = $api_key;
    }
}