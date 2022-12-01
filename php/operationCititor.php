<?php

require_once ("dbCititor.php");
require_once ("component.php");

$conCititor = CreatedbCititor();

if(isset($_POST['create'])){
    createDataCititor();
}

if(isset($_POST['update'])){
    UpdateDataCititor();
}

if(isset($_POST['delete'])){
    deleteRecordCititor();
}

if(isset($_POST['deleteall'])){
    deleteAllCititor();

}

if(isset($_POST['select'])){
    getSelect();

}
if(isset($_POST['selectBooks'])){
    getBooksById(0);

}

function createDataCititor(){
    $id_cititor = textboxValueCititor("id_cititor");
    $nume_cititor = textboxValueCititor("nume_cititor");
    $prenume_cititor = textboxValueCititor("prenume_cititor");   
    $nr_telefon=textboxValueCititor("nr_telefon");
    $email=textboxValueCititor("email");

    if($id_cititor && $nume_cititor && $prenume_cititor && $nr_telefon && $email ){

        $sql = "INSERT INTO cititorul (id_cititor, nume_cititor, prenume_cititor, nr_telefon,email) 
                        VALUES ('$id_cititor','$nume_cititor','$prenume_cititor', '$nr_telefon', '$email')";

        if(mysqli_query($GLOBALS['conCititor'], $sql)){
            TextNodeCititor("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }else{
        TextNodeCititor("error", "Provide Data in the Textbox");
    }
}
function textboxValueCititor($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conCititor'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

function TextNodeCititor($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

function getDataCititor(){
    $sql = "SELECT * FROM cititorul";

    $result = mysqli_query($GLOBALS['conCititor'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

function getSelect()
{
    $sql = " SELECT nume_cititor, 
    prenume_cititor, 
    data_imprumut, 
    data_returnare, 
    data_returnarii, 
    status_cartea_nr_carte, 
    id_cititor 
    FROM   cititorul 
    JOIN imprumutul 
      ON id_cititor = cititorul_id_cititor;
   
";  
$result = mysqli_query($GLOBALS['conCititor'], $sql);

if(mysqli_num_rows($result) > 0){
    return $result;
}
 
}

function getBooksById($id_cititor)
{
    $sql = " SELECT nume_cititor, 
    prenume_cititor, 
    data_imprumut, 
    data_returnare, 
    data_returnarii, 
    status_cartea_nr_carte, 
    id_cititor 
    FROM   cititorul 
    JOIN imprumutul 
      ON id_cititor = cititorul_id_cititor
      WHERE id_cititor=$id_cititor; 
";  
$result = mysqli_query($GLOBALS['conCititor'], $sql);

if(mysqli_num_rows($result) > 0){
    return $result;
}
 
}

function UpdateDataCititor(){
    $id_cititor = textboxValueCititor("id_cititor");
    $nume_cititor = textboxValueCititor("nume_cititor");
    $prenume_cititor = textboxValueCititor("prenume_cititor");   
    $nr_telefon=textboxValueCititor("nr_telefon");
    $email=textboxValueCititor("email");

    if($id_cititor && $nume_cititor && $prenume_cititor  && $nr_telefon && $email ){
        $sql = "
                    UPDATE cititorul SET id_cititor='$id_cititor', nume_cititor = '$nume_cititor', prenume_cititor = '$prenume_cititor',  nr_telefon='$nr_telefon', email='$email'  WHERE id_cititor='$id_cititor';                    
        ";

        if(mysqli_query($GLOBALS['conCititor'], $sql)){
            TextNodeCititor("success", "Data Successfully Updated");
        }else{
            TextNodeCititor("error", "Enable to Update Data");
        }

    }else{
        TextNodeCititor("error", "Select Data Using Edit Icon");
    }
}



function deleteRecordCititor(){
    $id_cititor = (int)textboxValueCititor("id_cititor");

    $sql = "DELETE FROM cititorul WHERE id_cititor=$id_cititor";

    if(mysqli_query($GLOBALS['conCititor'], $sql)){
        TextNodeCititor("success","Record Deleted Successfully...!");
    }else{
        TextNodeCititor("error","Enable to Delete Record...!");
    }

}


function deleteBtnCititor(){
    $result = getDataCititor();
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


function deleteAllCititor(){
    $sql = "DROP TABLE cititorul";

    if(mysqli_query($GLOBALS['conCititor'], $sql)){
        TextNodeCititor("success","All Record deleted Successfully...!");
        CreatedbCititor();
    }else{
        TextNodeCititor("error","Something Went Wrong Record cannot deleted...!");
    }
}








