<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Your one-stop shop for all things Overhang">
  <meta name="author" content="MrCraftable">
  <link rel="shortcut icon" href="favicon.ico?">
  <?php
  include('includes/connect.php');
  require('includes/session.php');
  $sql = "SELECT * FROM shops WHERE id = " . $_GET['id'];
  $result = $conn->query($sql);
  $row = $result->fetch();
  if(empty($row)){
    echo "<title>Error</title></head><body><div class='container'><h3>Sorry, the shop with the specified id does not exist.</h3></div>";
  }
  else{
    echo "<title>" . $row['name'] . " · Overhang</title>" . PHP_EOL;
  }
  ?>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

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
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="css/jumbotron.css" rel="stylesheet">
</head>
  <body>
    <?php include('navbar_template.php') ?>
    <main>
      <br>
      <div class="container">
        <h3>Products:</h3>
        <div class="container">
          <?php
            include('includes/connect.php');

            $sql = "SELECT * FROM shops WHERE id = " . $_GET['id'];
            $result = $conn->query($sql);
            $row = $result->fetch();
            $shop_owner = $row['owner'];
            if($_SESSION['username'] == $shop_owner){
              echo '<a href="dashboard/new_product.php?id=' . $_GET['id'] . '"><button type="button" name="button" class="btn btn-lg btn-primary btn-block">New Product</button></a><br>' . PHP_EOL;
              echo "<div style='display:grid; grid-template-columns: 1fr 1fr 1fr'>" . PHP_EOL;
            } else{
            echo "<div style='display:grid; grid-template-columns: 1fr 1fr'>" . PHP_EOL;
            }
            ?>
                <div class='col-xs border-right'>
                  <h3>&nbsp;Product</h3>
                </div>
                <div class='col-xs'>
                  <h3>&nbsp;Price</h3>
                </div>
                <?php
                if($_SESSION['username'] == $shop_owner){
                  echo '<div class="col-xs border-left"><h3>&nbsp;Manage</h3></div>' . PHP_EOL;
                }
                ?>
          <?php
            include('includes/shops_connect.php');
            $sql = "SELECT * FROM `" . $row['name'] . "` ORDER BY `product_name`";
            foreach ($conn->query($sql) as $row) {

              echo "<div class='col border-right border-top'>" . PHP_EOL;
              echo "<br><h5>" . $row['product_name'] . PHP_EOL;
              if(!is_null($row['image'])){
                echo "<img src='" . $row['image'] . "' class='img-fluid' style='max-width:100px'>";
              }
              echo "</h5></div>" . PHP_EOL;

              echo "<div class='col border-top'>" . PHP_EOL;
              echo "<br><h5>" . $row['price'] . "</h5>" . PHP_EOL;
              echo "</div>" . PHP_EOL;

              if($_SESSION['username'] == $shop_owner){
                echo "<div class='d-flex flex-column border-left border-top'><br>" . PHP_EOL;
                echo "<a class='btn btn-secondary m-1' href='dashboard/edit_product.php?shop_id=" . $_GET['id'] . "&product_id=" . $row['id'] . "'>Edit Listing</a>" . PHP_EOL;
                echo "<a class='btn btn-secondary m-1' href='dashboard/delete_product_sql.php?shop_id=" . $_GET['id'] . "&product_id=" . $row['id'] . "'>Delete Listing</a>" . PHP_EOL;
                echo "</div>" . PHP_EOL;
              }

            }
           ?>
         </div>
       </div>
     </div>
     <br><br>
    </main>
    <?php include('footer.php') ?>
  </body>
</html>
