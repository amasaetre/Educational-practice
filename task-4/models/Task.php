<?php

class Task
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllTasks()
    {
        $stmt = $this->pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createTask($title, $dueDate, $priority)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (title, due_date, priority) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $dueDate, $priority]);
    }

    public function deleteTask($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateTask($id, $title, $dueDate, $priority)
    {
        $stmt = $this->pdo->prepare("UPDATE tasks SET title = ?, due_date = ?, priority = ? WHERE id = ?");
        return $stmt->execute([$title, $dueDate, $priority, $id]);
    }
}
