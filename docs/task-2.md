# Task 2 – PHP Backend Learning Notes

## Introduction

In this task I continued following the **PHP for Beginners** course by Jeffrey Way.
In this part, I learned more about handling data inside the application, improving security, and organizing the backend logic.

The focus was on working with database tables, rendering pages, handling forms, validating user input, and controlling access to resources.

---

# 1. Database Tables and Indexes

## Database Tables

Database tables are used to store application data in an organized way.

Each table contains:

- Columns → represent fields (id, title, body, user_id)
- Rows → actual stored records

Example:

```sql
CREATE TABLE notes (
    id INT PRIMARY KEY,
    body TEXT,
    user_id INT
);
```

Tables allow us to store and retrieve structured data efficiently.

---

## Indexes

Indexes are used to improve query performance.

Instead of scanning the whole table, the database uses indexes to quickly find data.

Example:

```sql
CREATE INDEX idx_user_id ON notes(user_id);
```

### Why indexes are important

- Faster data retrieval
- Better performance for large tables
- Useful when searching or filtering data

---

# 2. Rendering Notes and Pages

Rendering means displaying data from the database to the user.

### How it works

- Controller fetches data from the database
- Data is passed to the view
- View displays the data

Example (Controller):

```php
$notes = $db->query("SELECT * FROM notes")->fetchAll();

require "views/notes.view.php";
```

Example (View):

```php
<?php foreach ($notes as $note): ?>
    <p><?= $note['body'] ?></p>
<?php endforeach; ?>
```

This separates logic from presentation.

---

# 3. Authorization

Authorization ensures that users can only access what they are allowed to.

Example:

A user should not access another user’s note.

```php
if ($note['user_id'] !== $_SESSION['user_id']) {
    abort(403);
}
```

### Important concept

- Authentication → Who are you?
- Authorization → What are you allowed to do?

Authorization is important for protecting user data.

---

# 4. Forms and Request Methods

## Forms

Forms are used to send data from the user to the server.

Example:

```html
<form method="POST" action="/notes">
    <input type="text" name="body" />
    <button type="submit">Add Note</button>
</form>
```

---

## HTTP Request Methods

### GET

- Used to retrieve data
- Data appears in the URL

### POST

- Used to send data
- More secure than GET

### PATCH / PUT

- Used to update data

### DELETE

- Used to delete data

Each method has a specific purpose in web applications.

---

# 5. Always Escape Untrusted Inputs

Any input coming from users is considered untrusted.

If we display it directly, it can cause security issues like XSS.

### Unsafe example:

```php
echo $note['body'];
```

### Safe example:

```php
echo htmlspecialchars($note['body']);
```

### Why this is important

- Prevents JavaScript injection
- Protects users from malicious code
- Keeps the application secure

---

# 6. Form Validation

Validation ensures that user input is correct before saving it.

### Basic example:

```php
if (empty($_POST['body'])) {
    $errors['body'] = "Body is required";
}
```

---

## Using a Validator Class

Instead of repeating validation logic, we can create a reusable class.

Example:

```php
if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = "Body must be between 1 and 1000 characters";
}
```

### Benefits of validation

- Prevents invalid data
- Improves user experience
- Keeps database clean

---

# Conclusion

In this part, I learned how to work with database tables and indexes, render data in views, and handle user input through forms.

I also learned important security concepts like authorization and escaping untrusted inputs, as well as validating data before storing it.

These concepts are essential for building secure and well-structured backend applications.
