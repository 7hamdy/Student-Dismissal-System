<?php 
require './class/db.php';
require './class/model.php';
require './class/tables.php';

header('Content-Type: application/json'); // Set the content type to JSON

// Retrieve and sanitize the id_child from the query string
$id_child = isset($_GET['id_child']) ? $_GET['id_child'] : '';

$father_in_diplay = display::where('id_child',$id_child);
$father_in_waitlist = waitlist::where('id_child',$id_child);

if ($father_in_diplay) {
    // Handle the case when found in display
    $id_child = $father_in_diplay['id_child'];
    $result = display::deleteByChildId($id_child);
    if ($result) {
        $response = [
            'success' => [
                'message' => 'ولي الامر بالخارج : الي القاء'
            ]
        ];
    } else {
        $response = [
            'error' => [
                'message' => 'فشل في حذف بيانات العرض'
            ]
        ];
    }
} else if ($father_in_waitlist) {
    // Handle the case when found in waitlist
    $id_child = $father_in_waitlist['id_child'];
    $result = waitlist::deleteByChildId($id_child);
    if ($result) {
        $response = [
            'success' => [
                'message' => 'ولي الامر بالخارج : الي القاء'
            ]
        ];
    } else {
        $response = [
            'error' => [
                'message' => 'فشل في حذف بيانات الانتظار'
            ]
        ];
    }
} else {
    // Handle the case where no data is found
    $response = [
        'error' => [
            'message' => 'ولي الامر غير موجود بالخارج : الرجاء الانتظار'
        ]
    ];
}

// Output the JSON response
echo json_encode($response);
?>