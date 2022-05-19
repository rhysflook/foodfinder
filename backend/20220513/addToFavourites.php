<?php 
session_start();
$_POST = json_decode(file_get_contents("php://input"),true);
try {

    $dsn = "mysql:host=192.168.40.64;dbname=b202213;charset=utf8";
    $u = "rhys";
    $p = "pass";
    $pdo = new PDO( $dsn, $u, $p );

    

    $sql = "INSERT INTO kiniiri (user_id, google_id) VALUES (:user_id, :google_id)";
    $st = $pdo->prepare($sql);
    $st->bindValue(":user_id", $_POST['user_id'], PDO::PARAM_INT);
    $st->bindValue(":google_id", $_POST["google_id"], PDO::PARAM_STR);
    $st->execute();
    echo json_encode(['result'=>'Successfully added entry']);
} catch (Exception $e) {
    header("HTTP/1.0 400 Bad Request");
    echo json_encode($e);
}
?>