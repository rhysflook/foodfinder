<?php 
namespace foodFinder;
include './getConnection.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
$_POST = json_decode(file_get_contents("php://input"),true);

try {
    $sql = getConnection();
    $results = sendRequest(
        "INSERT INTO reviews (user_id, user_name, google_id, content, date, rating) VALUES (?, ?, ?, ?, ?, ?)",
        ['isssii', $_POST["user_id"], $_POST["user_name"], $_POST["google_id"], $_POST["content"], $_POST["date"], $_POST["rating"]]
    );
    echo json_encode($_POST);
} catch (\Exception $e) {
    header("HTTP/1.0 400 Bad Request");
    echo json_encode($e);
}
?>