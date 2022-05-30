<?php
    namespace foodFinder;
    include "./navBar.php"; 
    include "./getScripts.php";
    session_start();
    if (!isset($_SESSION['id'])) {
        $_SESSION["page"] = "search";
        header('location: ../index.php');
    }
    ?>
    <!DOCTYPE html>
<html>
    <head>
        <title>Find Restaurants</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DotGothic16&family=Kosugi+Maru&family=Rampart+One&display=swap" rel="stylesheet">

    </head>
    <body>
        <div class="search-container" >
            <?php echo getMenuBar(isset($_SESSION['id']))?> 
            <div class="search-bottom" id="srch-area">
                <div class="search-section" id="srch">
                    <h1>住所検索</h1>
                    <div>
                        <input class="input-type" type="radio" name="search-type" value="1" checked>半径検索
                        <input class="input-type"  type="radio" name="search-type" value="2" disabled="true">食類検索
                    </div>
                    <input class="input-box" type="text" id="address" placeholder="住所"/>
                    <input class="input-box" type="text" id="distance" placeholder="半径"/>
                    <input class="input-box" type="text" id="category" placeholder="食類" disabled="true"/>
                    <button id="find-food" class="go-btn med">検索</button>
                </div>
                <div id="results" class="results"></div>
            </div>
        </div>
        <?php echo getScripts('search') ?>

    </body>
</html>