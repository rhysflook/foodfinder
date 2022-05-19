<?php
namespace foodFinder;
include './getConnection.php';


$callback = function ($values) {
    $keys = ['id', 'userId', 'content', 'date', 'type'];
    $object = [];
    foreach ($values as $key => $value) {
        $object[$keys[$key]] = $value;
    };
    return $object;
};

$sql = getConnection();
$results = sendRequest(
    "SELECT * FROM searches WHERE user_id = ?",
    ["i", explode( 'php/', $_SERVER['REQUEST_URI'] )[1]]
);


$data = array_map($callback, $results->fetch_all());

echo json_encode($data);

?>