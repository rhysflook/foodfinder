<!DOCTYPE html>
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
                <button class="menu-button" id="search"><a href="./search.php">検索</a></button>
                <button class="menu-button" id="favs"><a href="./kiniri.php">気に入り</a></button>
            </div>
            <div class="rec" id="recommendations"></div>
            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
            <script type="module" src="../src/menu.js"></script>
        </div>
        <script
        id='google'
        defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxcVTM6J2AoRuhC6guYnS_B4_jAO78ctI&libraries=places"
        >
    </script>
    </body>
</html>