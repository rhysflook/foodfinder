<?php
namespace foodFinder;
include "./getConAlt.php";
    session_start();
    if (isset($_SESSION['id'])) {

        $pdo = sendConnection();
        $sql = "SELECT * from kiniiri WHERE user_id = :user_id";
        $st = $pdo->prepare($sql);
        $st->bindValue(":user_id", $_SESSION['id'], \PDO::PARAM_INT);
        $st->execute();
        $result = $st->fetchAll();

            echo json_encode(['user'=> $_SESSION['id'], 'name'=>$_SESSION['name'], 'favourites'=>$result]);

    } else {
        header("HTTP/1.0 400 Bad Request");
        echo json_encode('not logged in');
    }
?>