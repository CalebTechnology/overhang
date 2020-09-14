<?php require('../includes/session.php') ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your one-stop shop for all things Overhang">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="../favicon.ico?">
    <title>Shops - Overhang - <?php echo $_SESSION['username']?></title>

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
  </head>
  <body>
    <?php include('navbar_template.php') ?>
    <main>
      <div class="container">
        <div class='col-12'>
        <div class="container">
          <br><br><br><br>
          <div class="row container">
            <div class="col">
              <h3>Your Shops:</h3>
            </div>
            <div class="col">
              <a href='new_shop.php'><button type="button" name="button" class="btn btn-lg btn-primary btn-block">New Shop</button></a>
            </div>
          </div>
          <br>
          <?php
             include '../includes/connect.php';
             $sql = "SELECT * FROM shops WHERE owner = '" . $_SESSION['username'] . "' ORDER BY name";
             foreach ($conn->query($sql) as $row) {
               echo "<div class='card container col-10'><p></p>";
               echo "<h4>" . $row['name'] . "</h4>" . PHP_EOL;
               echo "</h6>" . PHP_EOL;
               if(!is_null($row['exterior_image'])){
                 echo "<img class='img-fluid' format='float:right; height:auto' src='../" . $row['exterior_image'] . "'>" . PHP_EOL;
               }
               if(!is_null($row['interior_image'])){
                 echo "<img class='img-fluid' format='float:right; height:auto' src='../" . $row['interior_image'] . "'>" . PHP_EOL;
               }
               echo "<div><br>
                   <ul class='nav nav-pills flex-column'>
                     <ul class='nav nav-pills flex-row'>
                     <li class='nav-item'>
                       <a href='../shop.php?id=" . $row['id'] . "'><button class='nav-link' type='button'>Manage Shop</button></a>
                     </li>
                       <li class='nav-item'>
                         <a href='delete_shop_sql.php?id=" . $row['id'] . "'><button class='nav-link' type='button'>Delete Shop</button></a>
                       </li>
                     </ul>
                   </li>
                     <li>
                       <p>&nbsp;</p>
                     </li>
                     <li class='nav-item'>
                       <a class='nav-link'href='#'>Back to Top</a>
                     </li>
                   </ul>
                 </div>
               </div>";
             }
          ?>
        <br><br><br>
        <br><br>
      </div>
    </main>
    <?php include('footer.php') ?>
    <script type="text/javascript">
      $('.confirmation').on('click', function() {
        return confirm('Are you sure you want to delete this shop? This cannot be undone');
      });
    </script>
  </body>
</html>
