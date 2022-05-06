<?php 
namespace foodFinder;
include './getConnection.php';

$_POST = json_decode(file_get_contents("php://input"),true);
$sql = getConnection();
$result = sendRequest(
    "INSERT INTO searches (user_id, search_content, date) VALUES (?, ?, ?)",
    ['isi', $_POST['id'], $_POST['content'], $_POST['date']]
);

echo json_encode($result);

?>