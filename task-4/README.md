### Разработка динамического веб-приложения с использованием PHP, HTML, CSS

Я использовал MAMP <br>
Apache Port: 80 <br>
MySQL Post: 3306

```
CREATE DATABASE task_manager;

USE task_manager;

CREATE TABLE tasks ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    due_date DATE NULL,
    priority INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```