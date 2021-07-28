<?php
session_start();
if (!isset($_SESSION['rid'])) {
  header(('location:index.php'));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ration Shop</title>
  <link rel="stylesheet" href="services.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    .services-section {
      padding: 50px 0;
    }

    li {
      padding: 10px 40px 10px 0;
    }
  </style>
</head>

<body>
  <?php
  include 'config.php';
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">NavaBharat Ration Store &trade;</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="stock.php">Stock</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="distribute.php">Distribution</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Customer actions
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="cinfo.php">Customer info</a>
            <a class="dropdown-item" href="cupdate.php">Customer updation</a>
            <a class="dropdown-item" href="cdelete.php">Customer deletion</a>
            <a class="dropdown-item" href="cregister.php">New Customer registration</a>
          </div>
        </li>
        <li class=" nav-item">
          <a class="nav-link btn btn-outline-danger" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>

  </nav>

  <div class="services-section">
    <div class="inner-width">
      <h1 class="section-title">Our Services</h1>
      <div class="border"></div>
      <div class="services-container">

        <div class="service-box">
          <a class="text-decoration-none" href="cinfo.php">
            <div class="service-icon">
              <i class="fas fa-user"></i>
            </div>
            <div class="service-title">Customer Portal</div>
          </a>
          <div class="service-desc">
            ~Display customer info<br>
            ~Customer updation, deletion or registration
          </div>
        </div>

        <div class="service-box">
          <a class="text-decoration-none" href="stock.php">
            <div class="service-icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="service-title">Grain Stock</div>
          </a>
          <div class="service-desc">
            ~Display item details<br>
            ~Item details insertion, updation or deletion
          </div>
        </div>

        <div class="service-box">
          <a class="text-decoration-none" href="distribute.php">
            <div class="service-icon">
              <i class="fab fa-shopify"></i>
            </div>
            <div class="service-title">Ration distribution</div>
          </a>
          <div class="service-desc">
            ~Customer ration distribution<br>
            ~Item pricing based on customer category
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="page-footer font-small blue">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3" style="background-color: white; position:relative; left:0; bottom:0; width:100%;">
      © 2020-21 Copyright: NavaBharat Ration Store &trade;, Mangalore.
    </div>
    <!-- Copyright -->

  </footer>
</body>

</html>