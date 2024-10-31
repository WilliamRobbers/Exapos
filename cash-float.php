<?php
  include "dbconn.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_amount = $_POST["start-amount"];

    $query = "INSERT INTO cash_reconciliation (date,start_amount) VALUES (CURRENT_DATE(),$start_amount)";
    $result = mysqli_query($conn,$query);
  }
?>

<html lang="en-nz">
  <head>
    <meta charset="utf-8">
    <title>Cash Float Entry</title>
    <link rel="stylesheet" href="stylesheets/cash-float.css">
  </head>
  <body>
    <h1>CASH FLOAT</h1>
    <form method="POST">
      <label for="start-amount">Enter Cash Float: $</label>
      <input type="text" class="noborder" id="start-amount" name="start-amount" placeholder="0.00" step="0.01" oninput="validate()" pattern="^[\d]+(\.[\d])?[\d]?$" style="margin-bottom:20px;" required>

      <button type="submit" id="begin-day-button" onclick="beginDay()" disabled>Begin day</button>
    </form>

    <script src="scripts/cash-float.js"></script>
    <script></script>
  </body>
</html>
