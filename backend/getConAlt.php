<?php
namespace foodFinder;
function sendConnection() {
    if (str_contains($_SERVER['REQUEST_URI'], 'progress')) {
        $dsn = "mysql:host=127.0.0.1;dbname=b2022C;charset=utf8";
        $u = "b2022";
        $p = "dB4bApUK";
    } else {
        $dsn = "mysql:host=192.168.40.64;dbname=b2022c;charset=utf8";
        $u = "rhys";
        $p = "pass";
    }
    return new \PDO( $dsn, $u, $p );
}
?>