<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your one-stop shop for all things Overhang">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="../favicon.ico?">
    <title>Dashboard · Overhang</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
    <link href="../css/jumbotron.css" rel="stylesheet">
  </head>
  <body>
    <?php require('../includes/session.php') ?>
    <?php
      // We need to use sessions, so you should always start sessions using the below code.
      #session_start();
      // If the user is not logged in redirect to the login page...
      if (!isset($_SESSION['loggedin'])) {
      	header('Location: ../login.php');
      	exit;
      }
    ?>

    <?php include "navbar_template.php";?> <!-- Imports the navbar so the same template can be used on all pages -->
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <a class="nav-link active sidebar-heading mt-4 mb-1" href="#">
            <span><span class="fas fa-home"></span> Dashboard</span><!--<span class="sr-only">(current)</span>-->
        </a>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="feed_posts.php">
              <span class="fas fa-newspaper"></span>
              Feed Posts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shops.php">
              <span class="fas fa-shopping-cart"></span>
              Shops
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">
              <span class="fas fa-dollar-sign"></span>
              Advertisements<br>(coming soon)
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span><span class="fas fa-cog"></span> Account Settings</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="settings/change_email.php">
              <span class="fas fa-at"></span>
              Change Email
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="settings/change_phone.php">
              <span class="fas fa-phone-alt"></span>
              Change Phone Number
            </a>
          </li>
        </ul>

        <?php
        include('../includes/connect.php');
        $sql = "SELECT * FROM permissions WHERE username = '" . $_SESSION['username'] . "'";
        $result = $conn->query($sql);
        $row = $result->fetch();
        if($row['admin']==True){
          echo '
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span><span class="fas fa-sliders-h"></span> Admin Settings</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="admin/new_user.php">
              <span class="fas fa-user-plus"></span>
              Add User
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/sudo.php">
              <span class="fas fa-user"></span>
              Access as User
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/news.php">
              <span class="far fa-newspaper"></span>
              Manage News
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/feed.php">
              <span class="fas fa-newspaper"></span>
              Manage Feed
            </a>
          </li>
        </ul><br><br>';
        }
        ?>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
      <div class="container card">
        <h2>Recent Activity:</h2><br>
        <div class='container'>
          <h2>Latest Feed Post:</h2>
          <div class='card'>
            <div class='col'>
            <?php
               include '../includes/connect.php';
               $sql = "SELECT * FROM feed WHERE username = '" . $_SESSION['username'] . "' ORDER BY id DESC LIMIT 1";
               $result = $conn->query($sql);
               $row = $result->fetch();
               if(empty($row)){
                 echo "<div class='container'><h3>You have not posted to the feed.</h3></div>";
               }
               else{
                 $datetime = date_create($row['uploaded']);
                 $display_date = date_format($datetime, "M d Y g:i:s A");
                 echo "<br><h3 class='display-5'>" . $row['title'] . "</h3>" . PHP_EOL;
                 echo "<h6>" . $display_date . "</h6>" . PHP_EOL;
                 if(!is_null($row['image'])){
                   echo "<img src='../" . $row['image'] . "' class='img-fluid'><br>" . PHP_EOL;
                 }
                 if(!is_null($row['comment'])){
                   echo "<p class='lead'>" . $row['comment'] . "</p>" . PHP_EOL;
                 }
               }
            ?>
            <div class="d-flex flex-column">
              <a href="feed_posts.php" class="btn btn-primary"><h4>Manage Your Posts</h4></a><br>
            </div>
          </div>
        </div>
      </div>
        <hr>
        <div class="container">
          <h2>Latest Shop:</h2>
          <div class='card'>
            <div class='col'>
              <?php
                 include '../includes/connect.php';

                 include '../includes/connect.php';
                 $sql = "SELECT * FROM shops WHERE owner = '" . $_SESSION['username'] . "' ORDER BY id DESC LIMIT 1";
                 $result = $conn->query($sql);
                 $row = $result->fetch();
                 if(empty($row)){
                   echo "<div class='container'><h3>You have not created any shops.</h3></div>";
                 }
                 else{
                   echo "<br><h3 class='display-5'>" . $row['name'] . "</h3>" . PHP_EOL;
                   if(!is_null($row['image'])){
                     echo "<img src='../" . $row['image'] . "' class='img-fluid'><br>" . PHP_EOL;
                   }
                 }
              ?>
              <div class="d-flex flex-column">
                <a href="shops.php" class="btn btn-primary"><h4>Manage Your Shops</h4></a><br>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="container">
            <h2>Latest Golf Game:</h2>
            <div class='card'>
              <div class='col'>
                <div class='container'><h3>Golf games are not currently available.</h3></div>
                <div class="d-flex flex-column">
                  <a href="golf_games.php" class="btn btn-primary"><h4>Manage Your Games</h4></a><br>
                </div>
              </div>
            </div>
        </div>
        <hr>
        <div class="container">
            <h2>Latest Advertisement:</h2>
            <div class='card'>
              <div class='col'>
                <div class='container'><h3>Advertisements are not currently available.</h3></div>
                <div class="d-flex flex-column">
                  <a href="ads.php" class="btn btn-primary"><h4>Manage Your Ads</h4></a><br>
                </div>
              </div>
            </div>
        </div>
        <br>
      </div>
      <div class="container card">
        <h2>Settings:</h2><br>
          <div class="container">
            <div class="row">
              <div class="d-flex flex-column">
                <a href="change_username.php" class="btn btn-secondary m-1"><h4>Change Username</h4></a>
                <a href="change_password.php" class="btn btn-secondary m-1"><h4>Change Password</h4></a>
                <a href="change_email.php" class="btn btn-secondary m-1"><h4>Change Email</h4></a>
                <a href="change_phone.php" class="btn btn-secondary m-1"><h4>Change Phone Number</h4></a>
                <a href="change_phone.php" class="btn btn-secondary m-1 invisible" style="max-height:1px"><h4>Change Phone Number</h4></a>
              </div>
          </div>
      </div>
      <br>
    </div>
    <?php
    include('../includes/connect.php');
    $sql = "SELECT * FROM permissions WHERE username = '" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetch();
    if($row['admin']==True){
    echo '<div class="container card">
      <h2>Admin Settings:</h2><br>
      <div class="container">
        <div class="row">
          <div class="d-flex flex-column">
            <a href="admin/new_user.php" class="btn btn-secondary m-1"><h4>Add User</h4></a>
            <a href="admin/sudo.php" class="btn btn-secondary m-1"><h4>Access as User</h4></a>
            <a href="admin/news.php" class="btn btn-secondary m-1"><h4>Manage News</h4></a>
            <a href="admin/feed.php" class="btn btn-secondary m-1"><h4>Manage Feed</h4></a>
            <a href="change_phone.php" class="btn btn-secondary m-1 invisible" style="max-height:1px"><h4>Change Phone Number</h4></a>
          </div>
        </div>
      </div>
      <br>
    </div>';
    }
    ?>
    <br><br><br><br>
    </main>
  </div>
</div>
<?php include('footer.php') ?>
  </body>
</html>
