// Open the popup
function openForm(popupId) {
    var myForm = document.getElementById(popupId);
    myForm.style.display = "block";

    // Calculate the position to center the popup
    var screenWidth = window.innerWidth;
    var screenHeight = window.innerHeight;
    var popupWidth = myForm.offsetWidth;
    var popupHeight = myForm.offsetHeight;

    // Set the position to center the popup
    myForm.style.top = (screenHeight - popupHeight) / 2 + "px";
    myForm.style.left = (screenWidth - popupWidth) / 2 + "px";

    // Make the popup draggable
    dragElement(myForm);
}

// Close the popup
function closeForm(popupId) {
    document.getElementById(popupId).style.display = "none";
}

// Make the popup draggable
function dragElement(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    var header = elmnt.querySelector(".close");

    if (header) {
        // if present, the close button is where you move the DIV from:
        header.onmousedown = dragMouseDown;
    } else {
        // otherwise, move the DIV from anywhere inside the DIV:
        elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
        if (e.target.tagName === 'BUTTON') return; // Do not drag when clicking on button
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        // stop moving when mouse button is released:
        document.onmouseup = null;
        document.onmousemove = null;
    }
}
