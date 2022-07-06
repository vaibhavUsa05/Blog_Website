<?php include "./connDB.php";
session_start();
if(!$_SESSION["username"]){
  header("location:./login.php");
}
?>


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
.card-body{
    display:flex;
height:8rem;
}
.card-title{
padding-top:.8rem;
padding-left:.8rem;
color:green;
text-transform:Capitalize;
}
.card,a{
width:90vw;
margin:auto;
margin-top:2px;
margin-bottom:5px;
}
a:hover{
  text-decoration:none;
}
img{
border:2px solid transparent;
border-radius:800px;
width:5rem;
margin:5px;
object-fit:cover;
box-sizing:border-box;
}



.card-img-top{
  border-radius:800px;
  width:5rem;
  margin:auto;
  margin-top:.8rem;
  object-fit:cover;
}
.userCon{
  display:flex;
  flex-direction:column;
  
}


    </style>
  </head>
  <body>
    <h1>chat box</h1>

<?php
    echo'<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="../image/shop-1.webp" alt="Card image cap">
  <div class="card-body">
    <h5 class="card" style="text-align:center;border:none;">'.$_SESSION["username"].'</h5>
  </div></div>'
?>
<?php 
$sql="SELECT * FROM `userinfo` ";
$res=mysqli_query($conn,$sql);
$num=mysqli_num_rows($res);
if($num>0){
  $i=1;
while($row=mysqli_fetch_assoc($res)){
if($_SESSION["userID"]==$row["USER_ID"]){
  continue;
}
  echo'<a href="./conversation.php?fromUserName='. $_SESSION["username"].' && toUserName='.$row["USERNAME"].' && toUserID='.$row["USER_ID"].'">
  <div class="card">
  <div class="card-body">
  <img src="../image/shop-'.$i.'.webp" alt="blue">
  <div class="userCon">
   <h5 class="card-title">'.$row["USERNAME"].'</h5>
   <h6 class="message">this the the message from server side scripting user python language</h6>
  </div>
  </div>
  </div>
</a>';
$i++;
}
}
//*$sql="SELECT * FROM `conversation` ORDER BY '$row["USER_ID"]' DESC LIMIT 1";
// $res=mysqli_query($conn,$sql);
// $num=mysqli_num_rows($res)*/
?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>