<?php
session_start();
$username = $_POST['uname'];
$pass = $_POST['upass'];
$_SESSION['username']=$username;
$conn = new mysqli("localhost","root","","dbmsproject");
if($conn->connect_error)
   {
       echo "Connection failed";
       die;
   }

$cmd="select * from user where username='$username' and password='$pass'";
$sqlstatus=mysqli_query($conn,$cmd);
if($sqlstatus)
{
   echo "Login Success";
   header("location:home.html");
}
 
?>