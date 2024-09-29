function validate() {
  // Beginning of day cash float
  let startAmount = document.getElementById("start-amount");
  // Begin Day Button
  let beginDay = document.getElementById("begin-day-button");
  // Pattern replacing anything except digits and decimal points with nothing
  startAmount.value = startAmount.value.replace(/[^0-9.]/g, '');
  // Forcing max decimal input to 2dp
  startAmount.value = startAmount.value.indexOf(".") >= 0 ? startAmount.value.slice(0, startAmount.value.indexOf(".") + 3) : startAmount.value;

  // Get regex pattern from element
  var pattern = startAmount.getAttribute("pattern");
  var regex = new RegExp(pattern, "g")

  // If start amount matches pattern
  if (regex.test(startAmount.value)) {
    // Enable button
    beginDay.disabled = false;
  } else { // If start amount doesn't match pattern
    beginDay.disabled = true;
  }
}

function beginDay() {
  window.parent.document.getElementById('cash-float-container').classList.remove("show");
}
