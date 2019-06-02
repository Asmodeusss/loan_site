<?php

include "session.php";
include "db.php";
include_once "util.php";

$owner = $_SESSION["user_id"];
$target = get_user_id(clean_input($_POST["target"]));
$amount = clean_input($_POST["amount"]);

$balance = get_balance($owner);

if ($owner == $target)
{
    die("<br>ERROR: Owner and recipient of loan cannot be the same person!");
}

if ($balance<$amount)
{
    die("ERROR: Insufficient funds!");
}

if ($amount<0)
{
    die("ERROR: Haha nice try. You can't loan a negative amount.");
}

process_loan($owner, $target, $amount);

header("Location: /index.php");

?>