# Task 1 – PHP Backend Learning Notes

## Introduction

In this task I followed the **PHP for Beginners** course by Jeffrey Way on Laracasts.
During the course I learned the basics of building a backend using PHP, organizing code, connecting to a database, and protecting applications from security vulnerabilities such as SQL Injection.

The goal of the project was to build a small PHP application step by step while understanding how backend systems work.

---

# 1. Project Structure

Instead of writing all the code in one file, we organize the project into multiple folders and files.

Example structure:

IEEE-ZSB-Backend-PHP/

docs/
task-1.md

views/

controllers/

index.php

functions.php

### Why project structure is important

Organizing the project helps in:

- making the code easier to read
- separating responsibilities
- making debugging easier
- allowing multiple developers to work on the project

For example:

- **controllers** handle the logic
- **views** display the pages
- **functions.php** contains reusable functions

---

# 2. Routing Concept

Routing means deciding which page should load depending on the URL.

Example:

```php
$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/') {
    require 'views/index.view.php';
} elseif ($uri === '/about') {
    require 'views/about.view.php';
}
```

Here the application checks the requested URL and loads the appropriate page.

This is a simple way to simulate routing like modern frameworks.

---

# 3. Superglobals in PHP

Superglobals are special built-in variables in PHP that can be accessed from anywhere in the script.

Examples include:

- $\_GET
- $\_POST
- $\_SERVER
- $\_SESSION
- $\_COOKIE

Example:

```php
$id = $_GET['id'];
```

This retrieves a value from the URL.

Example URL:

```
localhost/page.php?id=5
```

The value **5** will be stored in `$id`.

Superglobals are useful for receiving data from forms, URLs, or server information.

---

# 4. The require Statement

The `require` statement is used to include another file in the current PHP script.

Example:

```php
require 'functions.php';
```

This means the code inside `functions.php` will be executed in this file.

Why it is useful:

- separates code into smaller files
- avoids repeating the same code
- makes the project easier to maintain

If the required file does not exist, PHP will stop the script and throw an error.

---

# 5. Functions in PHP

Functions allow us to reuse code instead of repeating it many times.

Example:

```php
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
```

This function is used to debug variables by printing them in a readable format.

---

# 6. Connecting PHP to a Database

Web applications usually need to store data in a database.

In this course we used **MySQL** with **PDO**.

PDO stands for **PHP Data Objects**.

It is a safer and more flexible way to connect to databases.

Example connection:

```php
$dsn = "mysql:host=localhost;dbname=myapp;charset=utf8";

$pdo = new PDO($dsn, "root", "");
```

After creating the connection, we can run SQL queries.

---

# 7. Running SQL Queries

Example:

```php
$query = $pdo->query("SELECT * FROM posts");

$posts = $query->fetchAll();
```

Explanation:

- `query()` sends SQL to the database
- `fetchAll()` retrieves all rows returned by the query

The data can then be displayed in the views.

---

# 8. SQL Injection

SQL Injection is a serious security vulnerability.

It happens when user input is inserted directly into an SQL query.

Example of vulnerable code:

```php
$query = "SELECT * FROM users WHERE id = " . $_GET['id'];
```

If a malicious user enters something like:

```
1 OR 1=1
```

The query becomes:

```
SELECT * FROM users WHERE id = 1 OR 1=1
```

This may return all users in the database.

Attackers can sometimes even delete or modify data.

---

# 9. Prepared Statements

Prepared statements are used to prevent SQL injection.

Instead of directly inserting user input into the query, the database treats the input as data only.

Example:

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");

$stmt->execute([$id]);

$user = $stmt->fetch();
```

Benefits:

- prevents SQL injection
- safer database queries
- separates SQL logic from user input

Prepared statements are considered a best practice in PHP applications.

---

# 10. MVC-Like Separation

During the project we also started separating the application into parts similar to the MVC pattern.

MVC stands for:

- Model
- View
- Controller

In our simple project:

controllers → application logic
views → display HTML
database queries → data layer

This structure helps organize the project and makes it easier to expand later.

---

# Conclusion

From this course I learned how backend development works using PHP.
I learned how to structure a project, use routing, work with superglobals, connect to a database using PDO, and protect applications from SQL injection using prepared statements.

These concepts are fundamental for building secure and maintainable web applications.
