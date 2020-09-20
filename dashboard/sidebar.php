<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="sidebar-sticky pt-3">
    <a class="nav-link active sidebar-heading mt-4 mb-1" href="#">
        <span><span class="fas fa-home"></span> Dashboard</span><!--<span class="sr-only">(current)</span>-->
    </a>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="feed_posts.php">
          <span class="fas fa-newspaper"></span>
          Feed Posts
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="shops.php">
          <span class="fas fa-shopping-cart"></span>
          Shops
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">
          <span class="fas fa-dollar-sign"></span>
          Advertisements<br>(coming soon)
        </a>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span><span class="fas fa-cog"></span> Account Settings</span>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="settings/change_email.php">
          <span class="fas fa-at"></span>
          Change Email
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="settings/change_phone.php">
          <span class="fas fa-phone-alt"></span>
          Change Phone Number
        </a>
      </li>
    </ul>

    <?php
    include('../includes/connect.php');
    $sql = "SELECT * FROM permissions WHERE username = '" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetch();
    if($row['admin']==True){
      echo '
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span><span class="fas fa-sliders-h"></span> Admin Settings</span>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="admin/new_user.php">
          <span class="fas fa-user-plus"></span>
          Add User
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin/sudo.php">
          <span class="fas fa-user"></span>
          Access as User
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin/news.php">
          <span class="far fa-newspaper"></span>
          Manage News
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin/feed.php">
          <span class="fas fa-newspaper"></span>
          Manage Feed
        </a>
      </li>
    </ul><br><br>';
    }
    ?>
  </div>
</nav>
