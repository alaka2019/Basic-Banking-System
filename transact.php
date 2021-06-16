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

  <input type='hidden' id='user'>

  <div class="usersbar">
    <?php

       $found=false;
       $server = "localhost";
       $uname = "root";
       $pwd = "";

       $con = mysqli_connect($server, $uname, $pwd, 'bank');

       if(!$con)
       {
           die("connection to this database failed due to" . mysqli_connect_error());
       }

       $user= $_POST['user'];

       $sql = "SELECT * FROM `users` WHERE `username` = '$user';";

       $sqldata= $con->query($sql);

       $row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC);

        if(count($row)!=0)
        {
          echo "<table class='tb2'>";
          echo "<tr><th class='th2'>Account Number</th><th class='th2'>Username</th><th class='th2'>Account Type</th><th class='th2'>Balance</th></tr>";
          echo "<tr><td>{$row['account_no']}</td><td>{$row['username']}</td><td style='text-transform: capitalize;'>{$row['account_type']}</td><td>{$row['amount']}</td></tr>";
          echo "</table>";
        }

        echo "<br><br>";
        echo "<div class='recip'>";
        echo "<p>RECEIVER</p><br>";

        $sql2 = "SELECT `username` FROM `users` WHERE `username` != '$user';";

        $sqldata2= $con->query($sql2);

        echo "<form action='transferamount.php' method='post'>";
        $send='"' . $_POST['user'].'"';
        echo "<input type='hidden' name='sender' value=$send>";
        echo "<select name='recipient' id='reg'>";
        echo "<option style='display:none'></option>";

        while($row2 = mysqli_fetch_array($sqldata2, MYSQLI_ASSOC))
        {
          $i = '"' . $row2['username'].'"';
          echo "<option value=$i> {$row2['username']} </option>";
        }

      echo "</select>";
      echo "<br><br><br>";
      echo "</div><div class='amt'>";
      echo "<p>Enter Amount</p><br>";
      echo "<input type='text' name='amount' placeholder='Enter Amount' id='reg'>";
      echo "<br></div>";
      echo "<input type='submit' value='SEND' class='sub'>";
      echo "</form>";
      $con->close();

    ?>

  </div>

</body>
</html>
