<?php

function CreatedbCartea(){
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
                        CREATE TABLE IF NOT EXISTS Carte(                         
                            isbn INTEGER NOT NULL PRIMARY KEY,
                            titlu VARCHAR (20),
                            editura VARCHAR (50),                         
                            nr_exemplare FLOAT,
                            categorie VARCHAR(50)
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
