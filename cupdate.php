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
        textarea{
          resize: none;
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
          <a class="dropdown-item" href="cinfo.php">Customer info</a>
          <a class="dropdown-item" href="#">Customer updation</a>
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
<h1 class="border-bottom pb-3 mb-4">Customer details updation</h1>
    <form action="" method="post">
    <div class="form-group row border-bottom pb-3">
            <label class="col-sm-2 col-form-label" for="custid">Customer Id:</label>
            <div class="col-sm-5">
                <input type="tel" name="cid" pattern="[0-9]" class="form-control" id="custid" placeholder="Enter Customer Id" required>
            </div>
            <div class="col-sm-2">
                <input type="submit" name="submit" class="btn btn-info" value="Submit">
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
            $_SESSION['cid']=$cid=$_POST['cid'];
            $fetchcust="SELECT * FROM cardholder WHERE cid='$cid'";
            $custquery=mysqli_query($con,$fetchcust);
            $fetchfam="SELECT * FROM family WHERE cid='$cid' and relation!='Cardholder'";
            $famquery=mysqli_query($con,$fetchfam);
            $cidcount=mysqli_num_rows($custquery);
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
    <form action="" method="post">
          <?php
            while($row = mysqli_fetch_array($custquery)){
            ?>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="custid">Customer Id:</label>
                <div class="col-sm-9">
                    <input type="text" name="custname" readonly class="form-control-plaintext" id="custid" value="<?php echo $cid; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="custName">Customer Name:</label>
                <div class="col-sm-9">
                    <input type="text" name="custname" class="form-control" id="custName" value="<?php echo $row[1]; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="inputEmail">Email Address:</label>
                <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" id="inputEmail" value="<?php echo $row[2]; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="phoneNumber">Mobile Number:</label>
                <div class="col-sm-9">
                    <input type="tel" name="mob" class="form-control" id="phoneNumber" pattern="[0-9]{10}" value="<?php echo $row[3]; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="dob" class="col-sm-3 col-form-label">Date of Birth:</label>
                <div class="col-sm-9">
                    <input class="form-control" type="date" name="dob" id="dob" max="2000-12-31" value="<?php echo $row[4]; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="gender">Gender:</label>
                <div class="col-sm-9">
                    <textarea rows="1" name="gender" class="form-control" id="gender" placeholder="male/female/others" required><?php echo $row[5]; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="postalAddress">Postal Address:</label>
                <div class="col-sm-9">
                    <textarea rows="3" name="adr" class="form-control" id="postalAddress" required><?php echo $row[6]; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="CardType">Category:</label>
                <div class="col-sm-9">
                    <textarea rows="1" name="category" class="form-control" id="CardType" placeholder="APL/BPL" required><?php echo $row[8]; ?></textarea>
                </div>
            </div>
        <?php
            }

        ?>
    <h4 class="pt-4 mt-1 pb-1">Add/Update family member</h4>   
    <table class="table" >
      <thead>
        <tr>
            <th scope="row">Sl No:</th>
            <th>Member Name:</th>
            <th>Relation:</th>
        </tr>
      </thead>
      <tbody id="myTable">
      <?php
            $x=0;
            while($row = mysqli_fetch_array($famquery)){
            $x++;
        ?>
        <tr>
            <td scope="row"><?php echo $x; ?></td>
            <div class="col-sm-5">
            <td><textarea name="mname[]" class="form-control" rows="1" required><?php echo $row[1]; ?></textarea></td>
            </div>
            <div class="col-sm-5">
            <td><textarea name="rel[]" class="form-control" rows="1" required><?php echo $row[2]; ?></textarea></td>
            </div>
        </tr>
        <?php
            }
          }
        ?>
      </tbody>
      </table>
      <a onclick="myCreateFunction()" class="btn btn-success offset-sm-3">Add row</a>
      <a onclick="myDeleteFunction()" class="btn btn-danger offset-sm-3">Delete row</a>  
      <div class="pt-3 mt-4 col-sm-2 offset-sm-5">
        <input type="submit" name="update" class="btn btn-primary" value="Update">
      </div>
    </form>  
        <?php
        }
        if(isset($_POST['update'])){
          $cid=$_SESSION['cid'];
          $custname=$_POST['custname'];
          $email=$_POST['email'];
          $mob=$_POST['mob'];
          $dob=$_POST['dob'];
          $gender=$_POST['gender'];
          $adr=$_POST['adr'];
          $category=$_POST['category'];
          $updatecust1="UPDATE family set mname='$custname' where cid='$cid' and relation='Cardholder'";
          $uquery1=mysqli_query($con,$updatecust1);
          $delfam="DELETE FROM family WHERE cid='$cid' and relation!='Cardholder'";
          $uquery2=mysqli_query($con,$delfam);
          foreach(array_combine($_POST['mname'], $_POST['rel']) as $membname => $relation){
            $familyinsert="INSERT into family(cid,mname,relation) values('$cid','$membname','$relation')";
            $fquery=mysqli_query($con,$familyinsert);
          }
          $fetchfam1="SELECT * FROM family WHERE cid='$cid' and relation!='Cardholder'";
          $fam1query=mysqli_query($con,$fetchfam1);
          $count=mysqli_num_rows($fam1query);
          $updatecust2="UPDATE cardholder set cname='$custname',email='$email',mobile='$mob',dob='$dob',gender='$gender',adr='$adr',mcount='$count',category='$category' where cid='$cid'";
          $uquery3=mysqli_query($con,$updatecust2);
          ?>
        <script>
        alert("Updation successfull");
        </script>
        <?php
        }
        ?>    
    
    


<script>
function myCreateFunction() {
  var table = document.getElementById("myTable");
  var rcount = table.rows.length;
  var row = table.insertRow(rcount);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  cell1.innerHTML = rcount+1;
  var element1 = document.createElement("textarea");
  element1.name = "mname[]";
  element1.className = "form-control";
  element1.rows = 1;
  element1.placeholder = "Enter name";
	cell2.appendChild(element1);
  var element2 = document.createElement("textarea");
  element2.name = "rel[]";
  element2.className = "form-control";
  element2.rows = 1;
  element2.placeholder = "Enter relation";
	cell3.appendChild(element2);
}

function myDeleteFunction() {
  var table = document.getElementById("myTable");
  var rcount = table.rows.length;
  document.getElementById("myTable").deleteRow(rcount-1);
}
</script>

    
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