<?php 
require './class/db.php';
require './class/model.php';
require './class/tables.php';

header('Content-Type: application/json');

$id_child = isset($_POST['id_child']) ? $_POST['id_child'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($id_child && $action) {
    $student = student::where('id_child', $id_child);

    if ($student) {
        $data = [
            'id_child' => $student['id_child'],
            'name' => $student['name_arabic'],
            'image' => $student['img'],
            'type' => $student['type'],
            'grade' => $student['grade']
        ];

        if ($action === 'add') {
            $displayCount = display::count_all();

            try {
                if ($displayCount < 25) {
                    // There is space in the display table
                    $result = display::saveArray($data);
                    $response = ['success' => $result !== false, 'message' => 'تمت اضافة الطالب في الشاشة الرئيسية'] ;
                } else {
                    // Display table is full, add to waitlist
                    $result = waitlist::saveArray($data);
                    $response = ['success' => $result !== false, 'message' => 'شاشة العرض ممتلئة، تمت إضافتك إلى قائمة الانتظار'];
                }
            } catch (Exception $e) {
                if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                    $response = ['success' => false, 'message' => 'بيانات مكررة، هذا الطالب تمت اضافتة بالفعل'];
                } else {
                    $response = ['success' => false, 'message' => 'حدث خطأ غير متوقع'];
                }
            }

        } 

    }};

echo json_encode($response);
?>
