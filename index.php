<?php 
session_start();
if (array_key_exists("target", $_POST)) {
    if (array_key_exists("id", $_SESSION)) {
        header('location: ./backend/'.$_POST["target"].".php");
    } else {
        $_SESSION["page"] = $_POST["target"];
        header('location: ./backend/login.php');
    }
} else {
    header('location: ./backend/main.php');
}
exit();
?>