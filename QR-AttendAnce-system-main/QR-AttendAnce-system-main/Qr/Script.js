document.addEventListener("DOMContentLoaded", function() {
    let qrcode = new QRCode(document.querySelector(".qrcode"));
    let courseCodeInput = document.querySelector("#courseCode");
    let qrcodeDiv = document.querySelector(".qrcode");

    // Function to generate QR code based on course code 
    function generateQr() { 
        let courseCode = courseCodeInput.value.trim();
        
        if (!courseCode) { 
            alert("Course code cannot be blank!");
        } else { 
            let url = "https://pyiga.w3spaces.com/index.html?" + encodeURIComponent(courseCode); // Append the course code as a query parameter
            qrcode.clear(); // Clear existing QR code
            qrcode.makeCode(url); // Generate new QR code
            qrcodeDiv.style.display = "block"; // Show the QR code after generating
        }
    }

    // Event listener for Generate button
    document.querySelector("button").addEventListener("click", generateQr);

    // Hide the QR code initially
    qrcodeDiv.style.display = "none";
});
