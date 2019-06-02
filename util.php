<?php
   
   //simple way of logging to console.
   function consoleLog($text)
   {
       echo "<script>console.log(\"$text\")</script>";
   }

   //clean the input of a form to prevent sneaky hacking
   //this by no means makes this site secure.
   function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>