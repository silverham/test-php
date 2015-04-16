<?php
$connection=new mysqli("localhost", "aqm", "jc66882Dxc9D", "aqm"); //$host,$user,$password,$db
if ($connection->connect_error) {
    die('Connect Error');
}

mysqli_select_db($connection, "aqm");
