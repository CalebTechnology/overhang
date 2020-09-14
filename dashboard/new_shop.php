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
        <form class="form-signin" action="new_shop_sql.php" method="post" enctype="multipart/form-data">
          <p style="font-size:1px">&nbsp;</p>
          <h1 class="h3 mb-3 font-weight-normal">Create New Shop:</h1>
          <div class='form-group'>
            <label for="name" class="sr-only">Shop Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Shop Name" required autofocus>
          </div>
          <div class="form-group">
            <label for="image">Exterior Image (optional):</label>
            <input type="file" name="exterior_image" id="exterior_image">
          </div>
          <div class="form-group">
            <label for="image">Interior Image (optional):</label>
            <input type="file" name="interior_image" id="interior_image">
          </div>
          <h4>Shop Icon<a tabindex="0" class="btn btn-sm" role="button" data-toggle="popover" data-trigger="manual" title="Why Do I Have to Choose an Icon?" data-content="Icons allow for consistent thumbnail images when clicking on the Shops and Activities tab in the navigation. <a href='../icon_help.php'>Icon help</a>"><span class='far fa-question-circle'></span></a></h4>
          <div class="form-group">
            <label for="icon_category">Icon Category:</label>
            <div class="form-check form-check-inline">
              <input type="radio" name="icon_category" id="solid" value="fas" class="form-check-input" required><label for="solid" class="form-check-label" default>Solid</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" name="icon_category" id="regular" value="far" class="form-check-input"><label for="regular" class="form-check-label">Regular</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" name="icon_category" id="brand" value="fab" class="form-check-input"><label for="brand" class="form-check-label">Brand</label>
            </div>
            <label for="title" class="sr-only">Icon Code</label>
            <input type="text" name="icon" id="icon" class="form-control" placeholder="Icon Code" required>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
          <br>
        </form>
      </div>
    </main>
    <?php include('footer.php') ?>
  </body>
  <script type="text/javascript">
  $("[data-toggle=popover]")
.popover({ html: true})
  .on("focus", function () {
      $(this).popover("show");
  }).on("focusout", function () {
      var _this = this;
      if (!$(".popover:hover").length) {
          $(this).popover("hide");
      }
      else {
          $('.popover').mouseleave(function() {
              $(_this).popover("hide");
              $(this).off('mouseleave');
          });
      }
  });
  </script>
</html>
