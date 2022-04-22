<?php
session_start();
include('database/config.php');

if($dbconfig)
{
   //        echo "Database connected";
}
else
{
    header('Location: database/config.php');
}
if(!$_SESSION['username'])
{
    header("Location: login.php");  
}



?>