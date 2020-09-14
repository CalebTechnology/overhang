<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your one-stop shop for all things Overhang">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="favicon.ico?">
    <title>Overhang Homepage</title>

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
    <?php include "navbar_template.php";?> <!-- Imports the navbar so the same template can be used on all pages -->

    <main role="main">
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Overhang</h1>
          <p>Welcome to the Overhang website! Use the button below to access the "feed" or continue scrolling to access more pages.</p>
          <div class="row">
            <div class="col-md-3">
              <p class="text">IP: mrcraftable.serveminecraft.net</p>
            </div>
            <div class='col-md-3'>
              <p class="text">Port: 19132</p>
            </div>
          </div>
          <p><a class="btn btn-primary btn-lg" href="feed.php" role="button">Feed &raquo;</a></p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>What's New?</h2>
            <p style='margin-bottom:3.5%'>Here's the latest news:</p>
            <?php
               include 'includes/connect.php';
               $sql = "SELECT * FROM news ORDER BY id DESC LIMIT 1";
               foreach ($conn->query($sql) as $row) {
                 $datetime = date_create($row['datetime']);
                 $display_date = date_format($datetime, "M d Y g:i:s A");
                 #echo "<div class='container'>" . PHP_EOL;
                 echo "<h5>" . $row['title'] . "</h5>" . PHP_EOL;
                 echo "<h6>" . $display_date . "</h6>" . PHP_EOL;
                 #echo "<p style='display:-webkit-box; -webkit-box-orient:vertical; -webkit-line-clamp:3; overflow:hidden'>" . $row['article'] . "</p>" . PHP_EOL;
                 $start = substr($row['article'], 0, 120);
                 echo "<p>" . $start . "...</p>" . PHP_EOL;

                 #echo "</div>" . PHP_EOL;
               }
            ?>
            <p><a class="btn btn-secondary" href="news.php" role="button">Read More &raquo;</a></p>
            <br><br>
          </div>
          <div class="col-md-4">
            <h2>Shops</h2>
            <p>Explore the Overhang shopping district in a way like never before! Online shop listings allow you to see what items each shop offers, and the prices for each without having to leave your base (or even logging on to the server!)</p>
            <br><br>
            <p><a class="btn btn-secondary" href="shops.php" role="button">View Shops &raquo;</a></p>
            <br><br>
          </div>
          <div class="col-md-4">
            <h2>Add-ons</h2>
            <p>Add-ons are used by Minecraft for a variety of purposes. Resource packs change the way the game looks, while behavior packs add or change gameplay. Click here to view and download my own add-ons, my ports of Xisumavoid's Vanilla Tweaks to Bedrock edition, as well as links to those by Foxynotail.</p>
            <p><a class="btn btn-secondary" href="downloads.php" role="button">Downloads &raquo;</a></p>
            <br><br><br>
          </div>
        </div>
      </div> <!-- /container -->
    </main>

    <?php include('footer.php') ?>
  </body>
</html>
