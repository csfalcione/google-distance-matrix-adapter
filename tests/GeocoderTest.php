<?php

use vector\Geocoder\Geocoder;

class GeocoderTest extends PHPUnit_Framework_TestCase{

    private $settings;

    protected function setUp()
    {
        parent::setUp();
        $this->settings = require __DIR__ . '/data/settings.php';
    }

    function testFirstResult(){
        $geocoder = new Geocoder( $this->settings['api_key'] );

        $search = "Innovation Depot Birmingham";
        $result = $geocoder->firstResult( $search );

        self::assertContains( "1500", explode(" ", $result->getFormattedAddress() ) );
        self::assertEquals( 33.5113735, $result->getCoordinate()->getLatitude() );
        self::assertEquals( -86.8129388, $result->getCoordinate()->getLongitude() );

        self::assertEquals( "1500", $result->getStreetNumber() );
        self::assertEquals( "1st Ave N", $result->getStreet() );
        self::assertEquals( "35203", $result->getZipCode() );
        self::assertEquals( "Birmingham", $result->getCity() );
        self::assertEquals( "AL", $result->getState() );
        self::assertEquals( "US", $result->getCountry() );
    }

}
