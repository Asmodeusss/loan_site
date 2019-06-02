<!DOCTYPE html>
<html>
<body>

<?php include 'db.php';?>
<?php include 'session.php';?>

<?php
if (!isset($_SESSION["login"]))
{
    include('login.php');
}
else
{
    echo "Hello " . $_SESSION["username"];
    include("functions.php");
}

?>

</body>
</html>