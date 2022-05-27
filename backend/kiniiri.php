<?php 
namespace foodFinder;
include "./navBar.php";
include "./getScripts.php";
include "./getConAlt.php";
session_start();
if (true) {
    try {

            $pdo = sendConnection();
            
            $sql = "SELECT * FROM kiniiri WHERE user_id = :id";
            $st = $pdo->prepare( $sql );
            $st->bindValue( ":id", $_SESSION['id'], \PDO::PARAM_INT );
            $st->execute();
            
            $result = $st->fetchAll( \PDO::FETCH_ASSOC );
            
            if ( isset($result) ) {
                for( $i = 0 ; $i < 3 ; $i++ ){
                    $_SESSION["kiniiri"] = $result;
				}
            }
        }
        catch ( \Exception $e ) {
            echo "接続できませんでした。";
        }
    }            else {
        header( "Location:login.php" );
        exit();            
    }
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
                    <img src="../images/no-pic.png" class="lrg-img table">
                    <div>

                        <img src="../images/pizza.png" class="med-img slant">
                        <img src="../images/bibimbap.png" class="sm-img slant">
                    </div>
                </div>
                <div class="results">

                    <?php foreach($_SESSION["kiniiri"] as $key=>$value): ?>
                        <div class="shop" id="<?php echo $value['google_id'] ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
            </div>
            </div>
        </div>
        <?php echo getScripts('kiniiri') ?>

</body>
</html>


