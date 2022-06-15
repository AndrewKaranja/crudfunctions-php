<?php
  // Include db config
  require_once '../db.php';
  require "../config.php";
  require "../common.php";

  // Init vars
  $fname = $lname = $email = $age = $location = $passw = $confirm_passw = '';
  $fname_err = $lname_err = $email_err =$age_err =$location_err =  $passw_err = $confirm_passw_err = '';

  // Process form when post submit
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $connection = new PDO($dsn, $username, $password, $options);
    
    // Sanitize POST
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // Put post vars in regular vars
    $fname = trim($_POST['fname']);
    $lname =  trim($_POST['lname']);
    $email = trim($_POST['email']);
    $age = trim($_POST['age']);
    $location = trim($_POST['location']);
    $passw = $_POST['password'];
    $confirm_passw = $_POST['confirm_password'];

    // Validate email
    if(empty($email)){
      $email_err = 'Please enter email';
    } else {
      // Prepare a select statement
      $sql = 'SELECT id FROM admins WHERE email = :email';
      
      if($stmt = $connection->prepare($sql)){
        // Bind variables
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Attempt to execute
        if($stmt->execute()){
          // Check if email exists
          if($stmt->rowCount() === 1){
            $email_err = 'Email is already taken';
          }
        } else {
          die('1:Something went wrong');
        }
      }

      unset($stmt);
    }

    // Validate name
    if(empty($lname)){
      $lname_err = 'Please enter name';
    }

    if(empty($fname)){
        $fname_err = 'Please enter fname';
      }

      if(empty($age)){
        $age_err = 'Please enter age';
      }

      if(empty($location)){
        $location_err = 'Please enter location';
      }
  
  

    // Validate passw
    if(empty($passw)){
      $passw_err = 'Please enter password';
    } elseif(strlen($passw) < 6){
      $passw_err = 'passw must be at least 6 characters ';
    }

    // Validate Confirm passw
    if(empty($confirm_passw)){
      $confirm_passw_err = 'Please confirm passwprd';
    } else {
      if($passw !== $confirm_passw){
        $confirm_passw_err = 'passws do not match';
      }
    }

    // Make sure errors are empty
    if(empty($age_err) && empty($fname_err) && empty($lname_err) && empty($email_err) && empty($location_err) && empty($passw_err) && empty($confirm_passw_err)){
      // Hash passw
      $passw = password_hash($passw, PASSWORD_DEFAULT);

      // Prepare insert query
      $sql = 'INSERT INTO admins (firstname, lastname, email, password, age, location) VALUES (:fname, :lname, :email, :passw, :age, :location)';

      if($stmt = $connection->prepare($sql)){
        // Bind params
        $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_STR);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->bindParam(':passw', $passw, PDO::PARAM_STR);

        // Attempt to execute
        if($stmt->execute()){
          // Redirect to login
          header('location: login.php');
        } else {
          die('2:Something went wrong');
        }
      }
      unset($stmt);
    }

    // Close connection
    unset($connection);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <title>Register An Account</title>
</head>
<body class="bg-primary">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
          <h2>Create Account</h2>
          <p>Fill in this form to register</p>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            
            <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" name="fname" id="fname"  class="form-control form-control-lg <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>">
              <span class="invalid-feedback"><?php echo $fname_err; ?></span>
            </div>
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" name="lname" id="lname"  class="form-control form-control-lg <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>">
              <span class="invalid-feedback"><?php echo $lname_err; ?></span>
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
              <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
              <label for="age">Age</label>
              <input type="text" name="age" id="age"  class="form-control form-control-lg <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $age; ?>">
              <span class="invalid-feedback"><?php echo $age_err; ?></span>
            </div>
            <div class="form-group">
              <label for="location">Location</label>
              <input type="text" name="location" id="location"  class="form-control form-control-lg <?php echo (!empty($location_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $location; ?>">
              <span class="invalid-feedback"><?php echo $location_err; ?></span>
            </div>
            <div class="form-group">
              <label for="password">password</label>
              <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($passw_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $passw; ?>">
              <span class="invalid-feedback"><?php echo $passw_err; ?></span>
            </div>
            <div class="form-group">
              <label for="confirm_password">Confirm password</label>
              <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($confirm_passw_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_passw; ?>">
              <span class="invalid-feedback"><?php echo $confirm_passw_err; ?></span>
            </div>

            <div class="form-row">
              <div class="col">
                <input type="submit" value="Register" class="btn btn-success btn-block">
              </div>
              <div class="col">
                <a href="login.php" class="btn btn-light btn-block">Have an account? Login</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>