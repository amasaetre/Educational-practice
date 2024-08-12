<?php
require_once __DIR__ . '/../models/Task.php';

class TaskController {
    private $taskModel;

    public function __construct() {
        $this->taskModel = new Task();
    }

    public function getTasks() {
        $tasks = $this->taskModel->getAllTasks();
        echo json_encode($tasks);
    }

    public function createTask() {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $this->taskModel->createTask($data['title'], $data['description']);
        echo json_encode(['status' => 'success', 'id' => $id]);
    }

    public function updateTask($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->taskModel->updateTask($id, $data['title'], $data['description']);
        echo json_encode(['status' => 'success']);
    }

    public function deleteTask($id) {
        $this->taskModel->deleteTask($id);
        echo json_encode(['status' => 'success']);
    }
}
