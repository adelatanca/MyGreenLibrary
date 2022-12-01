<?php

require_once ("dbStatusCarte.php");
require_once ("component.php");

$conStatus=CreatedbStatusCarte();
error_reporting(0);

if(isset($_POST['createSC'])){
    createDataSC();
}

if(isset($_POST['updateSC'])){
    UpdateDataSC();
}

if(isset($_POST['deleteSC'])){
    deleteRecordSC();
}

if(isset($_POST['deleteallSC'])){
    deleteAllSC();

}

if(isset($_POST['selectSC'])){
    getSelect();

}


function createDataSC(){
    $nr_carte = textboxValueSC("nr_carte");
    $disponibilitate = textboxValueSC("disponibilitate");
    $cartea_isbn = textboxValueSC("cartea_isbn");   
  

    if($nr_carte && $disponibilitate==0  && $cartea_isbn  ){

        $sql = "INSERT INTO status_cartea (nr_carte, disponibilitate, cartea_isbn ) 
                        VALUES ('$nr_carte','0','$cartea_isbn')";

        if(mysqli_query($GLOBALS['conStatus'], $sql)){
            TextNodeSC("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }
    else  if($nr_carte && $disponibilitate  && $cartea_isbn  ){

        $sql = "INSERT INTO status_cartea (nr_carte, disponibilitate, cartea_isbn ) 
                        VALUES ('$nr_carte','$disponibilitate','$cartea_isbn')";

        if(mysqli_query($GLOBALS['conStatus'], $sql)){
            TextNodeSC("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }
    
    else{
            TextNodeSC("error", "Provide Data in the Textbox");
    }
}


function textboxValueSC($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conStatus'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

function TextNodeSC($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

function getDataSC(){
    $sql = "SELECT * FROM status_cartea";

    $result = mysqli_query($GLOBALS['conStatus'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

function getSelectSC()
{
   $sql = textboxValueSC("sqlSelect");
   $result2 = mysqli_query($GLOBALS['conStatus'], $sql);

    if(mysqli_num_rows($result2) > 0){
        return $result2;
    }
}

function UpdateDataSC(){
    $nr_carte = textboxValueSC("nr_carte");
    $disponibilitate = textboxValueSC("disponibilitate");
    $cartea_isbn = textboxValueSC("cartea_isbn");
  
   
    if($nr_carte && $disponibilitate==0 && $cartea_isbn  ){
        $sql = "
                    UPDATE status_cartea SET nr_carte='$nr_carte', disponibilitate = '0', cartea_isbn = '$cartea_isbn' WHERE nr_carte='$nr_carte';                    
        ";

        if(mysqli_query($GLOBALS['conStatus'], $sql)){
            TextNodeSC("success", "Data Successfully Updated");
        }else{
            TextNodeSC("error", "Enable to Update Data");
        }

    }
    else  if($nr_carte && $disponibilitate && $cartea_isbn  ){
        $sql = "
                    UPDATE status_cartea SET nr_carte='$nr_carte', disponibilitate = '$disponibilitate', cartea_isbn = '$cartea_isbn' WHERE nr_carte='$nr_carte';                    
        ";

        if(mysqli_query($GLOBALS['conStatus'], $sql)){
            TextNodeSC("success", "Data Successfully Updated");
        }else{
            TextNodeSC("error", "Enable to Update Data");
        }

    }
    else{
        TextNodeSC("error", "Select Data Using Edit Icon");
    }
}


function deleteRecordSC(){
    $nr_carte = (int)textboxValueSC("nr_carte");

    $sql = "DELETE FROM status_cartea WHERE nr_carte=$nr_carte";

    if(mysqli_query($GLOBALS['conStatus'], $sql)){
        TextNodeSC("success","Record Deleted Successfully...!");
    }else{
        TextNodeSC("error","Enable to Delete Record...!");
    }

}


function deleteBtnSC(){
    $result = getDataSC();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteallSC", "");
                return;
            }
        }
    }
}

function deleteAllSC(){
    $sql = "DROP TABLE status_cartea";

    if(mysqli_query($GLOBALS['conStatus'], $sql)){
        TextNodeSC("success","All Record deleted Successfully...!");
        CreatedbStatusCarte();
    }else{
        TextNodeSC("error","Something Went Wrong Record cannot deleted...!");
    }
}











