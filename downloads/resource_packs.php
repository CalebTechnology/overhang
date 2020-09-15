<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your one-stop shop for all things Overhang">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="../favicon.ico?">
    <title>Resource Packs - Overhang</title>

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
    <?php include('navbar_template.php')?>
    <main>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Resource Packs</h1>
          <p>Here is the page to download resource packs for personal use! Some are ports (direct or indirect) of the Java Edition <a href="https://www.vanillatweaks.net" target="_blank">Vanilla Tweaks</a>' Resource Packs, while others are my own creations!</p>
          <p>For resoure packs, there is only the mcpack download (because it's just 1 pack, no behaviors bundled with it)</p>
          <h5>Filter Packs: (coming soon)</h5>
            <a class="btn btn-primary btn-lg" href="?tag=behavior_tweaks" role="button">Behavior Pack Variants</a>
            <a class="btn btn-primary btn-lg" href="?tag=vanilla_tweaks" role="button">Vanilla Tweaks Ports</a>
            <a class="btn btn-primary btn-lg" href="?tag=creative" role="button">Creative Mode Packs</a>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col">
            <h1>All Resource Packs:</h1>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <?php
               include '../includes/resource_connect.php';
               $sql = "SELECT * FROM packs ORDER BY pack_name";
               foreach ($conn->query($sql) as $row) {
                 $updated = date_create($row['updated']);
                 $display_date = date_format($updated, "M d Y");
                 echo "<div class='container'>" . PHP_EOL;
                 echo "<h3 class='display-5'>" . $row['pack_name'] . "</h3>" . PHP_EOL;
                 echo "<p>Tags: (coming soon)</p>" . PHP_EOL;
                 echo "<h6>Version: " . $row['version'] . "&emsp;Updated: " . $display_date . "</h6>" . PHP_EOL;
                 echo "<p>Image coming soon</p>" . PHP_EOL;
                 echo "<p class='lead'>" . $row['description'] . "</p>" . PHP_EOL;
                 echo"<a class='btn btn-primary btn-lg' href='resource_pack/" . $row['mcpack'] . "' role='button' download>Download Mcpack</a>" . PHP_EOL;
                 echo "<hr></div>" . PHP_EOL;
               }
            ?>
          </div>
        </div>
      </div>
      <br><br><br><br>
    </main>
    <?php include('footer.php') ?>
  </body>
</html>
