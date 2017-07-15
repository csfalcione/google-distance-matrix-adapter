<?php

use vector\DistanceMatrix\DistanceMatrix;
use vector\DistanceMatrix\Coordinate;

class DistanceMatrixTest extends PHPUnit_Framework_TestCase{

    private $settings;

    protected function setUp()
    {
        parent::setUp();
        $this->settings = require __DIR__ . '/data/settings.php';
    }

    function testFirstResult(){
        $matrix = new DistanceMatrix( $this->settings['api_key'], ['units' => 'imperial'] );

        $origin = new Coordinate(40, -74);
        $destination = "Empire State Building";

        $result = $matrix->first($origin, $destination, ['avoid' => 'tolls']);
        self::assertNotFalse($result);
        self::assertEquals("17 Elder St, Mantoloking, NJ 08738, USA", $result->origin());
        self::assertEquals("350 5th Ave, New York, NY 10118, USA", $result->destination());
    }

}
