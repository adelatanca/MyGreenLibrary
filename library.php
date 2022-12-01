<?php
require_once ("../BibliotecaTancaAdela/php/component.php");
require_once ("../BibliotecaTancaAdela/php/operationCititor.php");
require_once ("../BibliotecaTancaAdela/php/operationImprumut.php");
require_once ("../BibliotecaTancaAdela/php/operationAutor.php");
require_once ("../BibliotecaTancaAdela/php/operationCarte.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="css/css.css">
  <link rel="stylesheet" href="css/cssLibrary.css">
  <title>My Green Library</title>



</head>
<style>   
.nav-link{ 
    font-size: revert;
    font-weight:bold;
   
}

</style>
<body>

  <nav class="navbar sticky-top navbar-expand-lg bg-white navbar-light shadow-sm " style="margin-top:0px;">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img class="logo img-fluid" src="images/logo.jpg" alt="" title="">

      </a>

      <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse"
        data-target="#collapsibleNavbar">
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
            <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/reset_password.php">
              Reseteaza parola
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="http://localhost:8081/BibliotecaTancaAdela/logout.php">
              Logout
            </a>
          </li>
        </ul>
      </div>
    </div>

  </nav>




  <div class="hero-banner" data-ride="carousel" data-pause="hover" data-interval="false">
    <div class="hero-img">
      <img src="images/readingroom2.jpg" class="img-responsive" alt="" />
    </div>
    <div class="container">
      <div class="row">
        <div class="col col-md-6 col-sm-8">
          <div class="content">
            <h1>My Green Library</h1>
            <br />
            <p>
              My Green Library este concepută pentru a satisface nevoile comunității de cercetare din întreaga lume, portalul nostru online oferă acces rapid și ușor la toate colecțiile.
            </p>
            <br />

            <p>
              Biblioteca conține de la înregistrări de catalog la cărți cu text integral, reviste, jurnale și înregistrări audio.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="theme-bg call-to-act-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="call-to-act">
            <div class="call-to-act-head">
              <h3>Tanca Adela Maria</h3>
              <span>Library Management</span>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>



  <div class="container">
          <div class="row">

            <div class="col-sm-12 col-lg-4">
                
                <div class="card card-post mt-4 mb-2">

                    <div class="card-body" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px; padding:2.25rem">
                    <img class="card-img img-fluid image-post" src="images/michelle.JPG" alt=""  style="height: 239px;">
                    <?php

$result = getNrExemplareDisponibile(5);

if($result===NULL){

?>
  <p class="card-text"><small style="color:red;margin-left:30%;"> Stoc indisponibil<?php echo $row['exemplareDisp']; ?>  </small></p>


    <?php
} 
else 
{
  while ($row = mysqli_fetch_assoc($result)){ ?>
    <p class="card-text"><small class="text-muted">Exemplare disponibile:  <?php echo $row['exemplareDisp']; ?></small></p>
    
    
        <?php
    } 
    }
    ?>
                                  
                </div>
              </div>
            </div>
            
            <div class="col-sm-12 col-lg-4">
                
                <div class="card card-post mt-4 mb-2">
                    <div class="card-body" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px; padding:2.25rem">
                    <img class="card-img img-fluid image-post" src="images/amintiri.png" alt=""  style="height: 239px;">
           
                    <?php

$result = getNrExemplareDisponibile(4);

if($result===NULL){

?>
  <p class="card-text"><small style="color:red;margin-left:30%;"> Stoc indisponibil<?php echo $row['exemplareDisp']; ?>  </small></p>


    <?php
} 
else 
{
  while ($row = mysqli_fetch_assoc($result)){ ?>
    <p class="card-text"><small class="text-muted">Exemplare disponibile:  <?php echo $row['exemplareDisp']; ?></small></p>
    
    
        <?php
    } 
    }
    ?>
                </div>
              </div>
            </div>

             <div class="col-sm-12 col-lg-4">

                <div class="card card-post mt-4 mb-4">

                    <div class="card-body" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px; padding:2.25rem">

                    <img class="card-img img-fluid image-post" src="images/ion.jpg" alt=""  style="height: 239px;">
                    
                    <?php

$result = getNrExemplareDisponibile(1);

if($result===NULL){

?>
  <p class="card-text"><small style="color:red;margin-left:30%;"> Stoc indisponibil<?php echo $row['exemplareDisp']; ?>  </small></p>


    <?php
} 
else 
{
  while ($row = mysqli_fetch_assoc($result)){ ?>
    <p class="card-text"><small class="text-muted">Exemplare disponibile:  <?php echo $row['exemplareDisp']; ?></small></p>
    
        <?php
    } 
    }
    ?>
                    
                </div>
            </div>
         </div>
      </div>
      <div class="row">

<div class="col-sm-12 col-lg-4">
    
    <div class="card card-post mt-4 mb-2">

        <div class="card-body" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px; padding:2.25rem">
        <img class="card-img img-fluid image-post" src="images/morometii.JPG" alt=""  style="height: 239px;">
        <?php

$result = getNrExemplareDisponibile(2);

if($result===NULL){

?>
  <p class="card-text"><small style="color:red;margin-left:30%;"> Stoc indisponibil<?php echo $row['exemplareDisp']; ?>  </small></p>


    <?php
} 
else 
{
  while ($row = mysqli_fetch_assoc($result)){ ?>
    <p class="card-text"><small class="text-muted">Exemplare disponibile:  <?php echo $row['exemplareDisp']; ?></small></p>
    
    
        <?php
    } 
    }
    ?>
    
            
    </div>
  </div>
</div>



<div class="col-sm-12 col-lg-4">
    
    <div class="card card-post mt-4 mb-2">
        <div class="card-body" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px; padding:2.25rem">
        <img class="card-img img-fluid image-post" src="images/iarna.png" alt=""  style="height: 239px;">

        <?php

$result = getNrExemplareDisponibile(3);

if($result===NULL){

?>
  <p class="card-text"><small style="color:red;margin-left:30%;"> Stoc indisponibil<?php echo $row['exemplareDisp']; ?>  </small></p>


    <?php
} 
else 
{
  while ($row = mysqli_fetch_assoc($result)){ ?>
    <p class="card-text"><small class="text-muted">Exemplare disponibile:  <?php echo $row['exemplareDisp']; ?></small></p>
    
    
        <?php
    } 
    }
    ?>

     
      
    </div>
  </div>
</div>

 <div class="col-sm-12 col-lg-4">

    <div class="card card-post mt-4 mb-4">

        <div class="card-body" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px; padding:2.25rem">

        <img class="card-img img-fluid image-post" src="images/barack.jpg" alt="" style="height: 239px;">

        <?php

$result = getNrExemplareDisponibile(6);

if($result===NULL){

?>
  <p class="card-text"><small style="color:red;margin-left:30%;"> Stoc indisponibil<?php echo $row['exemplareDisp']; ?>  </small></p>


    <?php
} 
else 
{
  while ($row = mysqli_fetch_assoc($result)){ ?>
    <p class="card-text"><small class="text-muted">Exemplare disponibile:  <?php echo $row['exemplareDisp']; ?></small></p>
    
    
        <?php
    } 
    }
    ?>
       
         
    </div>
</div>
</div>
</div>
</div>
<h3 style="margin-left:48%;"> Autori </h3>
        <div class="d-flex table-data">
            <table class="table table-striped table-light">
                <thead class="thead-dark">
                    <tr>                       
                        <th>Id autor</th>
                        <th>Nume autor</th>
                        <th>Prenume autor</th>                       
                        <th>Gen autor</th>
                      
                    </tr>
                </thead>
                <tbody id="tbody">
                   <?php

          
                       $result = getDataAutor();

                       if($result){

                           while ($row = mysqli_fetch_assoc($result)){ ?>
                               <tr>                                
                                   <td data-id="<?php echo $row['id_autor']; ?>"><?php echo $row['id_autor']; ?></td>
                                   <td data-id="<?php echo $row['id_autor']; ?>"><?php echo $row['nume_autor']; ?></td>
                                   <td data-id="<?php echo $row['id_autor']; ?>"><?php echo $row['prenume_autor']; ?></td>                                  
                                   <td data-id="<?php echo $row['id_autor']; ?>"><?php echo $row['gen']; ?></td>
                                  
                                 
                               </tr>

                   <?php
                           }

                       }
              

                   ?>
                </tbody>
            </table>
        </div>
    
        <h3 style="margin-left:48%;"> Carti </h3>
        <div class="d-flex table-data">
            <table class="table table-striped table-light">
                <thead class="thead-dark">
                    <tr>                       
                        <th>ISBN</th>
                        <th>Titlu</th>
                        <th>Editura</th>                       
                        <th>Nr exemplare</th>
                        <th>Categoria</th>
                     
                    </tr>
                </thead>
                <tbody id="tbody">
                   <?php

                
                       $result = getDataCartea();

                       if($result){

                           while ($row = mysqli_fetch_assoc($result)){ ?>
                               <tr>                                
                                   <td data-id="<?php echo $row['isbn']; ?>"><?php echo $row['isbn']; ?></td>
                                   <td data-id="<?php echo $row['isbn']; ?>"><?php echo $row['titlu']; ?></td>
                                   <td data-id="<?php echo $row['isbn']; ?>"><?php echo $row['editura']; ?></td>                                  
                                   <td data-id="<?php echo $row['isbn']; ?>"><?php echo $row['nr_exemplare']; ?></td>
                                   <td data-id="<?php echo $row['isbn']; ?>"><?php echo $row['categorie']; ?></td>
                                  
                               </tr>

                   <?php
                           }

                       }
                 

                   ?>
                </tbody>
            </table>
        </div>

        
        <h3 style="margin-left:46%;"> Carti & Autori </h3>
        <div class="d-flex table-data">
            <table class="table table-striped table-light">
                <thead class="thead-dark">
                    <tr>                       
                        <th>Titlu</th>
                        <th>Nume autor </th>
                        <th>Prenume autor</th>                                                           
                    </tr>
                </thead>
                <tbody id="tbody">
                   <?php

                       $result = getSelectAutor();

                       if($result){

                           while ($row = mysqli_fetch_assoc($result)){ ?>
                               <tr>                                
                                   <td data-id="<?php echo $row['Titlu']; ?>"><?php echo $row['titlu']; ?></td>
                                   <td data-id="<?php echo $row['nume_autor']; ?>"><?php echo $row['nume_autor']; ?></td>
                                   <td data-id="<?php echo $row['prenume_autor']; ?>"><?php echo $row['prenume_autor']; ?></td>                                  
                                 
                                  
                               </tr>

                   <?php
                           }

                       }
          

                   ?>
                </tbody>
            </table>
        </div>
                   <?php 
                        error_reporting(0);
                   ?>    

    </div>
  

  <footer class="page-footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-md-6 col-sm-12">
            <h5 class="head mt-4 mb-0">Despre noi</h5>
            <hr class="footer-title mb-3" />

            <p class="despre-noi">
              My Green Library prima biblioteca exclusiv online unde utilizatorii pot citi sau imprumuta carti, articole
              sau reviste din intreaga lume. De asemenea pot fi adaugate, editate sau sterse cartile in urma verificarii
              acestora.
            </p>

            <img class="img-fluid" id="footer-logo" src="images\logo.jpg" width="220" height="130" alt="alternatetext" />
          </div>

          <div class="col-xl-3 col-md-6 col-sm-12">
            <h5 class="head mt-4 mb-0">Ultimele stiri</h5>
            <hr class="footer-title mb-3" />

            <ul class="footer-stiri list-unstyled">
              <li>
                <i class="fas fa-rss"></i>
                <a href="#!">Biblioteca "My Green Library" a câștigat o finanțare în programul Fondul pentru un viitor
                  mai bun în comunități.</a>
              </li>
              <br />
              <li>
                <i class="fas fa-rss"></i>
                <a href="#!">Astăzi, 9 septembrie 2022, a avut loc deschiderea unei filiale a Bibliotecii "My Green
                  Library" Bihor, destinată publicului din Episcopia Bihor.</a>
              </li>
              <br />

            </ul>
          </div>

          <div class="col-xl-3 col-md-6 col-sm-12">
            <h5 class="head mt-4 mb-0">Noutati</h5>
            <hr class="footer-title mb-3" />

            <ul class="footer-noutati list-unstyled">
              <li>
                <i class="fas fa-angle-right"></i>
                <a href="#!">Carti</a>
              </li>

              <li>
                <i class="fas fa-angle-right"></i>
                <a href="#!">Autori</a>
              </li>

              <li>
                <i class="fas fa-angle-right"></i>
                <a href="#!">Despre imprumuturi</a>

              </li>

            </ul>
          </div>

          <div class="col-xl-3 col-md-6 col-sm-12">
            <h5 class="head mt-4 mb-0">Contact</h5>
            <hr class="footer-title mb-3" />

            <ul class="footer-contact list-unstyled">
              <li>
                <i class="element1 fas fa-home"></i>
                <p class="element2">Strada Republicii nr.3-5</p>
              </li>
              <li>
                <i class="element1 fas fa-phone"></i>
                <a class="element2" href="#">0259476165</a>
              </li>
              <li>
                <i class="element1 fas fa-envelope"></i>
                <a class="element2" href="#">mygreenlibrary@yahoo.com</a>
              </li>
              <li>
                <i class="element1 fab fa-facebook-square"></i>
                <a class="element2" href="#">MyGreenLibrary</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        <div class="row">
          <p class="mx-auto p-3 mt-2">&copy; My Green Library 2022 </p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>