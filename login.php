<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: indexUser.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nume_cititor = $password = $isadmin= $id_cititor = "";
$nume_cititor_err = $password_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["nume_cititor"]))){
        $nume_cititor_err = "Please complete the fields.";
       
    } else{
        $nume_cititor = trim($_POST["nume_cititor"]);       
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($nume_cititor_err)  && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id_cititor, nume_cititor, password, isadmin FROM Cititorul WHERE nume_cititor = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_nume );
            
            // Set parameters
            $param_nume =   $nume_cititor; 
            //$param_isadmin = $isadmin;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id_cititor, $nume_cititor, $hashed_password, $isadmin);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id_cititor"] = $id_cititor;
                            $_SESSION["nume_cititor"] = $nume_cititor;                            
                            $_SESSION["isadmin"] = $isadmin;
                            // Redirect user to welcome page
                            header("location: indexUser.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
       
        .wrapper{ width: 350px; padding: 20px; margin-left: 30%; margin-top: 26%;}
      
    </style>
    	<link rel="stylesheet" type="text/css" href="css/loginAdmin.css">
</head>
<body>
<div class="container">
    <div class="wrapper">
    <div class="card">
			<div class="card-header">
        <h2 class="text-center" style="color:white;">Login</h2>
        
        <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($nume_cititor_err)) ? 'has-error' : ''; ?>">
                <label style="color:white;">Nume Cititor</label>
                <input type="text" name="nume_cititor" class="form-control" value="<?php echo $nume_cititor; ?>">
                <span class="help-block"><?php echo $nume_cititor_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label style="color:white;">Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login" style="font-size: medium;">
            </div>
            <p style=" font-size: x-large; color:white;"> Don't have an account?  <a href="register.php" style="color: #15f6ff;">Sign up now</a></p>
        </form>
        </div>    
    </div>    
    </div>  
    </div>    
  
</body>
</html> 

 