<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your one-stop shop for all things Overhang">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="favicon.ico?">
    <title>News - Overhang</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

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
    <link href="css/jumbotron.css" rel="stylesheet">
  </head>
  <body>
    <?php require('includes/session.php') ?>
    <?php include('navbar_template.php') ?>
    <main>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-5">Latest News</h1>
          <hr class="lineDotted">
          <?php
             include 'includes/connect.php';
             $sql = "SELECT * FROM news ORDER BY id DESC LIMIT 1";
             foreach ($conn->query($sql) as $row) {
               $datetime = date_create($row['datetime']);
               $display_date = date_format($datetime, "M d Y g:i:s A");
               echo "<div class='container'>" . PHP_EOL;
               echo "<h3 class='display-5'>" . $row['title'] . "</h3>" . PHP_EOL;
               echo "<h6>" . $display_date . "</h6>" . PHP_EOL;
               echo "<p class='lead'>" . $row['article'] . "</p>" . PHP_EOL;
               echo "</div>" . PHP_EOL;
             }
          ?>
        </div>
      </div>
      <!--Old News-->
      <div class="container">
        <h3>Past news:</h3>
        <div class="container">
          <?php
             include 'includes/connect.php';
             $sql = "SELECT * FROM news WHERE id < (SELECT MAX(id) FROM news)";
             foreach ($conn->query($sql) as $row) {
               $datetime = date_create($row['datetime']);
               $display_date = date_format($datetime, "M d Y g:i:s A");
               echo "<div class='card container'><p></p>";
               echo "<h4>" . $row['title'] . "</h4>" . PHP_EOL;
               echo "<h6>" . $display_date . "</h6>" . PHP_EOL;
               echo "<p>" . $row['article'] . "</p>" . PHP_EOL;
               echo "<ul class='nav nav-pills flex-column'><li class='nav-item'><a class='nav-link'href='#'>Back to Top</a></li></ul>" . PHP_EOL;
               echo "</div>" . PHP_EOL;
             }
          ?>
        <br><p>No older posts found</p><br>
        <br><br>
      </div>
    </main>
    <?php include('footer.php') ?>
  </body>
</html>
