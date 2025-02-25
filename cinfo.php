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
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .bs-example {
            margin: 20px 20%;
        }
        li{
            padding: 10px 40px 10px 0;
        }
    </style>
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href);
        }
    </script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">NavaBharat Ration Store &trade;</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="services.php">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="stock.php">Stock</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="distribute.php">Distribution</a>
      </li>
      <li class="nav-item active dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Customer actions
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Customer info</a>
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

<div class="bs-example">
    <h1 class="border-bottom pb-3 mb-4">Customer Info</h1>
    <form action="" method="post">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="custid">Customer Id:</label>
            <div class="col-sm-5">
                <input type="tel" name="cid" pattern="[0-9]" class="form-control" id="custid" placeholder="Enter Customer Id" required>
            </div>
            <div class="col-sm-2">
                <input type="submit" name="submit" class="btn btn-info" value="Display details">
            </div>
            <div class="col-sm-3">
            <input type="reset" onclick="location.reload()" class="btn btn-danger" value="Reset">
            </div>
        </div>
    </form>
    <br>

    <?php
        include 'config.php';

        if(isset($_POST['submit'])){
            $cid=$_POST['cid'];
            $fetchdata="SELECT * FROM cardholder WHERE cid='$cid'";
            $fetchquery1=mysqli_query($con,$fetchdata);
            $fetchdata="SELECT * FROM family WHERE cid='$cid' ORDER BY relation ";
            $fetchquery2=mysqli_query($con,$fetchdata);
            $cidcount=mysqli_num_rows($fetchquery1);
            if($cidcount==0){
                ?>
                <script>
                    alert("Customer Id doesnot exists!");
                    location.reload();
                </script>
                <?php
            }
            else{
    ?>

    <table class="table">
        <tr>
            <th scope="row">Customer Id:</th>
            <td colspan="2"><?php echo $cid; ?></td>   
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <th scope="col">Sl No.</th>
            <th scope="col">Name</th>
            <th scope="col">Relation</th>
        </tr>
        <?php
                $x=0;
                while($row = mysqli_fetch_array($fetchquery2)){
                ++$x;
                ?>
                    <tr>
                        <td scope="row"><?php echo $x; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                    </tr>
                <?php
                }
                $fetchdet="SELECT * FROM cardholder WHERE cid='$cid'";
                $detquery=mysqli_query($con,$fetchdet);
                $result=mysqli_fetch_assoc($detquery);
                ?>
                    <tr>
                        <th scope="row">Email:</th>
                        <td colspan="2"><?php echo $result['email']; ?></td>   
                    </tr>
                    <tr>
                        <th scope="row">Address:</th>
                        <td colspan="2"><?php echo $result['adr']; ?></td>   
                    </tr>
                    <tr>
                        <th scope="row">Category:</th>
                        <td colspan="2"><?php echo $result['category']; ?></td>   
                    </tr>
                <?php
            }
        }
        else{
            ?>
            <div class="row">
            <div class="col-sm-4">
            <a class="text-decoration-none" href="cupdate.php"><h6 class="text-center">Click here for customer updation</h6></a><br>
            </div>
            <div class="col-sm-4">
            <a class="text-decoration-none" href="cdelete.php"><h6 class="text-center">Click here for customer deletion</h6></a>
            </div>
            <div class="col-sm-4">
            <a class="text-decoration-none" href="cregister.php"><h6 class="text-center">Click here for new registration</h6></a>
            </div>
            </div>         
            <?php
        }
    ?>  
    </table>
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