<?php
function CreatedbAutor(){
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
                        CREATE TABLE IF NOT EXISTS autorul(                         
                            id_autor INTEGER NOT NULL PRIMARY KEY,
                            nume_autor VARCHAR (20),
                            prenume_autor VARCHAR (50),
                            gen VARCHAR(50)
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
