function validate() {
  // Item name input field
  let itemName = document.getElementById("item-name");
  // Remove Item Button
  let removeItem = document.getElementById("remove-item-button");

  // If something is entered
  if (itemName.value.length > 0) {
    // Enable button
    removeItem.disabled = false;
  } else { // If nothing is entered
    removeItem.disabled = true;
  }
}

function removeItem() {
  window.parent.document.getElementById('remove-item-container').classList.remove("show");
  // Post a message to the index page
  window.parent.postMessage('refreshbuttonmatrix', '*');
}
