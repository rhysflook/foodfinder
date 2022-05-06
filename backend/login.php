<?php
    session_start();

    if ( array_key_exists('login_id', $_POST) ) {
        try {
            $dsn = "mysql:host=192.168.40.64;dbname=b202213;charset=utf8";
            $u = "rhys";
            $p = "pass";
            $pdo = new PDO( $dsn, $u, $p );
    
            $sql = "SELECT * FROM user WHERE 氏名 = :id";
            $st = $pdo->prepare( $sql );
            $st->bindValue( ":id", $_POST["login_id"], PDO::PARAM_STR );
            $st->execute();
            
    
            $result = $st->fetch( PDO::FETCH_ASSOC );
            if ( $result ) {
                if ( password_verify( $_POST["login_pass"], $result["パスワード"]) ) {
                    $_SESSION["id"] = $result["id"];
                    $_SESSION["name"] = $result["氏名"];

                    header("Location: main.php");
                    exit(); 
                }
                else {
                    echo 'password incorrect';
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
<title>ログイン</title>
</head>
<body>
<h1>ログイン</h1>
<hr>
<form method="post">
ログインID：<input type="text" name="login_id"><br>
パスワード：<input type="password" name="login_pass">　<input type="reset" value="クリア"><br>
<input type="submit" value="ログイン">
</form>
</body>
</html>
