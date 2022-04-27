<?php
    session_start();

    if ( !isset( $_SESSION["id"] ) ) {
        try {
            $dsn = "mysql:host=127.0.0.1;dbname=db3;charset=utf8";
            $u = "user1";
            $p = "pass1";
            $pdo = new PDO( $dsn, $u, $p );
    
            $sql = "SELECT * FROM users WHERE id = :id";
            $st = $pdo->prepare( $sql );
            $st->bindValue( ":id", $_POST["login_id"], PDO::PARAM_STR );
            $st->execute();
    
            $result = $st->fetch( PDO::FETCH_ASSOC );
            if ( $result ) {
                if ( password_verify( $_POST["login_pass"], $result["password"]) ) {
                    $_SESSION["id"] = $result["id"];
                    $_SESSION["name"] = $result["name"];
                }
                else {
                    header( "Location:Home.php" );
                    exit();            
                }
            }
            else {
                header( "Location:registration.php" );
                exit();            
            }
        }
        catch ( Exception $e ) {
            echo "接続できませんでした。";
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style_index.css" media="screen and (min-width:1000px)">
	<link rel="stylesheet" href="css/mobile_index.css.css" media="screen and (max-width:999px)">
	<title>FF</title>
</head>
<body>
<?= $_SESSION["name"] ?>さん、こんにちは。
<hr>
<?php include "Home.html" ?>
</body>
</html>
