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
        <li class="nav-item active">
          <a class="nav-link" href="#">Distribution</a>
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

  <div class="bs-example">
    <h1 class="border-bottom pb-3 mb-4">Ration Distribution</h1>
    <form action="" method="post">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label" for="custid">Customer Id:</label>
        <div class="col-sm-9">
          <input type="tel" name="cid" pattern="[0-9]" class="form-control" id="custid" placeholder="Enter Customer Id" value="<?php if(isset($_POST['cid'])) echo $_POST['cid']; ?>" required>
        </div>
      </div>
      <label class="col-sm-12 col-form-label text-center" for="itemName">Select Items:</label>
      <?php
      include 'config.php';

      $fetchitem = "SELECT * FROM stock ORDER BY qty";
      $itemquery = mysqli_query($con, $fetchitem);
      while ($row = mysqli_fetch_array($itemquery)) {
      ?>
        <div class="form-check form-check-inline col-sm-2  mt-3 ml-5 pl-5 mb-4">
          <input class="form-check-input" type="checkbox" id="itemCheckbox" name="item[]" value="<?php echo $row[0]; ?>" >
          <label class="form-check-label" for="itemCheckbox"><?php echo $row[0]; ?></label>
        </div>
      <?php
      }
      ?>
      <div class="pb-3 mb-4 col-sm-2 offset-sm-6">
        <input type="submit" name="next[]" class="btn btn-primary" value="Next">
      </div>
      <?php
      if (isset($_POST['next'])) {
        $_SESSION['cid']=$cid=$_POST['cid'];
        $fetchdata="SELECT * FROM cardholder WHERE cid='$cid'";
        $fetchquery=mysqli_query($con,$fetchdata);
        $result=mysqli_fetch_assoc($fetchquery);
        $_SESSION['ctype']=$result['category'];
        $cidcount=mysqli_num_rows($fetchquery);
        if($cidcount==0){
        ?>
          <script>
            alert("Customer Id doesnot exists!");
            location.reload();
          </script>
        <?php
        }
        else{
        $item = $_POST['item'];
        $n = count($item);
      ?>
        <label class="col-sm-12 col-form-label text-center" for="itemQty">Select Quantity:</label>
      <?php
        for ($i = 0; $i < $n; $i++) {
      ?>
      <div class="form-group row mt-3 offset-sm-2">
        <label class="col-sm-2 col-form-label" for="itemName">Item Name:</label>
        <div class="col-sm-3">
          <input type="text" name="itemname[]" readonly class="form-control-plaintext" id="itemName" value="<?php echo $item[$i]; ?>">
        </div>
        <label class="col-sm-2 col-form-label" for="itemQty">Quantity:</label>
        <div class="col-sm-4">
          <input type="number" name="qty[]" class="form-control" id="itemQty" min=0 placeholder="Enter Quantity(in kg)">
        </div>
      </div>
      <?php
        }
      }
      }
      ?>
      <div class="form-group row">
        <div class="col-sm-9">
          <input type="submit" name="reset" class="btn btn-danger offset-sm-6" value="Reset">
          <input type="submit" name="Submit" class="btn btn-success offset-sm-3" value="Submit">
        </div>
      </div>
    </form>
    <?php
      if(isset($_POST['reset'])){
      ?>  
        <script>
          location.reload();
        </script>
      <?php
      }
      if(isset($_POST['Submit'])){
        $cid=$_SESSION['cid'];
        $ctype=$_SESSION['ctype'];
        $itemname=$_POST['itemname'];
        $qty=$_POST['qty'];
        $ddate=date('Y-m-d');
        $total=0;
        foreach(array_combine($itemname, $qty) as $key1 => $key2){
          $fetchdata="SELECT * FROM stock where item='$key1'";
          $dataquery=mysqli_query($con,$fetchdata);
          while ($row1 = mysqli_fetch_array($dataquery)){
            if($row1[1]<$key2){
            ?>
              <script>
                alert("<?php echo $key2."kg of ".$key1; ?> is not available.");
              </script>
            <?php
            exit;
            }
            if($ctype=='APL'){
              if($row1[2]==null){
                ?>
                  <script>
                    alert("Pricing of <?php echo $key1; ?> not set.");
                    location.reload();
                  </script>
                <?php
                 exit;
              }
              $total+=$key2*$row1[2];
            }
            else{
              if($row1[3]==null){
                ?>
                  <script>
                    alert("Pricing of <?php echo $key1; ?> not set.");
                    location.reload();
                  </script>
                <?php
                 exit;
              }
              $total+=$key2*$row1[3];
            }
          }
          $qtyupdate="UPDATE stock set qty=qty-'$key2' where item='$key1'";
          $qtyquery=mysqli_query($con,$qtyupdate);
        }
        $buyitem="INSERT into distribute(cid,distdate,totalamt) values('$cid','$ddate','$total')";
        $bquery=mysqli_query($con,$buyitem);

        $fetchoid="SELECT * FROM distribute order by distid desc limit 1";
        $oidquery=mysqli_query($con,$fetchoid);
        $result=mysqli_fetch_assoc($oidquery);
        $oid=$result['distid'];

        foreach(array_combine($itemname, $qty) as $val1 => $val2){
          $storeitem="INSERT into distributed_items values('$oid','$val1','$val2')";
          $storequery=mysqli_query($con,$storeitem);
        }
        ?>  
        <script>
          alert("Purchase done.\n\nTotal Amount: ₹<?php echo $total; ?>");
          location.reload();
        </script>
      <?php
      }
    ?>
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