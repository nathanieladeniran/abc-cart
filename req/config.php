<?php

function DB()
{
     $servername = "localhost";
     $username = "nathaniel";
     $password = "ibiyosi141";
     $dbase = "mycart_db";

     $konet = new mysqli($servername,$username,$password,$dbase);

                // Check connection
     if ($konet->connect_error) 
     {
        die("Connection failed: " . $konet->connect_error);
     }
    return $konet;
}
    
?>

