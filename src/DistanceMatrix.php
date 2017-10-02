<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 6/1/2017
 * Time: 7:58 PM
 */

namespace vector\DistanceMatrix;


class DistanceMatrix {

    const API_ENDPOINT = "https://maps.googleapis.com/maps/api/distancematrix/json";

    /**
     * @param $origin
     * @param $destination
     * @param array $options
     * @return false|ResultAdapter
     */
    public function first ($origin, $destination, $options = []) {
        $result = $this->search($origin, $destination, $options);
        if ( count($result) === 0 ) {   return false;   }
        return $result[0];
    }

    /**
     * @param $origin mixed
     * @param $destination mixed
     * @return ResultAdapter[]|bool[]
     */
    public function search( $origin, $destination, $options = [] ){
        //Create all of our query parameters
        $required = [
            'origins' => self::parseAddress($origin),
            'destinations' => self::parseAddress($destination),
            'key' => $this->api_key
        ];
        $query = $required + $options; //Values from the left array overwrite values from the right array
        $query += $this->options;

        //Get the decoded JSON response from Google
        $googleData = self::getGoogleData($query);

        //Check for errors
         self::checkStatus($googleData);

        //Create and return ResultAdapters
        return self::generateResults($googleData);
    }

    /**
     * @param $input mixed
     * @return string
     */
    private static function parseAddress ( $input ) {
        if (is_array($input)) {
            $result = strval($input[0]);
            for ($i = 1; $i < count($input); $i++) {
                $result .= "|".strval($input[$i]);
            }
            return $result;
        }
        return strval($input);
    }

    /**
     * @param $queryArr array
     * @return bool|array
     */
    private static function getGoogleData ( $queryArr ) {
            $url = self::API_ENDPOINT . "?" . http_build_query($queryArr);
            $json = file_get_contents($url);
            return json_decode($json, true);
    }

    /**
     * @param $status array
     * @throws InvalidRequestException MaxElementsExceededException OverQueryLimitException RequestDeniedException UnknownErrorException
     */
    private static function checkStatus ( $responseJson ) {
        $status = $responseJson['status'];
        if ($status === "OK") { return; }
        //Something went wrong, throw exception
        $message = isset($responseJson['error_message']) ?
            $responseJson['error_message'] : "The distance matrix api returned a non-OK response";
        switch ($status) {
            case "INVALID_REQUEST" :
                throw new InvalidRequestException($message);
                break;
            case "MAX_ELEMENTS_EXCEEDED" :
                throw new MaxElementsExceededException($message);
                break;
            case "OVER_QUERY_LIMIT" :
                throw new OverQueryLimitException($message);
                break;
            case "REQUEST_DENIED" :
                throw new RequestDeniedException($message);
                break;
            default :
                throw new UnknownErrorException($message);
                break;
        }
    }

    /**
     * Generates an array of ResultAdapters
     * @param $responseJson
     * @return ResultAdapter[]|bool[]
     */
    private static function generateResults ( $responseJson ) {
        $originAddresses = self::getOriginAddresses($responseJson);
        $destinationAddresses = self::getDestinationAddresses($responseJson);
        $result = [];
        if (!isset($responseJson['rows'])) {    return [];  } //JSON parsing will omit empty arrays
        foreach ($responseJson['rows'] as $originIndex => $destinations) {
            foreach ($destinations['elements'] as $destinationIndex => $element) {
                $result[] = new ResultAdapter(
                    $element,
                    $originAddresses[$originIndex],
                    $destinationAddresses[$destinationIndex]
                );
            }
        }
        return $result;
    }

    /**
 * @param $responseJson
 * @return string[]
 */
    private static function getOriginAddresses ( $responseJson ) {
        return $responseJson['origin_addresses'];
    }

    /**
     * @param $responseJson
     * @return string[]
     */
    private static function getDestinationAddresses ( $responseJson ) {
        return $responseJson['destination_addresses'];
    }

    private $options;
    private $api_key;

    /**
     * DistanceMatrix constructor. See
     * @param $api_key string
     * @param $options array
     */
    function __construct( $api_key, $options = [] ) {
        $this->api_key = $api_key;
        $this->options = $options;
    }
}