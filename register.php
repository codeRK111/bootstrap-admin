

<?php include('config/db.php'); ?>
<?php 


 $password = $confirm_password = $name = $email = $phonenumber = "";
 $password_err = $confirm_password_err = $name_err = $email_err = $phonenumber_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";     
    }  else{
        $email = trim($_POST["email"]);
    }
    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";     
    }  else{
        $name = trim($_POST["name"]);
    }

    // Validate number
    if(empty(trim($_POST["phonenumber"]))){
        $phonenumber_err = "Please enter a phonenumber.";     
    }  else{
        $phonenumber = trim($_POST["phonenumber"]);
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
    if( empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($phonenumber_err) && empty($name_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (name,email, password,role,number) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi",$param_name, $param_email, $param_password,$param_role,$param_phonenumber);
            
            // Set parameters
            $param_email = $email;
            $param_name = $name;
            $param_phonenumber = $phonenumber;
            $param_role = 'user';
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
    mysqli_close($conn);
}
?>





<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
               
                <div class="form-group">
                  <input type="text" name='name' class="form-control form-control-user" id="exampleInputEmail" placeholder="Name"  value="<?php echo $name; ?>">
                  <span class="help-block"><?php echo $name_err; ?></span>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" value="<?php echo $email; ?>">
                  <span class="help-block"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Password" value="<?php echo $password; ?>">
                  <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                  <input type="password" name="confirm_password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Confirm password"  value="<?php echo $confirm_password; ?>">
                  <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                  <input type="number" name="phonenumber"  class="form-control form-control-user" id="exampleInputEmail" placeholder="Number" value="<?php echo $phonenumber; ?>">
                  <span class="help-block"><?php echo $phonenumber_err; ?></span>
                </div>
               </div>
                <div class="form-group text-center">
                        <input type="submit" class="btn btn-primary" value="Submit">
                </div>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
