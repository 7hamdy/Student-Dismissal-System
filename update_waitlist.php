<?php 
require './class/db.php';
require './class/model.php';
require './class/tables.php';


header('Content-Type: application/json');

$studentId = isset($_POST['username']) ? $_POST['username'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($studentId && $action) {
    $student = student::where('id_child', $studentId);
    if ($student) {
        $data = [
            'student_id' => $studentId,
            'name' => $student['name_arabic'],
            'image' => $student['img'],
            'type' => $student['type']
        ];

        if ($action === 'add') {
            $result = waitlist::saveArray($data);
            $response = ['success' => $result !== false];
        } elseif ($action === 'remove') {
            $result = waitlist::where('student_id', $studentId);
            if ($result) {
                waitlist::delete();
                $response = ['success' => true];
            } else {
                $response = ['success' => false, 'message' => 'Item not found in waitlist'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Invalid action'];
        }
    } else {
        $response = ['success' => false, 'message' => 'Student not found'];
    }
} else {
    $response = ['success' => false, 'message' => 'Missing parameters'];
}
echo json_encode($response);
?>
