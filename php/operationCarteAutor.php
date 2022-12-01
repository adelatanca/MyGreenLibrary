<?php

require_once ("dbCarteAutor.php");
require_once ("component.php");

$conCA=CreatedbCA();

if(isset($_POST['createCA'])){
    createDataCA();
}

if(isset($_POST['updateCA'])){
    UpdateDataCA();
}

if(isset($_POST['deleteCA'])){
    deleteRecordCA();
}

if(isset($_POST['deleteallCA'])){
    deleteAllCA();

}

if(isset($_POST['selectCA'])){
    getSelect();

}

function createDataCA(){
    $id = textboxValueCA("id");
    $cartea_isbn = textboxValueCA("cartea_isbn");
    $autorul_id_autor = textboxValueCA("autorul_id_autor");  
  

    if($id && $cartea_isbn && $autorul_id_autor  ){

        $sql = "INSERT INTO carte_autor (id, cartea_isbn, autorul_id_autor ) 
                        VALUES ('$id','$cartea_isbn','$autorul_id_autor')";

        if(mysqli_query($GLOBALS['conCA'], $sql)){
            TextNodeCA("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }else{
            TextNodeCA("error", "Provide Data in the Textbox");
    }
}


function textboxValueCA($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conCA'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

function TextNodeCA($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

function getDataCA(){
    $sql = "SELECT * FROM carte_autor";

    $result = mysqli_query($GLOBALS['conCA'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

function getSelectCA()
{
   $sql = textboxValueCA("sqlSelect");
   $result2 = mysqli_query($GLOBALS['conCA'], $sql);

    if(mysqli_num_rows($result2) > 0){
        return $result2;
    }
}

function UpdateDataCA(){
    $id = textboxValueCA("id");
    $cartea_isbn = textboxValueCA("cartea_isbn");
    $autorul_id_autor = textboxValueCA("autorul_id_autor");
  
    if($id && $cartea_isbn && $autorul_id_autor  ){
        $sql = "
                    UPDATE carte_autor SET id='$id', cartea_isbn = '$cartea_isbn', autorul_id_autor = '$autorul_id_autor' WHERE id='$id';                    
        ";

        if(mysqli_query($GLOBALS['conCA'], $sql)){
            TextNodeCA("success", "Data Successfully Updated carte_autor");
        }else{
            TextNodeCA("error", "Enable to Update Data");
        }

    }else{
        TextNodeCA("error", "Select Data Using Edit Icon");
    }
}


function deleteRecordCA(){
    $id = (int)textboxValueCA("id");

    $sql = "DELETE FROM carte_autor WHERE id=$id";

    if(mysqli_query($GLOBALS['conCA'], $sql)){
        TextNodeCA("success","Record Deleted Successfully...! carte_autor");
    }else{
        TextNodeCA("error","Enable to Delete Record...!");
    }

}


function deleteBtnCA(){
    $result = getDataCA();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteallCA", "");
                return;
            }
        }
    }
}

function deleteAllCA(){
    $sql = "DROP TABLE carte_autor";

    if(mysqli_query($GLOBALS['conCA'], $sql)){
        TextNodeCA("success","All Record deleted Successfully...!");
        CreatedbCA();
    }else{
        TextNodeCA("error","Something Went Wrong Record cannot deleted...!");
    }
}











