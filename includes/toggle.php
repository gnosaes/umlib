<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$db = new PDO('mysql:host=127.0.0.1;dbname=DATABASE;charset=utf8mb4', 'USERNAME', 'PASSWORD');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['toggle_update'])) {
        $update = $db->prepare("UPDATE `toggle` SET `status` = ? WHERE `id` = 1 LIMIT 1;");
        $update->execute([$_POST['status']]);
        echo json_encode($_POST);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['toggle_select'])) {
        $select = $db->prepare("SELECT `status` FROM `toggle` WHERE `id` = 1 LIMIT 1;");
        $select->execute();
        echo json_encode($select->fetchColumn());
    } elseif (isset($_GET['toggle_updated'])) {
        $select = $db->prepare("SELECT date_format(updated, '%e %b %l:%i:%s %p') as updated FROM `toggle` WHERE `id` = 1 LIMIT 1;");
        $select->execute();
        echo json_encode($select->fetchColumn());
    }
} else {
    echo json_encode(array());
}