<?php
namespace foodFinder;
include "./navBar.php";
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Menu</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DotGothic16&family=Kosugi+Maru&family=Rampart+One&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="menu-container">
           <?php echo getMenuBar(isset($_SESSION['id']))?> 
        </div>
        <div class="welcome-msg">
            <div>
                <h3>～ようこそ　食の世界へ～</h3>
                <p>どんなたべものをたべたい？</p>
                <p>何がたべたい？</p>
                <p>一緒に探しませんか？</p>
            </div>
        </div>
        <div class="welcome-msg">
            <img class="food" src="../images/bibimbap.png">
            <button id="get-food" class="go-btn lrg">探そう！</button>
        </div>
        <!-- <div class="bottom"></div> -->

    <script src="../src/navMenu.js"></script>
    <script>
        document.getElementById('get-food').addEventListener('click', () => {
            window.location.href = './search.php'
        })
    </script>
    </body>
</html>