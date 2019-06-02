<?php

include "session.php";
include "db.php";
include_once "util.php";

$username = clean_input($_POST["username"]);
$password = clean_input($_POST["password"]);

user_login($username, $password);

header("Location: /index.php");
?>