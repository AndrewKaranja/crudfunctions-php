<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Simple CRUD Functions App</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<link rel="stylesheet" href="css/dashboard.css?v=<?php echo time(); ?>">
</head>

<body >
<header id="header" class="header">
  <nav class="nav">
    <ul class="nav-list">
      <li class="nav-item">
        <a href="dashboard.php" class="nav-link">
          <i class="fas fa-home icon"></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="create.php" class="nav-link">
          <i class="fas fa-address-book icon"></i>
          <span class="text">Create User</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="read.php" class="nav-link">
          <i class="fas fa-comments icon"></i>
          <span class="text">Search User</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="update.php" class="nav-link">
          <i class="fas fa-comments icon"></i>
          <span class="text">Update User</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="delete.php" class="nav-link">
          <i class="fas fa-comments icon"></i>
          <span class="text">Delete User</span>
        </a>
      </li>
  
      <li class="nav-item">
        <a href="logout.php" class="nav-link">
          <i class="fas fa-sign-out-alt icon"></i>
          <span class="text">Sign out</span>
        </a>
      </li>
    </ul>
  </nav>
  
</header>