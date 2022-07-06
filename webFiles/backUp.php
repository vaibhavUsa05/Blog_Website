<?php
if(isset($_POST["submit"])){
$usermessage=$_POST["message"];
$fromUserName=$_SESSION["username"];
$toUserName=$_GET["toUserName"];
$toUserID=$_GET[" toUserID"];
$fromUserID=$_SESSION["userID"];
$sql="INSERT INTO `conversation`(`SOURCE_USERID`, `DEST_USERID`, `SOURCE_USERNAME`, `DEST_USERNAME`, `MESSAGE_ID`, `MESSAGE`) VALUES ('$fromUserID','$toUserID','$fromUserName','$toUserName','$fromUserID','$usermessage')";
$res=mysqli_query($conn,$sql);
if($res){
  echo' data inserted successfully';
  $sql="SELECT * FROM `conversation` WHERE `SOURCE_USERID`='$fromUserID' && `DEST_USERID`='$toUserID'";
  $res=mysqli_query($conn,$sql);
  $num=mysqli_num_rows($res);
  if($num>0){
    while($row=mysqli_fetch_assoc($res)){
      $messageID=$row["MESSAGE_ID"];
      $clientChat=$row["MESSAGE"];
  if($fromUserID==$messageID){
  echo'  <span class="right">'.$clientChat.'</span>
  <span class="right"></span>';
}
else{
  echo'  <span class="left">'.$clientChat.'</span>
  <span class="right"></span>';
}
    }}

}







?>