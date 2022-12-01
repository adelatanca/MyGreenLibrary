<?php

require_once ("dbImprumut.php");
require_once ("component.php");

$con = CreatedbImpr();


if(isset($_POST['create'])){
    createDataImprumut();
}

if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}

if(isset($_POST['deleteall'])){
    deleteAll();

}
if(isset($_POST['select'])){
    getSelectNume('Cmeci');

}  

function createDataImprumut(){
    $data_imprumut = textboxValue("data_imprumut");
    $data_returnare = textboxValue("data_returnare");
    $data_returnarii = textboxValue("data_returnarii");   
    $status_cartea_nr_carte=textboxValue("status_cartea_nr_carte");
    $cititorul_id_cititor=textboxValue("cititorul_id_cititor");

    if($data_imprumut && $data_returnare  && $status_cartea_nr_carte &&  $cititorul_id_cititor ){

        $sql = "INSERT INTO imprumutul (data_imprumut, data_returnare, data_returnarii, status_cartea_nr_carte, cititorul_id_cititor ) 
                        VALUES ('$data_imprumut','$data_returnare',null, '$status_cartea_nr_carte', '$cititorul_id_cititor')";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Record Successfully Inserted...!");
        }else{
            echo "Error la imprumut";
        }

    }else{
            TextNode("error", "Provide Data in the Textbox");
    }
}


function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

function getData(){
    $sql = " SELECT nume_cititor, 
    prenume_cititor, 
    data_imprumut, 
    data_returnare, 
    data_returnarii, 
    status_cartea_nr_carte, 
    id_cititor 
    FROM   cititorul 
    JOIN imprumutul 
      ON id_cititor = cititorul_id_cititor";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}


function UpdateData(){
    $data_imprumut = textboxValue("data_imprumut");
    $data_returnare = textboxValue("data_returnare");
    $data_returnarii = textboxValue("data_returnarii");   
    $status_cartea_nr_carte=textboxValue("status_cartea_nr_carte");
    $cititorul_id_cititor=textboxValue("cititorul_id_cititor");


    if($data_imprumut && $data_returnare && $data_returnarii  && $status_cartea_nr_carte &&  $cititorul_id_cititor ){
        $sql = "
                    UPDATE imprumutul SET data_imprumut='$data_imprumut', data_returnare = '$data_returnare', data_returnarii = '$data_returnarii',  status_cartea_nr_carte='$status_cartea_nr_carte', cititorul_id_cititor='$cititorul_id_cititor'  WHERE data_imprumut='$data_imprumut';                    
        ";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }
}


function deleteRecord(){
    $status_cartea_nr_carte = textboxValue("status_cartea_nr_carte");

    $sql = "DELETE FROM imprumutul WHERE status_cartea_nr_carte=$status_cartea_nr_carte";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }else{
        TextNode("error","Enable to Delete Record...!");
    }

}


function deleteBtn(){
    $result = getData();
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

function deleteAll(){
    $sql = "DROP TABLE imprumutul";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","All Record deleted Successfully...!");
        CreatedbImpr();
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}


function getNrExemplareDisponibile($isbn)
{
    $sql= " SELECT titlu, 
    Count(disponibilitate)  AS 'exemplareDisp'
    FROM   status_cartea sc 
    JOIN cartea c 
    ON sc.cartea_isbn = c.isbn 
    WHERE  disponibilitate = 1 AND isbn=$isbn
    GROUP  BY titlu; ";
    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

function getSelectNume()
{
   $numecititor=textboxValue("sqlSelect");
   $sql = "SELECT nume_cititor, 
   prenume_cititor, 
   data_imprumut, 
   data_returnare, 
   data_returnarii, 
   status_cartea_nr_carte, 
   id_cititor 
   FROM   cititorul 
   JOIN imprumutul 
     ON id_cititor = cititorul_id_cititor
     WHERE nume_cititor='$numecititor'";
   $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}
