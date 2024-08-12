### Разработка информационной системы с использованием React и PHP

```
npm install
```

```
cd frontend
```

```
npm start
```

Я использовал MAMP <br>
Apache Port: 80 <br>
MySQL Post: 3306

```
CREATE DATABASE todo_app;

USE todo_app;
tasks CREATE TABLE tasks ( 
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
description TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
);
```