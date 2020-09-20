<?php require('../includes/session.php') ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your one-stop shop for all things Overhang">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="../favicon.ico?">
    <title>Your Feed Posts - Overhang - <?php echo $_SESSION['username']?></title>

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
              <h3>Your Posts:</h3>
            </div>
            <div class="col">
              <a href='new_post.php'><button type="button" name="button" class="btn btn-lg btn-primary btn-block">New Post</button></a>
            </div>
          </div>
          <br>
          <?php
             include '../includes/connect.php';
             $sql = "SELECT * FROM feed WHERE username = '" . $_SESSION['username'] . "' ORDER BY id DESC";
             foreach ($conn->query($sql) as $row) {
               $datetime = date_create($row['uploaded']);
               $display_date = date_format($datetime, "M d Y g:i:s A");
               echo "<div class='card container col-10'><p></p>";
               echo "<h4>" . $row['title'] . "</h4>" . PHP_EOL;
               echo "<h6>" . $display_date;
               if($row['edited'] == true){
                 echo " (edited)";
               }
               echo "</h6>" . PHP_EOL;
               echo "<div class='container'><img class='img-fluid' format='float:right; height:auto' src='../" . $row['image'] . "'></div>" . PHP_EOL;
               if(!is_null($row['comment'])){
                 echo "<p>" . $row['comment'] . "</p>" . PHP_EOL;
               }
               echo "<div>
                   <ul class='nav nav-pills flex-column'>
                     <ul class='nav nav-pills flex-row'>
                       <li class='nav-item'>
                         <a class='confirmation' href='delete_post_sql.php?id=" . $row['id'] . "'><button class='nav-link' type='button'>Delete Post</button></a>
                       </li>
                       <li class='nav-item'>
                         <a href='edit_post.php?id=" . $row['id'] . "'><button class='nav-link' type='button'>Edit Post</button></a>
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
        <br><p>No older posts found</p><br>
        <br><br>
      </div>
    </main>
    <?php include('footer.php') ?>
    <script type="text/javascript">
      $('.confirmation').on('click', function() {
        return confirm('Are you sure you want to delete this feed post? This cannot be undone');
      });
    </script>
  </body>
</html>
