<nav class="navbar navbar-expand-lg nb_custom">
        <div class="container-fluid">
          <a class="navbar-brand title_font" href="hompage.php">YumNet</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="hompage.php">Home</a>
              </li>
              <?php if(isset($_SESSION['user_id'])){
              echo "<li class='nav-item'>
                <a class='nav-link' href='addPost.php'>Add Post</a>
              </li>";
              }
              ?>
              <li class="nav-item">
                <a class="nav-link" href="store.php">Store</a>
              </li>
              <?php if(isset($_SESSION['user_id'])){
              echo "<li class='nav-item'>
                <a class='nav-link' href='searchMessages.php'>Message</a>
              </li>";
              }
              ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php session_start(); echo"profile.php?user_id= $_SESSION[user_id]";?>"><?php echo "$_SESSION[first_name]";?></a>
              </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <?php
              if(isset($_SESSION['admin_id'])){
                echo "<li class='nav-item'>
                <a class='nav-link' href='admin_panel.php'>Admin Page</a>
              </li>";
              }
              if(isset($_SESSION['user_id'])){
                echo "<li class='nav-item'>
                <a class='nav-link' href='cart.php'>Your Cart</a>
              </li>";
              }
              ?>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out       </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>