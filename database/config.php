<?php

$servername = "localhost";
$db_username = "root";
$db_password = "";
$da_name = "myfolder";

$connection = mysqli_connect($servername,$db_username, $db_password);

$dbconfig = mysqli_select_db($connection,$da_name);

if($dbconfig)
{
    //echo "Database connected";
}
else
{
    echo "Database not connected";
}

?>