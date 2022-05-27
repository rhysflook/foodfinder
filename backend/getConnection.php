<?php 
namespace foodFinder;

function getConnection() {
    if ($_SERVER["HTTP_HOST"] === 'progress-it-school.net') {

        return new \mysqli("127.0.0.1", "b2022", "dB4bApUK", "b2022C");
    } else {

        return new \mysqli("192.168.40.64", "rhys", "pass", "b2022c");
    }
}

function sendRequest($sql, $params) {
    $mysqli = getConnection();
    $stmt = mysqli_prepare($mysqli, $sql);
    $stmt->bind_param(...$params);
    $stmt->execute();
    return $stmt->get_result();
}

?>