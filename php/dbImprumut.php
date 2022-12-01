<?php

function CreatedbImpr(){
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
                        CREATE TABLE IF NOT EXISTS imprumutul(                         
                            data_imprumut date NOT NULL PRIMARY KEY,
                            data_returnare date,
                            data_returnarii date,                         
                            status_cartea_nr_carte int,
                            cititorul_id_cititor int
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
