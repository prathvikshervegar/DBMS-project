<?php
session_start();
if (!isset($_SESSION['rid'])) {
    header(('location:index.php'));
}
if(!isset($count)){
    $count=0;
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
<?php
    include 'config.php';

    if(isset($_POST['next'])){
        $custname=$_POST['custname'];
        $email=$_POST['email'];
        $mob=$_POST['mob'];
        $dob=$_POST['dob'];
        $gender=$_POST['gender'];
        $adr=$_POST['adr'];
        $count=$_POST['count'];
        $cardtype=$_POST['category'];

        $emailquery="SELECT * from cardholder where email='$email'";
        $query=mysqli_query($con,$emailquery);
        $emailcount=mysqli_num_rows($query);
        if($emailcount){
            ?>
                <script>
                     alert("Email already exists!");
                </script>
            <?php
        }
        else{
            $insertquery="INSERT into cardholder(cname,email,mobile,dob,gender,adr,mcount,category) values('$custname','$email','$mob','$dob','$gender','$adr','$count','$cardtype')";
            $iquery=mysqli_query($con,$insertquery);
             ?>
             <script>
                  location.replace("#fd");
             </script>
             <?php
        }
    }

    if(isset($_POST['submit'])){
        $fetchdata="SELECT * FROM cardholder ORDER BY cid DESC LIMIT 1";
        $fetchquery=mysqli_query($con,$fetchdata);
        $result=mysqli_fetch_assoc($fetchquery);
        $cid=$result['cid'];
        $cname=$result['cname'];
        $count=0;
        $custinsert="INSERT into family(cid,mname,relation) values('$cid','$cname','Cardholder')";
        $cquery=mysqli_query($con,$custinsert);
        foreach(array_combine($_POST['membname'], $_POST['relation']) as $membname => $relation){
            $familyinsert="INSERT into family(cid,mname,relation) values('$cid','$membname','$relation')";
            $fquery=mysqli_query($con,$familyinsert);
        }
        ?>
        <script>
        alert("Registration successfull! \n\nCustomer Id: <?php echo $cid; ?>")
        location.replace("cinfo.php");
        </script>
        <?php
    }

?>

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
          <a class="dropdown-item" href="cupdate.php">Customer updation</a>
          <a class="dropdown-item" href="cdelete.php">Customer deletion</a>
          <a class="dropdown-item" href="#">New Customer registration</a>
        </div>
      </li>
      <li class=" nav-item">
          <a class="nav-link btn btn-outline-danger" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>

</nav>


    <div class="bs-example">
        <h1 class="border-bottom pb-3 mb-4">Customer Registration</h1>
        <form action="" method="post">      
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="custName">Full Name:</label>
                <div class="col-sm-9">
                    <input type="text" name="custname" class="form-control" id="custName" placeholder="Enter Full Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="inputEmail">Email Address:</label>
                <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter Email Address" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="phoneNumber">Mobile Number:</label>
                <div class="col-sm-9">
                    <input type="tel" name="mob" class="form-control" id="phoneNumber" pattern="[0-9]{10}" placeholder="Enter Phone Number" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="dob" class="col-sm-3 col-form-label">Date of Birth:</label>
                <div class="col-sm-9">
                    <input class="form-control" type="date" name="dob" id="dob" max="2000-12-31" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Gender:</label>
                <div class="col-sm-9 mt-2">
                    <label class="mb-0 mr-3" for="male">
                        <input type="radio" class="mr-1" id="male" name="gender" value="male" required> Male
                    </label>
                    <label class="mb-0 mr-3" for="female">
                        <input type="radio" class="mr-1" id="female" name="gender" value="female" required> Female
                    </label>
                    <label class="mb-0 mr-3" for="others">
                        <input type="radio" class="mr-1" id="others" name="gender" value="others" required> Others
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="postalAddress">Postal Address:</label>
                <div class="col-sm-9">
                    <textarea rows="3" name="adr" class="form-control" id="postalAddress" placeholder="Enter Postal Address" required style="resize: none;"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Member-count" class="col-sm-3 col-form-label">Total no. of family members</label>
                <div class="col-sm-9">
                    <input class="form-control" type="number" name="count" id="Member-count" placeholder="Enter no. of members" min=0 max=15 required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Category:</label>
                <div class="col-sm-9 mt-2">
                    <label class="mb-0 mr-3" for="apl">
                        <input type="radio" class="mr-1" id="apl" name="category" value="APL" required> APL(Above Poverty Line)
                    </label>
                    <label class="mb-0 mr-3" for="bpl">
                        <input type="radio" class="mr-1" id="bpl" name="category" value="BPL" required> BPL(Below Poverty Line)
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="reset" class="btn btn-danger offset-sm-6" value="Reset">
                    <input type="submit" name="next" class="btn btn-primary offset-sm-3" value="Next">
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST['next'])){
        ?>
        <br>
        <br>
        <h1 id="fd" class="border-bottom pb-3 mb-4">Family Details</h1>
        <form action="" method="post">
            <?php
                for($i=0;$i<$count-1;$i++){
            ?>
            <h4 class="border-bottom pb-3 mb-4">Member <?php echo $i+1 ?>:</h4>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="membName">Full Name:</label>
                <div class="col-sm-5">
                    <input type="text" name="membname[]" class="form-control" id="membName" placeholder="Enter Member's Full Name" required>
                </div>
                <label class="col-sm-2 col-form-label" for="Member-relation">Select Relation:</label>
                <div class="col-sm-3">
                <select class="custom-select" id="Member-relation" name="relation[]" required>
                    <option value="" disabled selected hidden>Relation to cardholder</option>
                    <option value="Husband">Husband</option>
                    <option value="Wife">Wife</option>
                    <option value="Son">Son</option>
                    <option value="Daughter">Daughter</option>
                </select>
                </div>
            </div>
            <?php
                }
            ?>
            <div class="border-bottom pb-3 mb-4"></div>
            <div class=" offset-sm-6">
                <input type="submit" name="submit" class="btn btn-success" value="Submit">
            </div>
        </form>
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