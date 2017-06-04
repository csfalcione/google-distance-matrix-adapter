Google Maps Geocoder PHP Wrapper
=========================

<h3>So you dont have to think about it!</h3>
A straightforward, reliable, PHP wrapper for consuming the Google Geocoding API.

How to Use
--------
<ol>
    <li><strong>Construct a Geocoder with your api_key</strong>
        <br/>
        <code>
            new Geocoder( "your_api_key" );
        </code>
    </li>
    <li><strong>Run a search or get the first match</strong>
        <br/>
        <code>
            $search = "Innovation Depot Birmingham";
            <br>
            $result = $geocoder->firstResult( $search );
        </code>
    </li>
    <li><strong>Interact with the data through the <em>ResultAdapter object</em></strong>
        <br/>
        <code>
            $result->getCoordinate();
            <br/>
            $result->getFormattedAddress();
        </code>
    </li>
</ol>

<h3> Not enough functionality? </h3>
<h6> We've only included what was applicable to another project. </h6>
<h6> If you need more functionality than we did, 
but still want to take advantage of the strong project structure, you have two options: </h6>
<ul>
    <li> Extend the ResultAdapter class, to access a protected "Google Data" object </li>
    <li> Or better yet.. Build to the ResultAdapter class directly, using the patterns already in place, and send a pull request! </li>
</ul>