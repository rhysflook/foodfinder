<?php
    session_start();
    
    if (isset($_SESSION['id'])) {
        $id = explode( 'php/', $_SERVER['REQUEST_URI'] )[1];

        $dsn = "mysql:host=192.168.40.64;dbname=b202213;charset=utf8";
        $u = "rhys";
        $p = "pass";
        $pdo = new PDO( $dsn, $u, $p );
        $sql = "DELETE FROM kiniiri WHERE google_id = :google_id";
        $st = $pdo->prepare($sql);
        $st->bindValue(":google_id", $id, PDO::PARAM_STR);
        if ($st->execute()) {
            echo 'item removed';
        }           

    } else {
        header("HTTP/1.0 400 Bad Request");
        echo json_encode('not logged in');
    }
?>