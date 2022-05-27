<?php
namespace foodFinder;
include "./getConAlt.php";
    session_start();

    if ( array_key_exists('login_id', $_POST) && $_POST['login_id'] !== '' ) {
        try {
            $pdo = sendConnection();
    
            $sql = "SELECT * FROM user WHERE 氏名 = :id";
            $st = $pdo->prepare( $sql );
            $st->bindValue( ":id", $_POST["login_id"], \PDO::PARAM_STR );
            $st->execute();
            
    
            $result = $st->fetch( \PDO::FETCH_ASSOC );
            if ( $result ) {
                if ( password_verify( $_POST["login_pass"], $result["パスワード"]) ) {
                    $_SESSION["id"] = $result["id"];
                    $_SESSION["name"] = $result["氏名"];
                    $page = array_key_exists("page", $_SESSION) && $_SESSION["page"] !== "login" ? $_SESSION["page"] : "main";
                    header("Location: ./".$page.".php");
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
        catch ( \Exception $e ) {
            echo "接続できませんでした。";
        }
    } else if (array_key_exists('new_id', $_POST) ) {

        $pdo = sendConnection();
        $sql = "SELECT * FROM user WHERE 氏名 = :id";
        $st = $pdo->prepare( $sql );
        $st->bindValue( ":id", $_POST["new_id"], \PDO::PARAM_STR );
        $st->execute();
        

        $result = $st->fetch( \PDO::FETCH_ASSOC );

        if ($result) {
            echo 'Name already taken!';
        } else {
            $sql = "INSERT INTO user (氏名, パスワード) VALUES (:id, :pass)";
            $st = $pdo->prepare( $sql );
            $st->bindValue( ":id", $_POST["new_id"], \PDO::PARAM_STR );
            $st->bindValue(":pass", password_hash($_POST['new_pass'], PASSWORD_DEFAULT));
            $st->execute();
            $sql = "SELECT * FROM user WHERE 氏名 = :id";
            $st = $pdo->prepare( $sql );
            $st->bindValue( ":id", $_POST["new_id"], \PDO::PARAM_STR );
            $st->execute();
            
    
            $result = $st->fetch( \PDO::FETCH_ASSOC );
            if ($result){
                $_SESSION["id"] = $result["id"];
                $_SESSION["name"] = $result["氏名"];
                $page = array_key_exists("page", $_SESSION) && $_SESSION["page"] !== "login" ? $_SESSION["page"] : "main";
                header("Location: ./".$page.".php");
                exit(); 
        }
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DotGothic16&family=Kosugi+Maru&family=Rampart+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="centered">
        <div class="flex-row">
            <div>

                <form method="post">
                    <div class="details">
                        
                        <input class="input-box" type="text" name="login_id" placeholder="ユーザー">
                        <input class="input-box" type="password" name="login_pass" placeholder="パスワード">
                        <input class="go-btn med" type="submit" value="ログイン">
                    </div>
                </form>
                <div class="hl"></div>
                <form method="post">
                    <div class="details">
                        <input class="input-box" type="text" name="new_id" placeholder="ユーザー">
                        <input class="input-box" type="password" name="new_pass" placeholder="パスワード">
                        <input class="go-btn med" type="submit" value="サインアップ">
                    </div>
                </form>
            </div>
            <div class="page-title"><h1>食べましょう！</h1>
        
            <img src="../images/pizza.png" class="lrg-img">
        </div>
        </div>
    </div>
<script>
    localStorage.removeItem('user')
</script>
</body>
</html>
