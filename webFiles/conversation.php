<?php include "./connDB.php";
session_start();
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">   <title>Hello, world!</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Plus&display=swap" rel="stylesheet">
 
 <style>
body{
  background-color:rgba(7, 7, 43, 0.888);
}
.chatScreen{
color:purple;
min-height:100vh;
margin:auto;
width:75vw;
display:flex;
flex-direction:column;
position:relative;
top:2rem;
}
.chatRoom{
  display:grid;
  grid-template-columns:auto;
  border:2px solid ghostwhite;
  background-color:ghostwhite;
  border-radius:6px;
  height:80%;
  left:4vw;
  width:90%;
  position:absolute;
  top:5px;
  overflow-y:scroll;
}
.clientSide{
  border:2px solid white;
  border-radius:6px;
  background-color:cyan;
  padding:5px;
  width:90%;
  position:absolute;
  left:4vw;
  bottom:5px;
}
.mic{
position:absolute;
right:5vw;
bottom:2vw;
height:30px;
width:30px;
font-size:30px;
border:none;
background:transparent;
}
textarea{
  width:80%;
  border:2px solid green;
  border-radius:6px;
  color:green;
  padding:5px;
}
.left{
  border:2px solid black;
  border-radius:10px 5px;
background-color:black;
color:white;
width:50%;
position:relative;
padding:2px;
margin-top:5px;
margin-left:5%;
}
.right{
  border:2px solid green;
  border-radius:10px 5px;
background-color:green;
color:white;
width:50%;
position:relative;
padding:2px;
margin-top:5px;
margin-left:37%;
}
h2{
  color:blue;
}
small{
  color:orange;
  font-weight:800;
  position:absolute;
  right:2px;
  bottom:2px;
}
    </style>
  </head>
  <body>
    <h1 style="color:white">Communication Page</h1>
  <div class="chatScreen">
 <div class="chatRoom">
  <?php

  $fromUserName=$_SESSION["username"];
  $toUserName=$_GET["toUserName"];
  $toUserID=$_GET["toUserID"];
  $fromUserID=$_SESSION["userID"];
$sql="SELECT * FROM `conversation` WHERE (`SOURCE_USERID`='$fromUserID' && `DEST_USERID`='$toUserID') OR (`SOURCE_USERID`='$toUserID' && `DEST_USERID`='$fromUserID') ";
$res=mysqli_query($conn,$sql);
$num=mysqli_num_rows($res);
if($num>0){
  while($row=mysqli_fetch_assoc($res)){
    $messageID=$row["MESSAGE_ID"];
    $clientChat=$row["MESSAGE"];
    $currTime=$row["CURR_TIME"];

    $currTimeString=strval($currTime);
   // echo $fromUserID . "and " . $messageID;

if($fromUserID==$messageID){
echo'<div class="right">'.$clientChat.'
<small>'.substr($currTimeString,0,15).'</small>
</div>
';
continue;
}
else{
  echo'<div class="left">'.$clientChat.'
  <small>'.substr($currTimeString,0,15).'</small>
  </div>
  ';
}
  }}

  ?>

<?php
if(isset($_POST["submit"])  ){
  // echo'<script>alert("action")</script>';
$usermessage=$_POST["message"];
$fromUserName=$_SESSION["username"];
$toUserName=$_GET["toUserName"];
$toUserID=$_GET["toUserID"];
$fromUserID=$_SESSION["userID"];
// echo $toUserName;
// echo $toUserID;
if(strlen($usermessage)>0){
$sql="INSERT INTO `conversation`(`SOURCE_USERID`, `DEST_USERID`, `SOURCE_USERNAME`, `DEST_USERNAME`, `MESSAGE_ID`, `MESSAGE`) VALUES ('$fromUserID','$toUserID','$fromUserName','$toUserName','$fromUserID','$usermessage')";
$res=mysqli_query($conn,$sql);

if($res){
  // echo'<script>alert("data inserted successfully")</script>';
  $sql="SELECT * FROM `conversation` WHERE (`SOURCE_USERID`='$fromUserID' && `DEST_USERID`='$toUserID') OR (`SOURCE_USERID`='$toUserID' && `DEST_USERID`='$fromUserID') ";
  $res=mysqli_query($conn,$sql);
  $num=mysqli_num_rows($res);
  if($num>0){
    while($row=mysqli_fetch_assoc($res)){
      $messageID=$row["MESSAGE_ID"];
      $clientChat=$row["MESSAGE"];
     // echo $fromUserID . "and " . $messageID;

  if($fromUserID==$messageID){
  echo'<span class="right">'.$clientChat.'</span>';
  continue;
  }
else{
  echo'<span class="left">'.$clientChat.'</span>';
  
}
    }}
}
else{
  echo'<script>alert("error in data insertion ")</script>';
}

}}

?>

  <!-- <span class="left">this is from client side and this is so cool Lorem ipsum dolor sit, amet consectetur adipisicing elit. Earum tenetur ipsa voluptatum facilis dolorum, similique laudantium nisi inventore totam veritatis ipsum doloremque ab repellendus, qui perferendis minima at eveniet excepturi.</span>
  <span class="right">this is from server side Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero blanditiis exercitationem perferendis illo debitis similique. Aliquid repellendus quidem nihil eius facere adipisci nulla exercitationem minus vero error doloribus laborum quam fuga, praesentium dolorum corrupti!</span> -->
 </div>
  <form action="" method ="POST" class="clientSide">
  <textarea name="message" id="" rows="2" placeholder="Enter your message"></textarea>
  <button class="mic" name="submit"><i class="bi bi-send-fill"></i></button>
  </form>



  </div>
   </body>
  <script>
    let btn=document.querySelector("button");
    btn.addEventListener("click",formSubmit);
    function formSubmit(){
      // alert("song is playing ")
      let audio=new Audio("../sound/ding-dong.mp3");
      audio.play();
    }
// to stop form resubmission
  if(window.history.replaceState){
 window.history.replaceState(null,null,window.location.href);
  }


</script>

</html>


