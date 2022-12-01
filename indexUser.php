<?php
require_once ("../BibliotecaTancaAdela/php/component.php");
require_once ("../BibliotecaTancaAdela/php/operationCititor.php");
require_once ("../BibliotecaTancaAdela/php/operationImprumut.php");

?>

<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carti</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

  
    <link rel="stylesheet" href="css/css.css">

</head>
<style>   
.nav-link{ 
    font-size: revert;
    font-weight:bold;
   
}
</style>
<body >

<main >
 
    <div class="container text-center">
        <h1 class="py-4 bg-success text-light rounded"><i class="fas fa-book"></i> <a href="http://localhost:81/BibliotecaTancaAdela/library.php"> My Green Library<a></h1>

        <nav class="navbar sticky-top navbar-expand-lg bg-white navbar-light shadow-sm  " >
    <div class="container">
      <a class="navbar-brand" href="#">
        <img class="logo img-fluid" src="Interfata/img/logo.jpg" alt="" title="">

      </a>

      <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse"
        data-target="#collapsibleNavbar" >
        <span class="navbar-toggler-icon"> </i></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/library.php">Acasa </i></a>
          </li>
        
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/login.php">
              Login
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/register.php">
              User Sign-up
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/logout.php">
              Logout
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/reset_password.php">
              Reseteaza parola
            </a>
          </li>
          <?php 
          if($_SESSION["isadmin"] == '1' )
          {
            ?>
           <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://localhost:81/BibliotecaTancaAdela/indexCarte.php"  data-toggle="dropdown">
                            Carti
                            </a>
                            <ul class="dropdown-menu">
                            <li class="nav-item"> <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/indexCarte.php">Carti</a></li>
                                <li class="nav-item"> <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/indexStatusCartea.php">Status_Cartea</a></li>
                                <li class="nav-item"><a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/indexCarteAutor.php">Carte_Autor</a></li>
                            </ul>
                        </li>
        
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/indexAutor.php">
              Autori
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/indexImprumut.php">
              Imprumuturi
            </a>
          </li>
        

          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/indexCititori.php">
            Cititori
            </a>
          </li>
        
                        <?php 
          }
          ?>
    
                                <li class="nav-item">   <a class="nav-link" href="http://localhost:81/BibliotecaTancaAdela/indexUser.php">Fisa bibliotecii</a></li>
                        
        </ul>
      </div>
    </div>
   
  </nav>

  <div class="d-flex justify-content-center">
            <form action="" method="post" class="w-50">
                <div class="d-flex justify-content-center">                       
                   <h4>Afiseaza cartile imprumutate   <?php buttonElement("btn-read","btn btn-primary","<i class='fas fa-sync'></i>","selectBooks","data-toggle='tooltip' data-placement='bottom' title='Read'"); ?> </h4> 
                </div>
            </form>
        </div>
        <div class="d-flex table-data">
            <table class="table table-striped table-light">
                <thead class="thead-dark">
                    <tr>                       
                        <th>Nume cititor </th>
                        <th>Prenume cititor</th>
                        <th>Data imprumut</th>                       
                        <th>Data returnare</th> 
                        <th>Data returnarii</th> 
                        <th>Status_cartea_nr_carte</th> 
                        <th>Id cititor</th> 
                    </tr>
                </thead>
                <tbody id="tbody">
                   <?php

                   if(isset($_POST['selectBooks'])){
                       $result = getBooksById($_SESSION["id_cititor"]);

                       if($result){

                           while ($row = mysqli_fetch_assoc($result)){ ?>
                               <tr>                                
                                   <td data-id="<?php echo $row['nume_cititor']; ?>"><?php echo $row['nume_cititor']; ?></td>
                                   <td data-id="<?php echo $row['prenume_cititor']; ?>"><?php echo $row['prenume_cititor']; ?></td>
                                   <td data-id="<?php echo $row['data_imprumut']; ?>"><?php echo $row['data_imprumut']; ?></td>                                  
                                   <td data-id="<?php echo $row['data_returnare']; ?>"><?php echo $row['data_returnare']; ?></td>
                                   <td data-id="<?php echo $row['data_returnarii']; ?>"><?php echo $row['data_returnarii']; ?></td>
                                   <td data-id="<?php echo $row['status_cartea_nr_carte']; ?>"><?php echo $row['status_cartea_nr_carte']; ?></td>
                                   <td data-id="<?php echo $row['id_cititor']; ?>"><?php echo $row['id_cititor']; ?></td>
                                 
                               </tr>

                   <?php
                           }

                       }
                   }

                   ?>
                </tbody>
            </table>
        </div>
  
</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>