<?php

require_once ("db.php");
require_once ("component.php");

$con = CreatedbCartea();


if(isset($_POST['create'])){
    createDataCartea();
}

if(isset($_POST['update'])){
    UpdateDataCartea();
}

if(isset($_POST['delete'])){
    deleteRecordCartea();
}

if(isset($_POST['deleteall'])){
    deleteAll();

}

error_reporting(0);

function createDataCartea(){
    $isbn = textboxValueCartea("isbn");
    $titlu = textboxValueCartea("titlu");
    $editura = textboxValueCartea("editura");   
    $nrex=textboxValueCartea("nr_exemplare");
    $categorie=textboxValueCartea("categorie");

    if($isbn && $titlu && $editura && $nrex &&  $categorie ){

        $sql = "INSERT INTO Cartea (isbn, titlu, editura,  nr_exemplare,categorie ) 
                        VALUES ('$isbn','$titlu','$editura', '$nrex', '$categorie')";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNodeCartea("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }else{
            TextNodeCartea("error", "Provide Data in the Textbox");
    }
}


function textboxValueCartea($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

function TextNodeCartea($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

function getDataCartea(){
    $sql = "SELECT * FROM Cartea";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}


function UpdateDataCartea(){
    $isbn = textboxValueCartea("isbn");
    $titlu = textboxValueCartea("titlu");
    $editura = textboxValueCartea("editura");
    $nrex=textboxValueCartea("nr_exemplare");
    $categorie=textboxValueCartea("categorie");


    if($isbn && $titlu && $editura  && $nrex &&  $categorie ){
        $sql = "
                    UPDATE Cartea SET isbn='$isbn', titlu = '$titlu', editura = '$editura',  nr_exemplare='$nrex', categorie='$categorie'  WHERE isbn='$isbn';                    
        ";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNodeCartea("success", "Data Successfully Updated");
        }else{
            TextNodeCartea("error", "Enable to Update Data");
        }

    }else{
        TextNodeCartea("error", "Select Data Using Edit Icon");
    }
}


function deleteRecordCartea(){
    $isbn = (int)textboxValueCartea("isbn");

    $sql = "DELETE FROM Cartea WHERE isbn=$isbn";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNodeCartea("success","Record Deleted Successfully...!");
    }else{
        TextNodeCartea("error","Enable to Delete Record...!");
    }

}


function deleteBtnCartea(){
    $result = getDataCartea();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                return;
            }
        }
    }
}

function deleteAllCartea(){
    $sql = "DROP TABLE Cartea";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNodeCartea("success","All Record deleted Successfully...!");
        CreatedbCartea();
    }else{
        TextNodeCartea("error","Something Went Wrong Record cannot deleted...!");
    }
}
