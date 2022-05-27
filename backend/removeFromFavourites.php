<?php
namespace foodFinder;
include "./getConAlt.php";
    session_start();
    
    if (isset($_SESSION['id'])) {
        $id = explode( 'php/', $_SERVER['REQUEST_URI'] )[1];

        $pdo = sendConnection();
        $sql = "DELETE FROM kiniiri WHERE google_id = :google_id";
        $st = $pdo->prepare($sql);
        $st->bindValue(":google_id", $id, \PDO::PARAM_STR);
        if ($st->execute()) {
            echo 'item removed';
        }           

    } else {
        header("HTTP/1.0 400 Bad Request");
        echo json_encode('not logged in');
    }
?>