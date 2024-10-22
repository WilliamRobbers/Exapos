<html lang="en-nz">
  <head>
    <meta charset="utf-8">
    <title>Create New Item</title>
    <link rel="stylesheet" href="stylesheets/create-new-item.css">
  </head>
  <body>
    <h1>Create New Item</h1>
    <form method="POST">
      <label for="item-name">Enter Item Name: </label>
      <input type="text" class="noborder" id="item-name" oninput="validate()" style="margin-bottom:20px;" required>
      <br>
      <label for="item-price">Enter Item Price: $</label>
      <input type="text" class="noborder" id="item-price" placeholder="0.00" step="0.01" oninput="validate()" pattern="^[\d]+(\.[\d])?[\d]?$" style="margin-bottom:20px;" required>


      <button type="submit" id="create-new-item-button" onclick="createItem()" disabled>Create Item</button>
      <button type="reset" id="cancel-item-creation-button" onclick="window.parent.document.getElementById('create-new-item-container').classList.remove('show');">Cancel Item Creation</button>
    </form>

    <script src="scripts/create-new-item.js"></script>
  </body>
</html>
