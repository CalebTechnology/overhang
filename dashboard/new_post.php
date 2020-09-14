<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your one-stop shop for all things Overhang">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="../favicon.ico?">
    <title>Create Post - Overhang - <?php echo $_SESSION['username']?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

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
    <?php include('navbar_template.php') ?>
    <main>
      <br>
      <div class="container card">
        <form class="form-signin" action="new_post_sql.php" method="post" enctype="multipart/form-data">
          <p style="font-size:1px">&nbsp;</p>
          <h1 class="h3 mb-3 font-weight-normal">Create Feed Post:</h1>
          <div class='form-group'>
            <label for="title" class="sr-only">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Title" required autofocus>
          </div>
          <div class="form-group">
            <label for="image">Upload Image:</label>
            <input type="file" name="image" id="image" required>
          </div>
          <div class="form-group">
            <textarea name="comment" id="comment" rows="8" class="form-control" placeholder="Comment/Caption"></textarea>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
          <br>
        </form>
      </div>
    </main>
    <?php include('footer.php') ?>
  </body>
</html>
