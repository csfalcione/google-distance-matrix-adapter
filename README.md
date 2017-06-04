Google Maps Geocoder PHP Wrapper
=========================

#### So you dont have to think about it!
A straightforward, reliable, PHP wrapper for consuming the Google Geocoding API.

How to Use
--------

1. <strong>Construct a Geocoder with your api_key</strong>
<code>
    new Geocoder( "your_api_key" );
</code>

2. <strong>Run a search or get the first match</strong>
<code>
    $search = "Innovation Depot Birmingham";
    $result = $geocoder->firstResult( $search );
</code>

3. <strong>Interact with the data through the *Result object API</strong>
<code>
    $result->getCoordinate();
    $result->getFormattedAddress();
</code>


### Not enough funcionality?
###### We've only included what was applicable to another project.
###### If you need more functionality than we did, but still want to take advantage of the strong project structure, you have two options:
* Extend the ResultAdapter class, to access a protected "Google Data" object

or better yet...
* Build to the ResultAdapter class directly, using the patterns already in place, and send a pull request!