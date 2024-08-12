<?php
require_once 'config.php';
require_once 'controllers/TaskController.php';

$controller = new TaskController($pdo);


$controller->handleRequest();

$tasks = $controller->getTasks();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Планировщик задач</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h1>Планировщик задач</h1>
<form action="index.php" method="POST">
    <input type="hidden" name="action" value="create">
    <input type="text" name="title" placeholder="Task title" required>
    <input type="date" name="due_date">
    <select name="priority">
        <option value="0">Низкий</option>
        <option value="1">Средний</option>
        <option value="2">Высокий</option>
    </select>
    <button type="submit">Добавить задачу</button>
</form>

<ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <form action="index.php" method="POST" style="display:inline;">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <?= htmlspecialchars($task['title']) ?> - <?= $task['due_date'] ?>
                <button type="submit">Delete</button>
            </form>

        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
