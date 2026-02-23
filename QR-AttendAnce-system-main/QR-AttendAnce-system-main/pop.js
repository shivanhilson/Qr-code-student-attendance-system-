// Open the popup
function openForm(popupId) {
  var myForm = document.getElementById(popupId);
  myForm.style.display = "block";

  // Calculate the position to center the popup
  var screenWidth = window.innerWidth;
  var screenHeight = window.innerHeight;
  var popupWidth = myForm.offsetWidth;
  var popupHeight = myForm.offsetHeight;

  // Set the position to center the popup with a small offset
  myForm.style.top = Math.max((screenHeight - popupHeight) / 2, 20) + "px";
  myForm.style.left = (screenWidth - popupWidth) / 2 + "px";
}

// Close the popup
function closeForm(popupId) {
  document.getElementById(popupId).style.display = "none";
}
