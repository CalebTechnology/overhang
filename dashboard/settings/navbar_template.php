<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="index.php">Overhang</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../../index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../feed.php">Feed</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../news.php" tabindex="-1">News</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shops and Activities</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="../../shops_activities.php"><span class="fas fa-store"></span> Shops and Activities Home</a>
          <hr>
          <?php
            include('../../includes/connect.php');
            $sql = "SELECT * FROM shops ORDER BY name";
            foreach ($conn->query($sql) as $row) {
              echo "<a class='dropdown-item' href='../../shop.php?id=" . $row['id'] . "'><span class='" . $row['icon_category'] . " fa-" . $row['icon'] . "'></span> " . $row['name'] . "</a>" . PHP_EOL;
            }
          ?>
          <hr>
          <a class='dropdown-item' href="../../activities/lumbo_land.php"><span class="fas fa-golf-ball"></span> Lumbo Land</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Downloads</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="../../downloads/"><span class="fas fa-download"></span> Downloads Home</a>
          <hr>
          <a class="dropdown-item" href="../../downloads/resource_packs.php"><span class="fas fa-image"></span> Resource Packs</a>
          <a class="dropdown-item" href="../../downloads/behavior_packs.php"><span class="fas fa-code"></span> Behavior Packs</a>
          <a class="dropdown-item" href="../../downloads/world_downloads.php"><span class="fas globe-americas"></span> World Downloads</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
          <?php
          if (!isset($_SESSION['loggedin'])) {
            ?>
            <a class="dropdown-item" href="../../login.php"><span class="fas fa-sign-in-alt"></span> Log In</a>
          <?php
          }
          else {
            echo '<p class="dropdown-item disabled" style="color:#16181b"><span class="fas fa-user"></span> ' . $_SESSION['username'] . '</p>';
            ?>
            <a class="dropdown-item" href="../../logout.php"><span class="fas fa-sign-out-alt"></span> Log Out</a>
            <hr>
            <a class="dropdown-item" href="../../dashboard/"><span class="fas fa-list"></span> Dashboard</a>
            <div class="container">
              <a class="dropdown-item" href="../feed_posts.php"><span class="fas fa-newspaper"></span> Feed Posts</a>
              <a class="dropdown-item" href="../shops.php"><span class="fas fa-shopping-cart"></span> Shops</a>
              <a class="dropdown-item disabled" href="" disabled><span class="fas fa-dollar-sign"></span> Advertisements (coming soon)</a>
            </div>
            <hr>
            <p class="dropdown-item disabled" style="color:#16181b"><span class="fas fa-cog"></span> Settings</p>
            <div class="container">
              <a class="dropdown-item" href="change_email.php"><span class="fas fa-at"></span> Change Email</a>
              <a class="dropdown-item" href="change_phone.php"><span class="fas fa-phone-alt"></span> Change Phone Number</a>
            </div>
          <?php
          }
          ?>
        </div>
      </li>
    </ul>
  </div>
</nav>
