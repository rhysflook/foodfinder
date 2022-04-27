<!DOCTYPE html>
<html>
    <head>
        <title>Find Restaurants</title>
        <script type="module" src="../src/index.js"></script>
    </head>
    <body>
        <h1>Enter a location</h1>
        <input type="text" id="address"/>
        <label>Range</label>
        <input type="text" id="distance" />
        <button id="search">Search</button>

        <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxcVTM6J2AoRuhC6guYnS_B4_jAO78ctI&libraries=places&callback=initMap"
        defer>
        
        </script>


    </body>
</html>