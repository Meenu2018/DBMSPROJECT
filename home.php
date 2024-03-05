<?php
session_start();
$uname= $_POST['item'];
$pass1 = $_POST['qty'];
$username=$_SESSION['username'];
//$_SESSION['name'] = $name;
//$_SESSION['placed'] = $placed;
$conn = new mysqli("localhost","root","","dbmsproject");
if($conn->connect_error)
    {
        echo "Connection failed";
        die;
    }
    
  $cmd = "select * from stock where stocktype='$uname'";
  $sql_result = mysqli_query($conn,$cmd);
  $row = mysqli_fetch_assoc($sql_result);
    $qty = $row['qty'];
    
    //if($qty > $pass1){
      //$newqty= "update stock set qty=qty-$pass1 where stocktype='$uname' and qty > 0";

      //$sql_result = mysqli_query($conn,$newqty);

      //if ($sql_result)
     // {
      //  echo "Order successfully placed";   
     // } 
    //}
    //else
     // echo "Order could not be placed";
     // header("location:output.html");
   
      //$cmd="select * from stock='$uname'";
//$sqlstatus=mysqli_query($conn,$cmd);
//if($sqlstatus)
//{
 //  echo "Login Success";
   //header("location:output.html");
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Order Details</title>
    <style>
        body
        {
        
          background: linear-gradient(#5d5fe8, #aaeeec);
        
        }
        .form{
                background-color: rgba(255,255,255,0.1);
                border-radius: 20px;
                border: 2px solid rgba(255, 255, 255, 0.25);
                backdrop-filter: blur(5px);
                box-shadow: -15px 17px 17px rgba(10,10,10,0.30);
        }
        .box
        {
          font-size:20px;

        }
        .flex{
            display: flex;
            justify-content: space-between;
            padding: 20px;
            border: 2px solid rgba(255, 255, 255, 0.25);
            box-shadow: -15px 17px 17px rgba(10,10,10,0.30);
            font-size: 20px;
            
        }
        .flex a{
            color:antiquewhite;
            text-decoration: none;
        }
        .flex p{
            color:antiquewhite;

        }
       

    </style>
</head>
<body>
  <div class="flex">
          <p>Home</p>
          <a href="logout.html">Logout</a>
    </div>
    <div class="d-flex justify-content-center align-items-center vh-100 text-center ">
        <div class="form p-5 text-center">
            <h2>Order view </h2>
            <div class="box">
            <?php
              if($qty > $pass1){
                $newqty= "update stock set qty=qty-$pass1 where stocktype='$uname' and qty > 0";
          
                $sql_result = mysqli_query($conn,$newqty);
                $qty=$qty-$pass1;
          
                if ($sql_result)
                {
                  
                  $cmd="select price from stock where stocktype='$uname'";
              $sql_result = mysqli_query($conn,$cmd);
             $row = mysqli_fetch_assoc($sql_result);
                $price = $row['price'];

                $amt=$pass1 *$price;
                $new="Insert into bill(stocktype,qtyplaced,amount) values('$uname',$pass1,$amt)";
                $sql_result=mysqli_query($conn,$new);
                echo "Order successfully placed"."<br>". "Order item: $uname"."<br>". "Qty Ordered: $pass1"."<br>"."Total Amount: $amt";
               
               $new="select max(billno) from bill where stocktype='$uname'";
               $sql_result=mysqli_query($conn,$new);
                $row = mysqli_fetch_assoc($sql_result);
                $billno =$row['max(billno)'];
                $value="Insert into orderdetails(uname,billid) values('$username',$billno)";
                mysqli_query($conn,$value);
                } 
                
              }
              else
               { echo "Order could not be placed"."<br>"."Insufficient stock";
                   $cmd="Insert into cancelled(username,stocktype,qty)values('$username','$uname',$pass1)";
                   mysqli_query($conn,$cmd);
               }                

            ?>
            <br>
            <a href="home.html">
              <button class="btn btn-success">Order Again</button>
            </a>
            </div>
          </div>
      </div>
            
            
  
</body>
</html>
