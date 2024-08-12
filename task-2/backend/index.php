<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

require_once 'controllers/TaskController.php';

$method = $_SERVER['REQUEST_METHOD'];
$controller = new TaskController();

switch ($method) {
    case 'GET':
        $controller->getTasks();
        break;
    case 'POST':
        $controller->createTask();
        break;
    case 'PUT':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->updateTask($id);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID not provided']);
        }
        break;
    case 'DELETE':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->deleteTask($id);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID not provided']);
        }
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        break;
}
