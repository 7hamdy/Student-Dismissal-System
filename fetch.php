<?php 
require './class/db.php';
require './class/model.php';
require './class/tables.php';

header('Content-Type: application/json'); // Set the content type to JSON

// Retrieve and sanitize the username from the query string
$id_child = isset($_GET['id_child']) ? $_GET['id_child'] : '';

if ($id_child) {

    $student = student::where('id_child',$id_child);
      if($student){
        $response = array(
            'success' => true,
            'name' => $student['name_arabic'],
            'image' => $student['img'],
            'type' => $student['type'],
            'id_child' => $student['id_child'],
            'id_father' => $student['id_father'],

        );
    } else {
        
        $response = array('success' => false, 'message' => 'لا يوجد بيانات الطالب ');
    }

} else {
    $response = array('success' => false, 'message' => 'No username provided');
}
echo json_encode($response);
?>
