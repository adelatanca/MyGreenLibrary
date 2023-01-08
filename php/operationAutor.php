<?php

require_once ("dbAutor.php");
require_once ("db.php");
require_once ("component.php");

$conAutor = CreatedbAutor();

if(isset($_POST['create'])){
    createDataAutor();
}

if(isset($_POST['update'])){
    UpdateDataAutor();
}

if(isset($_POST['delete'])){
    deleteRecordAutor();
}

if(isset($_POST['deleteall'])){
    deleteAllAutor();

}

if(isset($_POST['select'])){
    getSelectAutor();

}

function createDataAutor(){
    $id_autor = textboxValueAutor("id_autor");
    $nume_autor = textboxValueAutor("nume_autor");
    $prenume_autor = textboxValueAutor("prenume_autor");   
    $gen=textboxValueAutor("gen");

    if($id_autor && $nume_autor && $prenume_autor && $gen  ){

        $sql = "INSERT INTO autorul (id_autor, nume_autor, prenume_autor, gen) 
                        VALUES ('$id_autor','$nume_autor','$prenume_autor', '$gen')";

        if(mysqli_query($GLOBALS['conAutor'], $sql)){
            TextNodeAutor("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }else{
        TextNodeAutor("error", "Provide Data in the Textbox");
    }
}
function textboxValueAutor($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conAutor'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

function TextNodeAutor($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

function getDataAutor(){
    $sql = "SELECT * FROM autorul";

    $result = mysqli_query($GLOBALS['conAutor'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

function getSelectAutor()
{
    $sql = " SELECT c.titlu, 
    a.nume_autor, 
    a.prenume_autor 
    FROM   carte_autor ca 
    JOIN cartea c 
      ON ca.cartea_isbn = c.isbn 
    JOIN autorul a 
      ON ca.autorul_id_autor = a.id_autor 
";  
$result = mysqli_query($GLOBALS['conAutor'], $sql);

if(mysqli_num_rows($result) > 0){
    return $result;
}
}
 

function UpdateDataAutor(){
    $id_autor = textboxValueAutor("id_autor");
    $nume_autor = textboxValueAutor("nume_autor");
    $prenume_autor = textboxValueAutor("prenume_autor");   
    $gen=textboxValueAutor("gen");

    $updateDataAutor = "CREATE
    OR
    replace FUNCTION updatedataautor(id_autor integer, nume_autor varchar(30), prenume_autor varchar(30), gen varchar(30))
     RETURN varchar2
    BEGIN UPDATE autorul
      SET    id_autor='$id_autor',
             nume_autor = '$nume_autor',
             prenume_autor = '$prenume_autor',
             gen='$gen'
      WHERE  id_autor='$id_autor'
      RETURN 'Updated';
      END;
     ";

    if($id_autor && $nume_autor && $prenume_autor  && $gen ){
        $sql = "
                    UPDATE autorul SET id_autor='$id_autor', nume_autor = '$nume_autor', prenume_autor = '$prenume_autor',  gen='$gen'  WHERE id_autor='$id_autor';                    
        ";

        if(mysqli_query($GLOBALS['conAutor'], $sql)){
            TextNodeAutor("success", "Data Successfully Updated");
        }else{
            TextNodeAutor("error", "Enable to Update Data");
        }

    }else{
        TextNodeAutor("error", "Select Data Using Edit Icon");
    }
}



function deleteRecordAutor(){
    $id_autor = (int)textboxValueAutor("id_autor");

    $sql = "DELETE FROM autorul WHERE id_autor=$id_autor";

    if(mysqli_query($GLOBALS['conAutor'], $sql)){
        TextNodeAutor("success","Record Deleted Successfully...!");
    }else{
        TextNodeAutor("error","Enable to Delete Record...!");
    }

}


function deleteBtnAutor(){
    $result = getDataAutor();
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


function deleteAllAutor(){
    $sql = "DROP TABLE autorul";

    $dropAutorul = "CREATE OR REPLACE PROCEDURE dropAutorul(table_name IN VARCHAR2) AS
      BEGIN
        EXECUTE IMMEDIATE 'DROP TABLE ' || table_name;
EXCEPTION
   WHEN OTHERS THEN
      DBMS_OUTPUT.put_line('Error dropping table: ' || SQLERRM);
    END dropAutorul;"

    if(mysqli_query($GLOBALS['conAutor'], $sql)){
        TextNodeAutor("success","All Record deleted Successfully...!");
        CreatedbAutor();
    }else{
        TextNodeAutor("error","Something Went Wrong Record cannot deleted...!");
    }
}







