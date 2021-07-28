<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ration Shop</title>
  <link rel="stylesheet" href="login.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    li {
      padding: 10px 40px 10px 0;
    }
  </style>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</head>

<body>

  <?php

include 'config.php';

  if (isset($_POST['login'])) {
    $rid = $_POST['rid'];
    $rpass = $_POST['rpass'];

    $ridsearch = "select * from retailer where rid='$rid'";
    $query = mysqli_query($con, $ridsearch);
    $rid_count = mysqli_num_rows($query);

    if ($rid_count) {
      $rid_row = mysqli_fetch_assoc($query);

      $_SESSION['rid'] = $rid_row['rid'];

      $dbpass = $rid_row['rpass'];

      if ($dbpass == $rpass) {
  ?>
        <script>
          alert("Login successful");
          location.replace("services.php");
        </script>
      <?php
      } else {
      ?>
        <script>
          alert("Incorrect Password");
        </script>
      <?php
        session_destroy();
      }
    } else {
      ?>
      <script>
        alert("Invalid Id");
      </script>
  <?php
      session_destroy();
    }
  }
  ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">NavaBharat Ration Store &trade;</a>
    <ul class="navbar-nav ml-auto">
      <li class=" nav-item">
        <a class="nav-link btn btn-outline-light" href="#" style="cursor:unset;" ><?php date_default_timezone_set("Asia/Kolkata"); echo date("d-m-Y | h:ia"); ?></a>
      </li>
    </ul>
  </nav>

  <div class="login-card">
    <div class="rhead">Retailer Log-in</div><br>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
      <input type="text" name="rid" placeholder="Retailer Id">
      <input type="password" name="rpass" placeholder="Password">
      <input type="submit" name="login" class="login login-submit" value="Login">
    </form>

    <div class="login-help">
      <a href="recover.php">Forgot Password</a>
    </div>
  </div>
  <footer class="page-footer font-small blue">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3" style="background-color: white; position:fixed; left:0; bottom:0; width:100%;">
      © 2020-21 Copyright: NavaBharat Ration Store &trade;, Mangalore.
    </div>
    <!-- Copyright -->

  </footer>
</body>

</html>