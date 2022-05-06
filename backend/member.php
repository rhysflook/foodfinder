<?php
    session_start();

    if ( !isset( $_SESSION["id"] ) ) {
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
                    echo 'hey';
                    header("Location: search.php");
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
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style_index.css" media="screen and (min-width:1000px)">
	<link rel="stylesheet" href="css/mobile_index.css.css" media="screen and (max-width:999px)">
	<title>FF</title>
</head>
<body>


</body>
</html>
