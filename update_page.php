<?php 
require './class/db.php';
require './class/model.php';
require './class/tables.php';

header('Content-Type: application/json');

function updateDisplay() {
    $displayCount = display::count_all();

    if ($displayCount < 10) {
        $nextItem = waitlist::all_sql('ORDER BY id LIMIT 1');

        if ($nextItem) {
            $nextItem = $nextItem[0];
            display::saveArray([
                'id_child' => $nextItem['id_child'],
                'name' => $nextItem['name'],
                'image' => $nextItem['image'],
                'type' => $nextItem['type']
            ]);
            $id = $nextItem['id'];
            waitlist::custom_sql("delete from `waitlist` WHERE `id` = ".$id."");
        }
    }
}

updateDisplay();
