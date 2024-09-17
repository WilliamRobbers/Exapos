let cart = []; // Associative array to store cart contents
let total = 0;

function addToCart(itemId, itemName, itemPrice) {
  // Find itemId in cart array
  const itemIndex = cart.findIndex(item => item.itemId === itemId);

  if (itemIndex !== -1) {
    // Item already in cart, increase quantity
    cart[itemIndex].itemQuantity++;
  } else {
    // Item not in cart, add new item
    cart.push({ itemId, itemName, itemPrice, itemQuantity: 1 });
  }

  updateCart();
}

// Remove all items from cart
function clearCart() {
  // Empty the cart and update
  cart = [];
  updateCart();
}

// Remove specific item from cart
function removeItem(itemId) {
  // Find itemId in cart array
  const itemIndex = cart.findIndex(item => item.itemId === itemId);

  // Remove 1 item from cart array starting at itemIndex (remove item at index)
  cart.splice(itemIndex, 1);

  updateCart();
}

// Update cart display on UI
function updateCart() {
  // Variable declarations
  const cartElement = document.getElementById('cart');
  const orderTotalElement = document.getElementById('orderTotal');
  total = 0;

  // Always create header row
  cartElement.innerHTML = `
    <div class="row" id="cartHeaderRow" style="margin-top:10px;">
      <div class="td header" id="clearCartButton" onclick="clearCart()">X</div>
      <div class="td header" style="width:65%">Item</div>
      <div class="td header" style="width:20%">Price</div>
      <div class="td header" style="width:15%">Qty</div>
    </div>
  `;

  // For each item in cart array, create new row on UI
  cart.forEach(item => {
    // Retrieve item details from cart
    let id = item.itemId;
    let name = item.itemName;
    let price = item.itemPrice;
    let qty = item.itemQuantity;

    // Append row to cart with item information
    cartElement.innerHTML += `
      <div class="row" id="${id}">
        <div class="td removeButton" onclick='removeItem(${id})'>X</div>
        <div class="td" style="width:65%">${name}</div>
        <div class="td" style="width:20%">$${price}</div>
        <div class="td" style="width:15%"><input type="number" style="width:100%;" value="${qty}" onchange="changeQty(${id}, this.value)" min=1 /></div>
      </div>
    `;

    // Add sum of item price to total
    total += (price * qty);
  });

  // Set order total label to calculated total
  orderTotalElement.textContent = total.toFixed(2);
}

// Change quantity with spinbuttons
function changeQty(itemId, newQty) {
  // Find itemId in cart array
  const itemIndex = cart.findIndex(item => item.itemId === itemId);
  // Update quantity in cart
  cart[itemIndex].itemQuantity = newQty;

  updateCart();
}

let cash = document.getElementById("cash");
let modalCash = document.getElementById("cash-modal");
let cancelCash = document.getElementById("cancel-cash");
let cashDue = document.getElementById("modal-cash-due");
cash.addEventListener("click", () => {modalCash.classList.add("show");cashDue.textContent = total.toFixed(2);});
cancelCash.addEventListener("click", () => {modalCash.classList.remove("show")});

let eftpos = document.getElementById("eftpos");
let modalEftpos = document.getElementById("eftpos-modal");
let cancelEftpos = document.getElementById("cancel-eftpos");
let eftposDue = document.getElementById("modal-eftpos-due");
eftpos.addEventListener("click", () => {modalEftpos.classList.add("show");eftposDue.textContent = total.toFixed(2);});
cancelEftpos.addEventListener("click", () => {modalEftpos.classList.remove("show")});
