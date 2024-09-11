var items = 20;

for (let i=0; i<items; i++) {
  var div = document.createElement("div");
  var label = document.createElement("p");
  div.setAttribute("class", "button");
  div.addEventListener("click", ()=>{addItem(i)});

  label.textContent = i;
  label.setAttribute("class", "button-label")
  div.appendChild(label);
  document.getElementById("buttonMatrix").appendChild(div);
}

function addItem(i) {
  if (document.getElementById(i) == null) { //If item is not currently in cart
    //Create row div
    var row = document.createElement("div");
    row.setAttribute("class", "row");
    row.setAttribute("id", i);

    //Create child element for remove item button
    var delItem = document.createElement("div")
    delItem.setAttribute("class", "td removeButton");
    delItem.addEventListener("click", ()=>{removeItem(i)});
    delItem.textContent = "X";

    //Create child element for item description
    var itemCol = document.createElement("div");
    itemCol.setAttribute("class", "td");
    itemCol.setAttribute("style", "width:65%");
    itemCol.textContent = i;

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
    var qty = Number(document.getElementById(i).children[3].textContent);
    document.getElementById(i).children[3].textContent = qty+1;
  }
}

function clearCart() {
  var rows = document.getElementsByClassName("row");
  while (rows.length > 1) { //Index 0 is the header, don't remove that
    rows[1].remove(); //rows array shrinks every removal
  }
}

function removeItem(item) {
  document.getElementById(item).remove();
}
