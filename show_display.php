<?php 
require './class/db.php';
require './class/model.php';
require './class/tables.php';
require './includes/header.php';
require './includes/nav.php';
require './includes/core.php';

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
            top: 20px;
            right: 20px;
            background-color: #f44336;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        #displayContainer {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 5px;
            margin-bottom: 20px;
        }
        .displayItem {
            border: 10px groove #ddddddf1;
            padding: 1px;
            text-align: center;
        }
        .displayItem img {
            max-width: 100%;
            height: 175px;
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
    </style>
</head>
<body>
    <div id="displayContainer"></div>
    <div id="alertBox" class="custom-alert"></div>

    <script>        
function get_Display() { 


const urlParams = new URLSearchParams(window.location.search);
const gradeParam = urlParams.get('grade');
let fetchUrl = 'get_display.php';

if (gradeParam) {
    fetchUrl += `?grade=${gradeParam}`;
}

fetch(fetchUrl)
            .then(response => response.json())
            .then(data => {
                displayContainer.innerHTML = "";
                data.forEach(({ name, image, type , date}) => {
                

// Create a Date object
const date_time = new Date(date); // Make sure `date` is defined

// Extract hours, minutes, and seconds
let hours = date_time.getHours();
const minutes = date_time.getMinutes().toString().padStart(2, '0');
const seconds = date_time.getSeconds().toString().padStart(2, '0');

// Determine AM or PM
const amPm = hours >= 12 ? 'م' : 'ص'; // Arabic PM (م) and AM (ص)

// Convert hours to 12-hour format
hours = hours % 12 || 12; // Convert hour "0" to "12"

// Format hours with leading zero if needed
const formattedHours = hours.toString().padStart(2, '0');

// Function to convert Western digits to Arabic numerals
const toArabicNumerals = (numberString) => {
    const arabicNumerals = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    return numberString.split('').map(digit => arabicNumerals[digit]).join('');
};

// Format the time as HH:MM:SS AM/PM with Arabic numerals
const time = `${toArabicNumerals(formattedHours)}:${toArabicNumerals(minutes)}:${toArabicNumerals(seconds)} ${amPm}`;



        if (image == 0 && type == 1) image = 'boy.jpg';
        else if (image == 0 && type == 2) image = 'girl.jpg';

        const itemDiv = document.createElement("div");
        itemDiv.className = "displayItem";
        itemDiv.innerHTML = `
        <img src="./assets/image/${image}" alt="${name}">
        <p style="font-size: 25px; font-weight: bold;">${name}</p>
        <p style = "font-size: 20px ; font-weight:bold">${time}</p>
        `;
        displayContainer.appendChild(itemDiv);
        });
        })
            .catch(error => {
                console.error('Error fetching display data:', error);
            });
 }
  
        // function fetchUpdates() {
        //     fetch('update_page.php');
        // }

        function showAlert(message, duration = 3000) {
            const alertBox = document.getElementById('alertBox');
            alertBox.textContent = message;
            alertBox.style.display = 'block';
            
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, duration);
        }

        function startPolling() {
            // Polling every < 1  seconds
            setInterval(() => {
                get_Display();
            }, 300);
        }
        // updateDisplay();
        startPolling();
    </script>
</body>
</html>
