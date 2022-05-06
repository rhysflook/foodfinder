<!DOCTYPE html>
<?php 
    session_start();
?>
<html>
    <head>
        <title>Find Restaurants</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,500;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/styles.css">

    </head>
    <body>
        <div class="search-section">
            <h1>Enter a location</h1>
            <input type="text" id="address"/>
            <label>Range</label>
            <input type="text" id="distance" />
            <button id="search">Search</button>
        </div>
        <div id="results"></div>
        <script
            id='google'
            async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxcVTM6J2AoRuhC6guYnS_B4_jAO78ctI&libraries=places"
            defer>
        </script>
        <script type="module" src="../src/index.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    </body>
</html>