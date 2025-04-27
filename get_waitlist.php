<?php

require './class/db.php';
require './class/model.php';
require './class/tables.php';


header('Content-Type: application/json');

// Fetch all records from the waitlist table
$waitlistItems = waitlist::all();

echo json_encode($waitlistItems);
?>
