<?php
    session_start();
    if (isset($_SESSION['id'])) {
        $dsn = "mysql:host=192.168.40.64;dbname=b202213;charset=utf8";
        $u = "rhys";
        $p = "pass";
        $pdo = new PDO( $dsn, $u, $p );
        $sql = "SELECT * from kiniiri WHERE user_id = :user_id";
        $st = $pdo->prepare($sql);
        $st->bindValue(":user_id", $_SESSION['id'], PDO::PARAM_INT);
        $st->execute();
        $result = $st->fetchAll();

            echo json_encode(['user'=> $_SESSION['id'], 'favourites'=>$result]);

    } else {
        header("HTTP/1.0 400 Bad Request");
        echo json_encode('not logged in');
    }
?>