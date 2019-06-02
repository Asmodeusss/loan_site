<?php

include "session.php";
include "db.php";
include_once "util.php";

$username = clean_input($_POST["username"]);
$password = clean_input($_POST["password"]);

process_registry($username, $password);
header("Location: /index.php");
?>