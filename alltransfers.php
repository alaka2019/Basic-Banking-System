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
  <button class="b1" onclick="window.location.href='hello.html';">Home</button>

  <div class="bank">&nbsp BASIC BANKING SYSTEM</div> <br><br>

  <div class="transactionsbar">

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

       $sql = "SELECT * FROM `transactions`;";

       $sqldata= $con->query($sql);
       if($sqldata== true)
       {
            $found=true;
       }

       echo "<table class='tb'>";
       echo "<tr><th class='th'>Transaction ID</th><th class='th'>Username</th><th class='th'>Account Number</th><th class='th'>Recipient</th><th class='th'>Amount</th><th class='th'>Time</th></tr>";

       while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC))
       {
          echo "<tr><td class='td'>";
          echo $row['transaction_id'];
          echo "</td><td class='td'>";
          echo $row['sender'];
          echo "</td><td class='td'>";
          echo $row['account_no'];
          echo "</td><td class='td'>";
          echo $row['recipient'];
          echo "</td><td class='td'>";
          echo $row['amount'];
          echo "</td><td class='td'>";
          echo $row['time'];
          echo "</td></tr>";
       }

       echo "</table>";

       $con->close();

    ?>
    
  </div>

</body>
</html>
