<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="favicon.ico?">
    <title>Login · Overhang</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body>
    <?php
      require('includes/session.php');
      include('navbar_template.php');
    ?>
    <br><br><br><br>
    <main>
    <div class="container">
      <form class="form-signin justify-content-center form-horizontal" action="includes/authenticate.php" method="post" role="form" align="center">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <div class="form-group">
          <label for="username" class="sr-only">Username</label>
          <input type="text" id="username" class="form-control" placeholder="Username" required autofocus name="username" autocomplete>
        </div>
        <div class="form-group">
          <label for="password" class="sr-only">Password</label>
          <input type="password" id="password" class="form-control" placeholder="Password" required name="password" autocomplete>
        </div>
        <div class="form-group">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </div>
        <p class="mt-5 mb-3 text-muted">No account? Just ask me, and I'll make you one!</p>
      </form>
    </div>
  </main>
  <?php include('footer.php') ?>

  </body>
</html>
