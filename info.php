<?php

   $user = $_POST['view'];
   $found=false;
   $found2=false;
   $server = "localhost";
   $uname = "root";
   $pwd = "";

   $con = mysqli_connect($server, $uname, $pwd, 'bank');

   if(!$con)
   {
       die("connection to this database failed due to" . mysqli_connect_error());
   }

   $sql = "SELECT * FROM `users` WHERE `username`='$user'";

  $sqldata = $con->query($sql);

  $row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC);
  if(count($row)!=0)
  {
        $found=true;
  }

  else
  {   echo "ERROR: $sql <br> $con->error";
  }

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

  <div class="bank">&nbsp BASIC BANKING SYSTEM</div> <br><br>

  <div class="infobar">
      <?php
        if($found==true)
        {
            echo "<p class='text3' style='font-size:26px; font-weight:bold;'>&nbsp &nbsp DETAILS</p>";
            echo "<table class='tb2'>";
            echo "<tr><td class='text3'>First Name</td><td class='text4'>{$row['first_name']}</td>";
            echo "<td class='text3'>Surname</td><td class='text4'>{$row['surname']}</td>";
            echo "<td class='text3'>Gender </td><td class='text4' style='text-transform:capitalize;'> {$row['gender']}</td></tr>";
            echo "<tr><td class='text3'>Date of Birth </td><td class='text4'> {$row['dob']}</td>";
            echo "<td class='text3'>SSN </td><td class='text4'> {$row['ssn']}</td>";
            echo "<td class='text3'>Email </td><td class='text4'> {$row['email']}</td></tr>";
            echo "<tr><td class='text3'>Branch </td><td class='text4'> {$row['branch']}</td>";
            echo "<td class='text3'>Balance </td><td class='text4'> {$row['amount']}</td>";
            echo "<td class='text3'>Annual Income </td><td class='text4'> {$row['annual_income']}</td></tr>";
            echo "<tr><td class='text3'>Nominee SSN </td><td class='text4'> {$row['nominee_ssn']}</td>";
            echo "<td class='text3'>Contact Number </td><td class='text4'> {$row['contact_no']}</td>";
            echo "<td class='text3'>Address  </td><td class='text4'> {$row['address']}</td></tr>";
            echo "<tr><td class='text3'>Account Type </td><td class='text4' style='text-transform:capitalize;'> {$row['account_type']}</td>";
            echo "<td class='text3'>Account Number </td><td class='text4'> {$row['account_no']}</td><td></td></tr>";
            echo "</table>";
        }

        else
        {
              echo "<pclass='text3'>Authentication Failed</p>";
        }

        $sql2 = "SELECT * FROM `transactions` WHERE `sender`='$user' OR `recipient`= '$user';";
        $sqldata2 = $con->query($sql2);

        echo "<br><br>";
        echo "<p class='text3'  style='font-size:26px; font-weight:bold;'> &nbsp &nbsp &nbsp TRANSACTIONS</p><br><br>";
        echo "<table class='tb'>";
        echo "<tr><th class='hd'>Transaction ID</th><th class='hd'>Username</th><th class='hd'>Account Number</th><th class='hd'>Recipient</th><th class='hd'>Amount</th><th class='hd'>Time</th><th class='hd'>Type</th></tr>";

        while($row2 = mysqli_fetch_array($sqldata2, MYSQLI_ASSOC))
        {
             $found2=true;
             echo "<tr><td>";
             echo $row2['transaction_id'];
             echo "</td><td>";
             echo $row2['sender'];
             echo "</td><td class='txt'>";
             echo $row2['account_no'];
             echo "</td><td class='txt'>";
             echo $row2['recipient'];
             echo "</td><td class='txt'>";
             echo $row2['amount'];
             echo "</td><td class='txt'>";
             echo $row2['time'];

             if($user==$row2['sender'])
             {
                echo "</td><td class='txt'>";
                echo "Sent";
                echo "</td></tr>";
             }

            else
            {
                echo "</td class='txt'><td>";
                echo "Received";
                echo "</td></tr>";
            }
        }

        if($found2==false)
        {   echo "No transactions so far";
        }

        echo "</table>";
        $con->close();
    ?>
  </div>

</body>
</html>
