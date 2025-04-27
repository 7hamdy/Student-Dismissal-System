<?php 
require './class/db.php';
require './class/model.php';
require './class/tables.php';
require './includes/header.php';
require './includes/nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Display</title>
    <style>
        .custom-alert {
            display: none;
            position: fixed;
            top: 100px;
            right: 50px;
            background-color: #f44336;
            color: white;
            padding: 15px;
            border-radius: 30px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        #displayContainer, #waitListContainer {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }
        .displayItem {
            border: 15px groove #ddddddf1;
            padding: 1px;
            text-align: center;
        }
        .displayItem img {
            max-width: 100%;
            height: 250px;
        }
        #qr-reader {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .centered-div {
            text-align: center;
            width: 500px;
            margin-bottom: 10px;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        .input-field:focus {
            border-color: #007bff;
            outline: none;
        }
        .input-field::placeholder {
            color: #888;
        }
        .btn-scan {
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-scan:hover {
            background-color: #0056b3;
        }
    </style>
    <script src="./assets/js/html5-qrcode.min.js"></script>
</head>
<body>
    <div id="qr-reader" class="center"></div>
    <div class="container" style="margin-top: 100px;">
        <div class="centered-div" dir="rtl">
            <input style="text-align: center;" class="input-field" type="text" name="username" id="username" placeholder="هوية الطالب" aria-label="Username" required>
            <button class="btn-scan" style="margin-top:50px; background-color:#183288" id="btnScan">Scan QR Code</button>
        </div>
    </div>
    <div id="qr-reader" class="center"></div>
    <div id="alertBox" class="custom-alert"></div>

    <script>
    const maxDisplayCount = 25;
    const usernameInput = document.getElementById("username");
    const btnScan = document.getElementById("btnScan");
    const qrReader = document.getElementById("qr-reader");
    let html5QrCode;


function handleUserInput() {
    const id_child = usernameInput.value.trim();
    if (id_child) {
        // Check if the id_child is exist in display and waitliste
        fetch(`verify_student.php?id_child=${encodeURIComponent(id_child)}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                showAlert(data.success.message); // Fixed data.success.message
            } else {
                showAlert(data.error.message);
            }
        })
        .catch((error) => {
            // Handle network or other errors
            showAlert('An error occurred: ' + error.message);
        });
        usernameInput.value = "";
    }
}
function handle_Input_Camera(decodedText) {
    if (decodedText) {
        // Check if the id_child is exist in display and waitliste
        fetch(`verify_student.php?id_child=${encodeURIComponent(decodedText)}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                showAlert(data.success.message); // Fixed data.success.message
            } else {
                showAlert(data.error.message);
            }
        })
        .catch((error) => {
            // Handle network or other errors
            showAlert('An error occurred: ' + error.message);
        });
        usernameInput.value = "";
    }
}
function onScanSuccess(decodedText, decodedResult) {
    handle_Input_Camera(decodedText);
       // Stop the scanning process
       html5QrCode.stop().catch((error) => {
            console.error("Error stopping QR code scan:", error);
        });
        qrReader.style.display = "none"; // Hide the QR reader
}


    function onScanError(errorMessage) {
        console.warn("QR code scan error:", errorMessage);
    }

    function startScanning() {
    console.log("Starting QR code scanner...");
    qrReader.style.display = "block"; // Show the QR reader

    html5QrCode = new Html5Qrcode("qr-reader");

    html5QrCode.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: 250
        },
        onScanSuccess,
        onScanError
    ).catch((error) => {
        console.error("Error starting QR code scan:", error);
    });
}


    btnScan.addEventListener("click", startScanning);

    usernameInput.addEventListener("change", handleUserInput);
    
    function showAlert(message, duration = 3000) {
    const alertBox = document.getElementById("alertBox");
    alertBox.textContent = message;
    alertBox.style.display = "block";
    setTimeout(() => {
        alertBox.style.display = "none";
    }, duration);
    }
    </script>
</body>
</html>
