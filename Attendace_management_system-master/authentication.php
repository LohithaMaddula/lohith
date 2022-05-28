<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashbord.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username,password FROM Logindata WHERE ";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: dashbord.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
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
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/authentication.css" />
    <title>Welcome</title>
  </head>
  <body>
    <div class="container mt-5">
      <div class="mb-4 fasten-tag">
        <span class="h1 fast multicolortext">Login or Register</span>
      </div>
      <div class="row justify-content-center ">
        <div class="col-4 card shadow-2-strong  shadow-lg p-3 mb-5 bg-white circle">
          <h1 class="h3 mt-3 mb-3 font-weight-normal text-center">
            Sign in
          </h1>
          <form id="loginForm" action="../dashbord.php" method="post" class="signpage">
          <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
          </form>
        </div>
        <div class="col-1 or text-center">OR</div>
        <div class="col-6 card shadow-2-strong shadow-lg p-3 mb-5 bg-white circle">
          <h1 class="h3 text-center">Sign Up</h1>
          <form
            id="registrationForm"
            method="post"
            class="needs-validation signup"
            action="../php/registration.php"
          >
            <div class="card-body">
              
              <div class="input-group mb-3">
                <div class="form-floating">
                  <input
                    type="text"
                    class="form-control"
                    name="fname"
                    id="fname"
                    placeholder="First Name"
                  />
                  <label for="floatingInput">First Name</label>
                  <div class="invalid-feedback change">
                    Only characters are allowed
                  </div>
                </div>
                <div class="form-floating">
                  <input
                    type="text"
                    class="form-control"
                    name="lname"
                    id="lname"
                    placeholder="Last Name"
                  />
                  <label for="floatingInput">Last Name</label>
                  <div class="invalid-feedback">
                    Only characters are allowed
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <div class="form-floating">
                  <input
                    type="text"
                    name="uname"
                    id="uname"
                    class="form-control"
                    placeholder="Username"
                  />
                  <label for="uname">Username</label>
                  <div class="invalid-feedback">
                    Username should contain atleast 8 characters
                  </div>
                </div>
                <div class="form-floating">
                  <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    placeholder="Email"
                  />
                  <label for="email">Email</label>
                  <div class="invalid-feedback">Enter a valid email</div>
                </div>
      </div>
              <div class="input-group mb-3">
                <div class="form-floating">
                  <input
                    type="password"
                    name="pass"
                    id="pass"
                    class="form-control"
                    placeholder="password"
                  />
                  <label for="pass">Password</label>
                  <div class="invalid-feedback">
                    Username should contain atleast 8 characters
                  </div>
                </div>
                <div class="form-floating">
                  <input
                    type="password"
                    name="cnfrmpass"
                    id="cnfrmpass"
                    class="form-control"
                    placeholder="Confirm Password"
                  />
                  <label for="cnfrmpass">Confirm Password</label>
                  <div class="invalid-feedback">Passwords doesn't match</div>
                </div>
              </div>
              <div class="mt-3">
                <button class="btn btn-primary">Sign Up</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
