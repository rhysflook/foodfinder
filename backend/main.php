<!DOCTYPE html>
<?php
session_start();

?>
<html>
    <head>
        <title>Menu</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/menu.css">
    </head>
    <body>
        <div class="menu-container">

            <div class="menu-items">
            <a class="menu-button" href="./search.php"><button class="menu-button-inner" id="search">検索</button></a>
            <a class="menu-button" href="./kiniiri.php"><button class="menu-button-inner" id="favs">気に入り</button></a>
            </div>
            <div class="rec" id="recommendations"></div>
        </div>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script type="module" src="../src/menu.js"></script>
        <script
        id='google'
        defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxcVTM6J2AoRuhC6guYnS_B4_jAO78ctI&libraries=places"
        >
    </script>
    </body>
</html>