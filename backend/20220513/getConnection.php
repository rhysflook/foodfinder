<?php 
namespace foodFinder;

function getConnection() {
    return new \mysqli("192.168.40.64", "rhys", "pass", "b202213");
}

function sendRequest($sql, $params) {
    $mysqli = getConnection();
    $stmt = mysqli_prepare($mysqli, $sql);
    $stmt->bind_param(...$params);
    $stmt->execute();
    return $stmt->get_result();
}

?>