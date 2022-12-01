<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values

$nume_cititor = $prenume_cititor = $nr_telefon = $email= $password = $confirm_password = "";
$nume_cititor_err = $prenume_cititor_err = $nr_telefon_err = $email_err = $password_err = $confirm_password_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    error_reporting(0);
    // Validate username
    if(empty(trim($_POST["nume_cititor"])) && empty(trim($_POST["prenume_cititor"])) && empty(trim($_POST["nr_telefon"])) && empty(trim($_POST["email"])) ){
        $nume_cititor_err = "Please complete the fields.";
        $prenume_cititor_err ="Please complete the fields.";
        $nr_telefon_err = "Please complete the fields.";
        $email_err = "Please complete the fields.";

    } else{
        // Prepare a select statement
        $sql = "SELECT id_cititor FROM cititorul WHERE nume_cititor =  ? AND prenume_cititor = ? AND nr_telefon = ? AND email = ? ";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssis", $param_nume, $param_prenume,$param_telefon,$param_email);
            
            // Set parameters
            $param_nume = trim($_POST["nume_cititor"]);
            $param_prenume = trim($_POST["prenume_cititor"]);
            $param_telefon = trim($_POST["nr_telefon"]);
            $param_email = trim($_POST["email"]);
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $nume_cititor_err = "This username is already taken.";
                } else{
                    $nume_cititor = trim($_POST["nume_cititor"]);
                    $prenume_cititor =  trim($_POST["prenume_cititor"]);
                    $nr_telefon = trim($_POST["nr_telefon"]);
                    $email =  trim($_POST["email"]);
                    
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($nume_cititor_err) && empty($prenume_cititor_err) && empty($nr_telefon_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO cititorul (nume_cititor,prenume_cititor, nr_telefon, email, password)  VALUES (?, ?, ?, ?, ? )";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiss", $param_nume, $param_prenume,  $param_telefon, $param_email,$param_password);
            
            // Set parameters
            $param_nume =   $nume_cititor; 
            $param_prenume =  $prenume_cititor;
            $param_telefon =  $nr_telefon;
            $param_email =  $email;        
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <style type="text/css">
   
        .wrapper{ width: 350px; padding: 20px; margin-left: 30%; margin-top: 13%;}
      
    </style>
    	<link rel="stylesheet" type="text/css" href="css/loginAdmin.css">
</head>
<body>
<div class="container">
    <div class="wrapper">
    <div class="card" style="height:550px;">
			<div class="card-header">
        <h2 class="text-center" style="color:white;">Sign Up</h2>
        
        <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($nume_cititor_err)) ? 'has-error' : ''; ?>">
                <label class="labelclass" style="color:white;">Nume</label>
                <input type="text" name="nume_cititor" class="form-control" value="<?php echo $nume_cititor; ?>">
                <span class="help-block"><?php echo $nume_cititor_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($prenume_cititor_err)) ? 'has-error' : ''; ?>">
                <label class="labelclass" style="color:white;">Prenume</label>
                <input type="text" name="prenume_cititor" class="form-control" value="<?php echo $prenume_cititor; ?>">
                <span class="help-block"><?php echo $prenume_cititor_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($nr_telefon_err)) ? 'has-error' : ''; ?>">
                <label class="labelclass" style="color:white;">Nr. telefon</label>
                <input type="text" name="nr_telefon" class="form-control" value="<?php echo $nr_telefon; ?>">
                <span class="help-block"><?php echo $nr_telefon_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label class="labelclass" style="color:white;">Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label class="labelclass" style="color:white;">Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label  class="labelclass" style="color:white;"> <p class="labelclass" > Confirm Password </p></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" style="font-size: medium;">
                <input type="reset" class="btn btn-default" value="Reset" style="font-size: medium;">
            </div>
            </div>
            <p style=" font-size:large; color:white;">Already have an account? <a href="login.php" style="color: #15f6ff;">Login here</a>.</p>
        </form>
        </div>
        </div>
        </div> 
        </div>   
 </div>    
</body>
</html>