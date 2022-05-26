<?php
namespace foodFinder;
include "./navBar.php";
include "./getScripts.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DotGothic16&family=Kosugi+Maru&family=Rampart+One&display=swap" rel="stylesheet">


</head>
<body>
    
    <div class="search-container">
    <?php echo getMenuBar(isset($_SESSION['id']))?> 
            <div class="search-bottom">
                <div class="cat-meal">
                    <p>
                        ここもおいしいよ！行ってみて！
                    </p>
                    <img src="../images/no-pic.png" class="lrg-img table">

                </div>
                <div class="results" id="results">

                    </div>
            </div>
            </div>
        </div>
        <?php echo getScripts('osusume') ?>

</body>
</html>
