<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Food Ordering System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if (isset($_SESSION['logged'])) { ?>
        <li class="nav-item">
          <a class="nav-link" href="../auth/signout.php">Sign Out</a>
        </li>
      <?php } else { ?>
            <li class="nav-item">
              <a href="../auth/signup.php" class="nav-link">Sign Up</a>
            </li>
              <li class="nav-item">  
              <a href="../auth/signin.php" class="nav-link">Sign In</a>
            </li>
          <?php } ?>
    </ul>
  </div>
</nav>