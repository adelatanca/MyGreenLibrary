<?php

function CreatedbStatusCarte(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookstore";

   
    $con = mysqli_connect($servername, $username, $password);

    
    if (!$con){
        die("Connection Failed : " . mysqli_connect_error());
    }

  
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if(mysqli_query($con, $sql)){
        $con = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "
                        CREATE TABLE IF NOT EXISTS status_cartea(                         
                            nr_carte INTEGER NOT NULL PRIMARY KEY,
                            disponibilitate char (1),
                            cartea_isbn INTEGER                                                   
                        );
        ";

        if(mysqli_query($con, $sql)){
            return $con;
        }else{
            echo "Cannot Create table...!";
        }

    }else{
        echo "Error while creating database ". mysqli_error($con);
    }

}
