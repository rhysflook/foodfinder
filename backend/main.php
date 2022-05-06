<!DOCTYPE html>
<html>
    <head>
        <title>Menu</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
        <div>
            <button id="search"><a href="./search.php">Search</a></button>
            <button id="favs"><a href="./kiniri.php">Favourites</a></button>
        </div>
        <div id="recommendations"></div>
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