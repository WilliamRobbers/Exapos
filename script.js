var items = 20;

for (let i=0; i<items; i++) {
  var div = document.createElement("div");
  var label = document.createElement("p");
  div.setAttribute("class", "button");
  div.addEventListener("click", ()=>{addItem(i)});

  //label.textContent = i;
  label.setAttribute("class", "button-label")
  div.appendChild(label);
  document.getElementById("buttonMatrix").appendChild(div);
}

function addItem(i) {
  if (document.getElementById(i) == null) { //If item is not currently in cart
    var row = document.createElement("div");
    row.setAttribute("class", "row");
    row.setAttribute("id", i);

    var itemCol = document.createElement("div");
    itemCol.setAttribute("class", "td");
    itemCol.setAttribute("style", "width:65%");
    itemCol.textContent = i;

    var priceCol = document.createElement("div");
    priceCol.setAttribute("class", "td");
    priceCol.setAttribute("style", "width:20%");

    var qtyCol = document.createElement("div");
    qtyCol.setAttribute("class", "td");
    qtyCol.setAttribute("style", "width:15%");
    qtyCol.textContent = 1;

    row.appendChild(itemCol);
    row.appendChild(priceCol);
    row.appendChild(qtyCol);

    document.getElementById("order").appendChild(row);
  }

  else { //Item is already in cart
    var qty = Number(document.getElementById(i).children[2].textContent);
    document.getElementById(i).children[2].textContent = qty+1;
  }


}
