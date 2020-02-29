<?php
/*
    $db_user="root";
    $db_pass="";
    $db_server="localhost";
    $db_name="logindb";
*/

    $con=mysqli_connect("localhost","root","") or die ("Unable to connect");
    mysqli_select_db($con,'putovanjadb');
?>  