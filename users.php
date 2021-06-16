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

       $sql = "SELECT * FROM `users`;";

       $sqldata= $con->query($sql);
       if($sqldata== true)
       {
            $found=true;
       }

       echo "<table>";
       echo "<tr><th>Account Number</th><th>Username</th><th>Account Type</th><th>Balance</th><th>Transact</th><th>View</th></tr>";

       while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC))
        {
          $i = '"' . $row['username'].'"';
          echo "<tr><form method='post' action='transact.php'>";
          echo "<td>";
          echo $row['account_no'];
          echo "</td><td>";
          echo $row['username'];
          echo "</td><td>";
          echo ucwords($row['account_type']);
          echo "</td><td>";
          echo $row['amount'];
          echo "</td><td>";
          echo "<input type='submit' id='users' value='Transfer'>";
          echo "<input type='hidden' value=$i name='user'>";
          echo "</td></form>";
          echo "<form method='post' action='info.php'>";
          echo "<td>";
          echo "<input type='submit' id='view' value='View'>";
          echo "<input type='hidden' value=$i name='view'>";
          echo "</td></form></tr>";
        }

        echo "</table>";

        $con->close();
    ?>

  </div>

</body>
</html>
