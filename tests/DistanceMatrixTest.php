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

        $origin = [new Coordinate(40, -74), "Chrysler Building, New York City"];
        $destination = "Empire State Building";

        $resultA = $matrix->first($origin, $destination, ['avoid' => 'tolls']);
        self::assertNotFalse($resultA);
        self::assertEquals("17 Elder St, Mantoloking, NJ 08738, USA", $resultA->origin());
        self::assertEquals("350 5th Ave, New York, NY 10118, USA", $resultA->destination());

        $resultB = $matrix->search($origin, $destination);
        self::assertCount(2, $resultB);
        foreach ($resultB as $result) {
            self::assertNotFalse($result);
        }

        $resultC = $matrix->first("fjkadjkf", "fjksdkjf");
        self::assertFalse($resultC);

    }

}
