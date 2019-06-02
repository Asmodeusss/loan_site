<?php
// Start the session
session_start();

if (isset($_SESSION["login"]))
{
    if ($_SESSION["login"]==true)
    {

        //echo "Hello " . $_SESSION["username"];
    }
}
else
{

}

function stop_session()
{
    $_SESSION = array();
    session_destroy();
}
?>