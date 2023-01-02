<?php
    session_start();
    $HOST_NAME= "localhost";
    $DATABASE_NAME="todo_tb";
    $DATABASE_PASSWORD="";
    $DATABASE_USERNAME="root";
    $Connect=mysqli_connect($HOST_NAME,$DATABASE_USERNAME,$DATABASE_PASSWORD,$DATABASE_NAME);
    if(!$Connect){
        echo "Unable to Connect";
    }
?>