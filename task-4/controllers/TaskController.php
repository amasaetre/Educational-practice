<?php

require_once 'models/Task.php';

class TaskController
{
    private $taskModel;

    public function __construct($pdo)
    {
        $this->taskModel = new Task($pdo);
    }

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'create':
                        $this->createTask();
                        break;
                    case 'delete':
                        $this->deleteTask();
                        break;
                    case 'update':
                        $this->updateTask();
                        break;
                }
            }
        }
    }

    public function getTasks()
    {
        return $this->taskModel->getAllTasks();
    }

    private function createTask()
    {
        $title = $_POST['title'] ?? '';
        $dueDate = $_POST['due_date'] ?? null;
        $priority = $_POST['priority'] ?? 0;

        if ($this->taskModel->createTask($title, $dueDate, $priority)) {
            header('Location: index.php');
            exit;
        }
    }

    private function deleteTask()
    {
        $id = $_POST['id'] ?? 0;

        if ($this->taskModel->deleteTask($id)) {
            header('Location: index.php');
            exit;
        }
    }

    private function updateTask()
    {
        $id = $_POST['id'] ?? 0;
        $title = $_POST['title'] ?? '';
        $dueDate = $_POST['due_date'] ?? null;
        $priority = $_POST['priority'] ?? 0;

        if ($this->taskModel->updateTask($id, $title, $dueDate, $priority)) {
            header('Location: index.php');
            exit;
        }
    }
}
