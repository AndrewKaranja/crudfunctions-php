<?php include "templates/dashboardnav.php"; ?>
<?php
  // Init session
  session_start();

  // Include db config
  require_once '../db.php';

  // Validate login
  if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: login.php');
    exit;
  }
?>
        <div class="card card-body bg-light mt-5">
          <h2>Admin Account:<small class="text-muted"><?php echo $_SESSION['email']; ?></small></h2>
          <p>Hello <?php echo $_SESSION['name']; ?> This app allows you to:</p>
		  <ul>
	<li><a href="create.php"><strong>Create</strong></a> - add a user</li>
	<li><a href="read.php"><strong>Read</strong></a> - find a user</li>
	<li><a href="update.php"><strong>Update</strong></a> - edit a user</li>
	<li><a href="delete.php"><strong>Delete</strong></a> - delete a user</li>
</ul>
          <p><a href="logout.php" class="btn btn-danger">Logout</a></p>
        </div>


<?php include "templates/footer.php"; ?>