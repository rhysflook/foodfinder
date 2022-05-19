<!DOCTYPE html>
<?php 
    session_start();
?>
<html>
    <head>
        <title>Find Restaurants</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,500;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/styles.css">

    </head>
    <body>
        <div class="search-container">
            <div class="search-section">
                <h1>住所検索</h1>
                <div><label>住所<input type="text" id="address"/></label></div>
                <div><label>半径<input type="text" id="distance" /></label></div>
                <button id="search" class="search">検索</button>
            </div>
            <div id="results" class="results"></div>
            <a href="https://lovepik.com/images/png-animal.html">Animal Png vectors by Lovepik.com</a>
        </div>
        <script type="module" src="../src/index.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script
            id='google'
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxcVTM6J2AoRuhC6guYnS_B4_jAO78ctI&libraries=places"
            defer
            >
        </script>

    </body>
</html>