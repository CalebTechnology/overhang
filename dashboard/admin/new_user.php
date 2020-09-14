<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your one-stop shop for all things Overhang">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="../favicon.ico?">
    <title>Add User - Overhang - <?php echo $_SESSION['username']?></title>

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
      include('../../includes/connect.php');
      $sql = "SELECT * FROM permissions WHERE username = '" . $_SESSION['username'] . "'";
      $result = $conn->query($sql);
      $row = $result->fetch();
      if($row['admin']!=True){
        header('Location: ../');
      }
    ?>
    <?php include('navbar_template.php') ?>
    <main>
      <br>
      <div class="container card">
        <form class="form-signin" action="new_user_sql.php" method="post" enctype="multipart/form-data">
          <p style="font-size:1px">&nbsp;</p>
          <h1 class="h3 mb-3 font-weight-normal">Add User:</h1>
          <div class='form-group'>
            <label for="username" class="sr-only">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
          </div>
          <div class='form-group'>
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          </div>
          <div class='form-group'>
            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
          </div>
          <div class='form-group'>
            <label for="phone_number" class="sr-only">Phone Number</label>
            <input type="tel" name="phone_number" id="phone_number" class="form-control bfh-phone" placeholder="Phone Number" pattern="[0-9]{10}" required autofocus>
            <label for="phone_number"><div class="container">Must be in the format 1234567890 with no spaces or other symbols</div></label>
          </div>
          <div class="form-group">
            <label class="sr-only" for="carrier">Phone Carrier</label>
              <select class="form-control" id="carrier" name="carrier" required>
                <option value="">Phone Carrier</option>
                <?php
                //Read in file
                $file = fopen('../../files/phone_carriers.txt','r') or die('Cannot open file');
                while (!feof($file)) {
                  $line = fgets($file);
                  echo "<option value=\"" . trim($line) . "\">" . trim($line) . "</option>" . PHP_EOL;
                }
                ?>
              </select>
          </div>
          <div class="form-group">
            <p>Permissions</p>
            <div class="checkbox">
              <label><input type="checkbox" name="permissions[]" value="admin"> Admin</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" name="permissions[]" value="lumbo_land"> Lumbo Land</label>
            </div>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
          <br>
        </form>
      </div>
      <br><br><br><br>
    </main>
    <?php include('footer.php') ?>
  </body>
</html>
