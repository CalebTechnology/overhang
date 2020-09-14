<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your one-stop shop for all things Overhang">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="../../favicon.ico?">
    <title>Edit Post - Overhang - <?php echo $_SESSION['username']?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
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
    <link href="../../css/jumbotron.css" rel="stylesheet">
  </head>
  <body>
    <?php require('../../includes/session.php') ?>
    <?php
      // We need to use sessions, so you should always start sessions using the below code.
      #session_start();
      // If the user is not logged in redirect to the login page...
      if (!isset($_SESSION['loggedin'])) {
      	header('Location: ../../login.php');
      	exit;
      }
    ?>
    <?php include('navbar_template.php') ?>
    <main>
      <br>
      <div class="container card">
        <?php
        include '../../includes/connect.php';
        $sql = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'";
        foreach ($conn->query($sql) as $row) {
        }
        if(empty($row)){
          echo "<br><div class='container'><h5>Error: Either feed post does not exist or does not match currently logged in user. Please try again, or log in with the correct account.</h5></div>";
        }
        ?>
        <form class="form-signin" action="change_phone_sql.php" method="post">
          <p style="font-size:1px">&nbsp;</p>
          <h1 class="h3 mb-3 font-weight-normal">Edit Phone Number:</h1>
          <div class='form-group'>
            <label for="phone_number" class="sr-only">Phone Number</label>
            <?php echo '<input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" pattern="[0-9]{10}" required autofocus value="' . $row['phone_number'] . '">'; ?>
            <label for="phone_number"><div class="container">Must be in the format 1234567890 with no spaces or other symbols</div></label>
          </div>
          <div class="form-group">
            <label class="sr-only" for="carrier">Phone Carrier</label>
              <select class="form-control" id="carrier" name="carrier" required>
                <option value="">Phone Carrier</option>
                <?php
                //Read in file
                $file = fopen('../../files/phone_carriers.txt','r') or die('Cannot open file');
                include '../../includes/connect.php';
                $sql = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'";
                foreach ($conn->query($sql) as $row) {
                }
                while (!feof($file)) {
                  $line = fgets($file);
                  echo "<option " . PHP_EOL;
                  if(trim($line) == trim($row['carrier'])){
                    echo " selected " . PHP_EOL;
                  }
                  echo "value=\"" . trim($line) . "\">" . trim($line) . "</option>" . PHP_EOL;
                  if(trim($line) == trim($row['carrier'])){
                    echo "value=\"" . trim($line) . "\">" . trim($line) . "h</option>" . PHP_EOL;
                  }
                }
                ?>
              </select>
          </div>
          <?php echo '<input type="hidden" name="id" value=' . $row['id'] . '>' ?>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
          <br>
        </form>
      </div>
    </main>
    <?php include('footer.php') ?>
  </body>
</html>
