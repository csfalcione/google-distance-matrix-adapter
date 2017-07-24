Google Maps Distance Matrix PHP Wrapper
=========================

<h3>So you dont have to think about it!</h3>
A straightforward, reliable, PHP wrapper for consuming the Google Distance Matrix API.

How to Use
--------
<ol>
    <li><strong>Construct a DistanceMatrix with your google api key</strong>
        <br/>
        <code>
            $distanceMatrix = new DistanceMatrix( "your_api_key" );
        </code>
    </li>
    <li><strong>Run a search or get the first match</strong>
        <br/>
        <code>
            $origin = new Coordinate (40, -74);
            $destination = "Empire State Building"
            <br>
            $result = $distanceMatrix->first( $origin, $destination );
        </code>
    </li>
    <li><strong>Interact with the data through the <em>ResultAdapter object</em></strong>
        <br/>
        <code>
            $result->duration();
            <br/>
            $result->distance();
        </code>
    </li>
</ol>

<h3> Not enough functionality? </h3>

<h6> Feel free to add functionality for your project, just make sure to
send a pull request when you're done! </h6>
