<?php

require './class/db.php';
require './class/model.php';
require './class/tables.php';

header('Content-Type: application/json');

// Extract grade parameter from the URL and sanitize it
$grade = isset($_GET['grade']) ? model::secure($_GET['grade']) : null;

// Fetch records from the display table based on the grade
if ($grade) {
    $displayItems = display::where_grade('grade', $grade);
} else {
    $displayItems = display::all();
}

echo json_encode($displayItems);
?>
