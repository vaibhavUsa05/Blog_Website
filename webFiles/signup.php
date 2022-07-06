<?php include "./connDB.php"?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <title>Hello, world!</title>
    <style>
body{
  background-color:green;
}




    </style>
  </head>
  <body>
    <h1>Sign up</h1>
    <form class="form" action="" method="POST">
    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="name" name="name"  class="form-control" aria-describedby="emailHelp" placeholder="Enter username">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>  
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <button type="button" class="btn btn-link"><a href="./login.php">Already have an account?</a></button>
</form>


<?php
if(isset($_POST["submit"])){
$username=$_POST["name"];
$email=$_POST["email"];
$password=$_POST["password"];
function randomAlphaBeta($length){
    return substr(md5(time()),0,$length);
}
echo randomAlphaBeta(10);
$randomNum=randomAlphaBeta(10);
$sql="INSERT INTO `userinfo` (`USER_ID`,`USERNAME`,`EMAIL`,`PASSWORD`,`USER_DATE`) VALUES ('$randomNum','$username','$email','$password',current_timestamp())";
$res=mysqli_query($conn,$sql);
if($res){
 echo"data inserted successfully";   
 header("location:./login.php");
}
else{
    echo"data not inserted";
    header("location:./signup.php");
}






}

?>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>