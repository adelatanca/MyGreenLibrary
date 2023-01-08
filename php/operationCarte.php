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
    // RETURN cartea%ROWTYPE 
    // AS BEGIN INSERT INTO cartea(....)

    $createDataCartea = "CREATE
    OR
    replace FUNCTION createdatacartea (isbn integer NOT NULL PRIMARY KEY, titlu varchar (20), editura varchar (50), nr_exemplare float, categorie varchar(50))
    RETURN TABLE (isbn integer, titlu varchar (20), editura varchar (50), nr_exemplare float, categorie varchar(50))
     AS 
    BEGIN 
        INSERT INTO cartea
                  (
                              isbn,
                              titlu,
                              editura,
                              nr_exemplare,
                              categorie
                  )
                  VALUES
                  (
                              '$isbn',
                              '$titlu',
                              '$editura',
                              '$nrex',
                              '$categorie'
                  )RETURN
      (
             SELECT *
             FROM   cartea
      );
      EXCEPTION
    WHEN others THEN
      raise_application_error(-20001,'An error was encountered - '||sqlcode||' -ERROR- '||sqlerrm);END";

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

    $selectFromCartea ="CREATE OR REPLACE PROCEDURE get_books AS
    CURSOR c_books IS
      SELECT * FROM Cartea;
    BEGIN
      FOR book_rec IN c_books LOOP
        DBMS_OUTPUT.PUT_LINE('ISBN: ' || book_rec.isbn || ', Title: ' || book_rec.titlu);
      END LOOP;
    EXCEPTION
      WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('No books found!');
    END;";

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
