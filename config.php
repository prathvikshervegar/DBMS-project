<?php

   $server="localhost";
   $user="root";
   $password="";
   $db="ration2";

   $con=mysqli_connect($server, $user, $password, $db);

   if(!$con){
      echo "Connection failed";
   }

?>