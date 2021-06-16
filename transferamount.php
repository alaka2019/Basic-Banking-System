<?php
  $sender = $_POST['sender'];
  $receiver = $_POST['recipient'];
  $amount = (int)$_POST['amount'];

  $success=false;
  $auth=false;
  $rec=false;
  $bal=false;

  $server = "localhost";
  $uname = "root";
  $pwd = "";

  $con = mysqli_connect($server, $uname, $pwd, 'bank');

  if(!$con)
  {
    die("connection to this database failed due to" . mysqli_connect_error());
  }

  $sql1 = "SELECT * FROM `users` WHERE `username`='$sender';";
  $sql2 = "SELECT * FROM `users` WHERE `username`= '$receiver';";

  $sqldata1 = $con->query($sql1);
  $row1 = mysqli_fetch_array($sqldata1, MYSQLI_ASSOC);

  $sqldata2 = $con->query($sql2);
  $row2 = mysqli_fetch_array($sqldata2, MYSQLI_ASSOC);

  if(count($row1)!=0)
  {
      $auth=true;

      if(count($row2)!=0)
      {
          $rec=true;

          if($row1['amount'] >= (int)$amount + 2000)
          {
              $bal=true;

              $sql3 = "UPDATE `users` SET `amount`= (`amount`- '$amount') WHERE `username`='$sender';";
              $sql4 = "UPDATE `users` SET `amount`= (`amount`+ '$amount') WHERE `username`='$receiver';";
              if($con->query($sql3) && $con->query($sql4))
              {
                  $success=true;
                  $sql5 = "SELECT `amount` FROM `users` WHERE `username`= '$sender';";
                  $sqldata5 = $con->query($sql5);
                  $row5 = mysqli_fetch_array($sqldata5, MYSQLI_ASSOC);

                  $account_no=$row1['account_no'];
                  $id = rand(100000000000,999999999999);
                  $sql6 = "INSERT INTO `transactions` (`transaction_id`, `account_no`, `sender`,`recipient`, `amount`) VALUES ('$id', '$account_no', '$sender', '$receiver', '$amount');";
                  $sqldata6 = $con->query($sql6);
              }
          }

      }

  }

  $con->close();
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>The Sparks Foundation</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <br>
  <img src="logo.gif" class="logo" onclick="window.location.href='hello.html';"/>

  <button class="b1" onclick="window.location.href='hello.html';">HOME</button>

  <form name="reg" action="register.php" method="post">
  <div class="bank">&nbsp BASIC BANKING SYSTEM</div> <br><br>

  <div class="transferbar">
    <p style="font-size:36px;">TRANSACTION DETAILS</p><br><br><br>
      <image src="transfermoney.gif" height=250px width=250px style="border-radius:50%;"><br><br>
        <?php

        if($success==true)
        {
            echo "<br><p class='text2'>Successful Transaction!</p>";
            echo "<p class='text2'>Transaction ID {$id}</p>";
            echo "<p class='text2'>Your current Balance is {$row5['amount']}.</p><br>";
        }

        elseif($bal==false)
        {
            echo "<p class='text'>Insufficient Balance</p>";
        }

        elseif($rec==false)
        {
            echo "<p class='text'>Invalid Recipient</p>";
        }

        elseif($auth==false)
        {
            echo "<p class='text'>Authentication Failed</p>";
        }

        ?>

  </div>
</form>
</body>
</html>
