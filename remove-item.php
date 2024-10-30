<?php
  include "dbconn.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST["item-name"];

    $query = "UPDATE items SET active = 0 WHERE name = '$itemName'";
    $result = mysqli_query($conn,$query);
  }
?>

<html lang="en-nz">
  <head>
    <meta charset="utf-8">
    <title>Remove Item</title>
    <link rel="stylesheet" href="stylesheets/remove-item.css">
  </head>
  <body>
    <h1>Remove Item</h1>
    <form method="POST">
      <label for="item-name">Enter Item Name: </label>
      <input type="text" class="noborder" id="item-name" name="item-name" oninput="validate()" style="margin-bottom:20px;" required>

      <button type="submit" id="remove-item-button" onclick="removeItem()" disabled>Delete Item</button>
      <button type="reset" id="cancel-item-deletion-button" onclick="window.parent.document.getElementById('remove-item-container').classList.remove('show');">Cancel Item Deletion</button>
    </form>

    <script src="scripts/remove-item.js"></script>
  </body>
</html>
