<?php
function CreatedbCA(){
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
                        CREATE TABLE IF NOT EXISTS carte_autor(                         
                            id INTEGER NOT NULL PRIMARY KEY,
                            cartea_isbn int(30),
                            autorul_id_autor int (30)                         
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
