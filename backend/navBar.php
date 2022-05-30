<?php
namespace foodFinder;

function getMenuBar($isLoggedIn) {
    $template = '
    <form method="post" action="../index.php" class="menu-bar">
        <div>
            <img class="plate" src="../images/dish_3.png">
        </div>
        <div id="menu-dd" class="menu-open"><img class="hamburger" src="../images/hamburger.png"></div>
        <div class="menu-items" id="nav">
            <button  class="menu-button" id="home" name="target" value="main">
            <div>
                <p>Home</p>
                <h3>ホーム</h3>
            </div>
            </button>          
            <button class="menu-button" id="login" name="target" value='.($isLoggedIn ? "logout": "login").'>
            <div>
                <p>'
                .($isLoggedIn ? "Logout" : "Login").'</p>
                <h3>
                    '.($isLoggedIn ? "ログオフ" : "ログイン").'</h3>
            </div>
            </button>
            <button class="menu-button" id="search" name="target" value="search">
            <div>
                <p>Search</p>
                <h3>検索</h3>
            </div>
            </button>
            <button  class="menu-button" id="favs" name="target" value="kiniiri">
            <div>
                <p>Favourites</p>
                <h3>お気に入り</h3></div>
            </button>
            <button class="menu-button" id="osusume" name="target" value="osusume">
            <div>
                <p>Recommended</p>
                <h3>オススメ</h3>
            </div>
            </button>        
        </div>
    </form>';
    return $template;
}
?>