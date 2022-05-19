<?php
    session_start();

    if ( !isset( $_SESSION["id"] ) ) {
        try {
            $dsn = "mysql:host=192.168.40.64;dbname=b202213;charset=utf8";
            $u = "user1";
            $p = "pass1";
            $pdo = new PDO( $dsn, $u, $p );
    
            $sql = "SELECT * FROM kiniiri WHERE user_id = :id";
            $st = $pdo->prepare( $sql );
            $st->bindValue( ":id", $_POST["5"], PDO::PARAM_STR );
            $st->execute();
    
            $result = $st->fetchAll( PDO::FETCH_ASSOC );
            if ( $result ) {
                if ( password_verify( $_POST["login_pass"], $result["password"]) ) {
                    $_SESSION["id"] = $result["id"];
                    $_SESSION["name"] = $result["name"];
                }
                else {
                    header( "Location:login.php" );
                    exit();            
                }
            }
            else {
                header( "Location:login.php" );
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
<title>会員トップページ</title>
</head>
<body>
<h1>会員トップページ</h1>
<hr>
<?= $_SESSION["name"] ?>さん、こんにちは。
<hr>
<!--<?php include "member_menu.php" ?>-->
</body>
</html>
