function addItem(itemId, itemName) {
  if (document.getElementById(itemId) == null) { //If item is not currently in cart
    //Create row div
    var row = document.createElement("div");
    row.setAttribute("class", "row");
    row.setAttribute("id", itemId);

    //Create child element for remove item button
    var delItem = document.createElement("div")
    delItem.setAttribute("class", "td removeButton");
    delItem.addEventListener("click", ()=>{removeItem(itemId)});
    delItem.textContent = "X";

    //Create child element for item description
    var itemCol = document.createElement("div");
    itemCol.setAttribute("class", "td");
    itemCol.setAttribute("style", "width:65%");
    itemCol.textContent = itemName;

    //Create child element for item price
    var priceCol = document.createElement("div");
    priceCol.setAttribute("class", "td");
    priceCol.setAttribute("style", "width:20%");

    //Create child element for item quantity in cart
    var qtyCol = document.createElement("div");
    qtyCol.setAttribute("class", "td");
    qtyCol.setAttribute("style", "width:15%");
    qtyCol.textContent = 1; //Default quantity of 1

    //Add children to parent row div
    row.appendChild(delItem);
    row.appendChild(itemCol);
    row.appendChild(priceCol);
    row.appendChild(qtyCol);

    //Add row to cart div
    document.getElementById("cart").appendChild(row);
  }

  else { //Item is already in cart
    var qty = Number(document.getElementById(itemId).children[3].textContent);
    document.getElementById(itemId).children[3].textContent = qty+1;
  }
}

function clearCart() {
  var rows = document.getElementsByClassName("row");
  while (rows.length > 1) { //Index 0 is the header, don't remove that
    rows[1].remove(); //rows array shrinks every removal
  }
}

function removeItem(itemId) {
  document.getElementById(itemId).remove(); //Remove element by id that is passed to function
}
