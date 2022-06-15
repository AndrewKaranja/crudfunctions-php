<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age'],
      "location"  => $_POST['location']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "users",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );
    
    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php
  
  // Include db config
  require_once '../db.php';

  // Validate login
  if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: login.php');
    exit;
  }
?>
<?php include "templates/dashboardnav.php"; ?>
<div class="card card-body bg-light ">

  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['firstname']); ?> successfully added.</blockquote>
  <?php endif; ?>

  
  <h2>Add a user</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <div class="form-group">
  <label for="firstname">First Name</label><br>
  <input type="text" name="firstname" id="firstname">
  </div>
  <div class="form-group">
  <label for="lastname">Last Name</label><br>
  <input type="text" name="lastname" id="lastname">
  </div>
  <div class="form-group">
  <label for="email">Email Address</label><br>
  <input type="text" name="email" id="email">
  </div>
  <div class="form-group">
  <label for="age">Age</label><br>
  <input type="text" name="age" id="age">
  </div>
  <div class="form-group">
  <label for="location">Location</label><br>
  <input type="text" name="location" id="location">
  </div>
  <input type="submit" name="submit" value="Submit">
</form>

<a href="dashboard.php">Back to Dashboard</a>

  </div>

  

<?php require "templates/footer.php"; ?>
