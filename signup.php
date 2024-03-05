<?php
 $uname = $_POST['uname'];
 $pass1 = $_POST['upass1'];
 $pass2 = $_POST['upass2'];

 if($pass1 != $pass2){
    echo "Password Mismatch";
    die;
}
$conn = new mysqli("localhost","root","","dbmsproject");
if($conn->connect_error)
    {
        echo "Connection failed";
        die;
    }

$cmd="insert into user(username,password)  values('$uname','$pass1')";
 $sqlstatus=mysqli_query($conn,$cmd);
if($sqlstatus)
{
    echo "Sign up Success";
    header("location:login.html");
}

?>