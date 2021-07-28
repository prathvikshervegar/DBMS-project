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
      <li class="nav-item active">
        <a class="nav-link" href="#">Stock</a>
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

<div class="bs-example">
    <h1 class="pb-3 mb-3">Stock details</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Sl No.</th>
            <th scope="col">Item</th>
            <th scope="col">Quantity</th>
            </tr>
        </thead>
        <?php
                include 'config.php';
                $fetchitem="SELECT * FROM stock ORDER BY qty";
                $itemquery=mysqli_query($con,$fetchitem);
                $x=0;
                while($row = mysqli_fetch_array($itemquery)){
                    if($row[1]==null){
                        $m=$row[0];
                        $itemdelete="DELETE from stock where item='$m'";
                        $itemquery=mysqli_query($con,$itemdelete);
                    }
                    ++$x;
                ?>
                <tbody>
                    <tr>
                        <td scope="row"><?php echo $x; ?></td>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1].'kg'; ?></td>
                    </tr>
                </tbody>
                <?php
                }
            ?>
    </table>
    <h4 class="border-bottom pt-4 mt-1 pb-1">Insert/Update an item</h4>
    <form action="" method="post">
        <div class="form-group row border-bottom pb-3 mb-4">
            <label class="col-sm-2 col-form-label mt-2" for="itemName">Item Name:</label>
            <div class="col-sm-3 mt-2">
                <input type="text" name="item" class="form-control" id="itemName" placeholder="Enter Item Name" required>
            </div>
            <label class="col-sm-1 col-form-label mt-2" for="itemQty">Quantity:</label>
            <div class="col-sm-3 mt-2">
                <input type="tel" name="qty" class="form-control" id="itemQty" placeholder="Enter Quantity(in kg)" required>
            </div>
            <div class="col-sm-2 offset-sm-1 mt-2" >
                <input type="submit" name="insert" class="btn btn-success" value="Insert">
            </div>
        </div>
    </form>
    <?php
        if(isset($_POST['insert'])){
            $item=$_POST['item'];
            $qty=$_POST['qty'];
            $itemsearch="SELECT * from stock where item='$item'";
            $searchquery=mysqli_query($con,$itemsearch);
            $itemcount=mysqli_num_rows($searchquery);
         
            if($itemcount>0){
                $itemupdate="UPDATE stock set qty=qty+'$qty' where item='$item'";
                $itemquery=mysqli_query($con,$itemupdate);
             ?>
                <script>
                   alert("<?php echo $item.' quantity updated in the stock'; ?>");
                   location.reload();
                </script>
             <?php
            }
            else{
                $iteminsert="INSERT into stock(item,qty) values('$item','$qty')";
                $itemquery=mysqli_query($con,$iteminsert);
            ?>
                <script>
                    alert("<?php echo $item.' added to the stock'; ?>");
                    location.reload();
                </script>
            <?php
            }
        }
    ?>
    <h4 class="border-bottom pt-4 mt-1 pb-1 ">Delete an item</h4>
    <form action="" method="post">
        <div class="form-group row border-bottom pb-3 mb-4">
            <label class="col-md-2 col-form-label mt-2" for="itemName">Item Name:</label>
            <div class="col-sm-3 mt-2">
                <input type="text" name="ditem" class="form-control" id="itemName" placeholder="Enter Item Name" required>
            </div>
            <div class="col-sm-2 offset-sm-1 mt-2">
                <input type="submit" name="delete" class="btn btn-danger" value="Delete">
            </div>
        </div>
    </form>
    <?php
        if(isset($_POST['delete'])){
            $item=$_POST['ditem'];
            $itemsearch="SELECT * from stock where item='$item'";
            $searchquery=mysqli_query($con,$itemsearch);
            $itemcount=mysqli_num_rows($searchquery);
            if($itemcount>0){
                $itemdelete="DELETE from stock where item='$item'";
                $itemquery=mysqli_query($con,$itemdelete);
                ?>
                <script>
                    alert("<?php echo $item.' deleted from stock'; ?>");
                    location.reload();
                </script>
                <?php
            }
            else{
                ?>
                <script>
                    alert("<?php echo $item.' not available in stock'; ?>");
                    location.reload();
                </script>
                <?php
            }
        }
    ?>
</div>
<div class="bs-example">
    <h1 class="pt-5 mt-3 pb-3 mb-3">Item pricing</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Sl No.</th>
            <th scope="col">Item</th>
            <th scope="col">APL Pricing(per kg)</th>
            <th scope="col">BPL Pricing(per kg)</th>
            </tr>
        </thead>
        <?php
                $fetchprice="SELECT * FROM stock ORDER BY qty";
                $pricequery=mysqli_query($con,$fetchprice);
                $y=0;
                while($row = mysqli_fetch_array($pricequery)){
                ++$y;
                ?>
            <tbody>
                <tr>
                    <td scope="row"><?php echo $y; ?></td>
                    <td><?php echo $row[0]; ?></td>
                    <td><?php if($row[2]!=null) echo "₹".$row[2]; else echo "-" ?></td>
                    <td><?php if($row[3]!=null) echo "₹".$row[3]; else echo "-" ?></td>
                </tr>
            </tbody>
            <?php
                }
        ?>
    </table>
    <h4 class="border-bottom pt-4 mt-1 pb-1 mb-3">Set/Update the item pricing</h4>
    <form action="" method="post">
        <div class="form-group row border-bottom pb-3 mb-4">
            <label class="col-sm-2 col-form-label" for="itemName1">Item Name:</label>
            <div class="col-sm-3">
                <input type="text" name="itemname" class="form-control" id="itemName1" placeholder="Enter Item Name" required>
            </div>
            <label class="col-sm-1 col-form-label" for="itemp1">Price:</label>
            <div class="col-sm-3">
                <input type="text" name="p1" class="form-control" id="itemp1" placeholder="Enter Price/kg for APL" required>
            </div>
            <div class="col-sm-3">
                <input type="text" name="p2" class="form-control" id="itemp2" placeholder="Enter Price/kg for BPL" required>
            </div>
            <div class="pt-2 mt-1 col-sm-2 offset-sm-6" >
                <input type="submit" name="set" class="btn btn-success" value="Set pricing">
            </div>
        </div>
    </form>
    <?php
        if(isset($_POST['set'])){
            $item=$_POST['itemname'];
            $p1=$_POST['p1'];
            $p2=$_POST['p2'];

            $priceupdate="UPDATE stock set aplprice='$p1', bplprice='$p2' where item='$item'";
            $pricequery=mysqli_query($con,$priceupdate);
            ?>
                <script>
                   alert("<?php echo $item.' pricing has been updated.'; ?>");
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