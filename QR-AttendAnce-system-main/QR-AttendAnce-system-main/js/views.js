function loadView(viewUrl) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("viewContainer").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", viewUrl, true);
    xhttp.send();
}