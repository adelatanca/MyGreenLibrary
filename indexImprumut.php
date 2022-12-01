<?php
require_once ("../BibliotecaTancaAdela/php/component.php");
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
    <title>Imprumutul</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
        <h1 class="py-4 bg-success text-light rounded"><i class="fas fa-book"></i> <a href="http://localhost:8081/BibliotecaTancaAdela/library.php"> My Green Library<a></h1>
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
            <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/library.php">Acasa </i></a>
          </li>
   
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/login.php">
              Login
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/register.php">
              User Sign-up
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/logout.php">
              Logout
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/reset_password.php">
              Reseteaza parola
            </a>
          </li>
          <?php 
          if($_SESSION["isadmin"] == '1' )
          {
            ?>
           <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://localhost:8081/BibliotecaTancaAdela/indexCarte.php"  data-toggle="dropdown">
                            Carti
                            </a>
                            <ul class="dropdown-menu">
                            <li class="nav-item"> <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/indexCarte.php">Carti</a></li>
                                <li class="nav-item"> <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/indexStatusCartea.php">Status_Cartea</a></li>
                                <li class="nav-item"><a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/indexCarteAutor.php">Carte_Autor</a></li>
                            </ul>
                        </li>
        
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/indexAutor.php">
              Autori
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/indexImprumut.php">
              Imprumuturi
            </a>
          </li>
        

          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/indexCititori.php">
            Cititori
            </a>
          </li>
                        <?php 
          }
          ?>
                                <li class="nav-item">   <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/indexUser.php">Fisa bibliotecii</a></li>
                         
        </ul>
      </div>
    </div>
    
  </nav>
        <div class="d-flex justify-content-center">
            <form action="" method="post" class="w-50">
            
                <div class="pt-2">
                    <?php inputElement("<i class='fas fa-calendar'></i>","Data imprumut", "data_imprumut",""); ?>
                </div>
                <div class="pt-2">
                    <?php inputElement("<i class='fas fa-calendar'></i>","Data returnare", "data_returnare",""); ?>
                </div>
                <div class="pt-2">
                    <?php inputElement("<i class='fas fa-calendar'></i>","Data returnarii", "data_returnarii",""); ?>
                </div>              
             
                    <div class="pt-2">
                        <?php inputElement("<i class='fas fa-quote-right'></i>","Status_cartea_nr_carte", "status_cartea_nr_carte",""); ?>
                    </div>                  
            
                <div class="pt-2">
                    <?php inputElement("<i class='fas fa-file-signature'></i>","Cititorul_id_cititor", "cititorul_id_cititor",""); ?>
                </div> 
             <div class="pt-2">
                    <?php inputElement("<i class='fas fa-database'></i>","Cauta Nume Cititor", "sqlSelect",""); ?>
                </div> 
                <div class="d-flex justify-content-center">
                        <?php buttonElement("btn-create","btn btn-success","<i class='fas fa-plus'></i>","create","data-toggle='tooltip' data-placement='bottom' title='Create'"); ?>
                    
                        <?php buttonElement("btn-update","btn btn-light border","<i class='fas fa-pen-alt'></i>","update","data-toggle='tooltip' data-placement='bottom' title='Update'"); ?>
                        <?php buttonElement("btn-delete","btn btn-danger","<i class='fas fa-trash-alt'></i>","delete","data-toggle='tooltip' data-placement='bottom' title='Delete'"); ?>
                       <?php buttonElement("btn-select","btn btn-warning","<i class='fas fa-database'></i>","select","data-toggle='tooltip' data-placement='bottom' title='CautaNumeCititor'"); ?> 
                        <?php deleteBtn();?>
                </div>
            </form>
        </div>
                   <?php 
                        error_reporting(0);
                   ?>
                  <h3 class="center"> Imprumuturi </h3>
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
                        <th>Cititorul_id_cititor</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                   <?php           
                       $result2 = getSelectNume();
                       if($result2){
                           while ($row2 = mysqli_fetch_assoc($result2)){ ?>
                               <tr>                          
                               <td data-id="<?php echo $row2['nume_cititor']; ?>"><?php echo $row2['nume_cititor']; ?></td>
                                   <td data-id="<?php echo $row2['prenume_cititor']; ?>"><?php echo $row2['prenume_cititor']; ?></td>      
                                   <td data-id="<?php echo $row2['data_imprumut']; ?>"><?php echo $row2['data_imprumut']; ?></td>
                                   <td data-id="<?php echo $row2['data_imprumut']; ?>"><?php echo $row2['data_returnare']; ?></td>
                                   <td data-id="<?php echo $row2['data_imprumut']; ?>"><?php echo $row2['data_returnarii']; ?></td>                                  
                                   <td data-id="<?php echo $row2['data_imprumut']; ?>"><?php echo $row2['status_cartea_nr_carte']; ?></td>
                                   <td data-id="<?php echo $row2['data_imprumut']; ?>"><?php echo $row2['id_cititor']; ?></td>
                                   <td ><i class="fas fa-edit btnedit" data-id="<?php echo $row2['data_imprumut']; ?>"></i></td>
                               </tr>
                   <?php
                           }
                       }             
                   ?>
                </tbody>
            </table>
        </div>
    </div>
  
</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="../BibliotecaTancaAdela/php/imprumutul.js"></script>
</body>
</html>