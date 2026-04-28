# Task 18 - MVC Part 2

## 1. The Controller's Job

When a user clicks a button like "View Profile", the Controller acts as the middle layer between the user and the system.

Step by step:

- It receives the request from the user (HTTP request).
- It determines what action should be taken (e.g., show profile).
- It calls the Model to fetch the required data (like user info from the database).
- It processes or organizes that data if needed.
- It sends the data to the View.
- Finally, it returns the rendered View (HTML page) to the user.

In short:  
The Controller handles the logic and coordinates between Model and View.

---

## 2. Dynamic Views

### Static HTML:

- Fixed content
- Same for every user
- No interaction with backend
- Example: simple webpage with hardcoded text

### Dynamic PHP View:

- Content changes based on data
- Can display different info for different users
- Uses PHP to insert variables into HTML
- Connected to backend (Controller + Model)

Example:

```php
<h1>Welcome, <?= $username ?></h1>
```

So instead of fixed text, the page becomes dynamic.

---

## 3. Data Passing

The Controller passes data to the View using variables.

### Example:

#### In Controller:

```php
$data = [
    'username' => 'Hazem'
];

require 'views/profile.php';
```

#### In View (profile.php):

```php
<h1>Hello, <?= $username ?></h1>
```

### Important Idea:

- Data is prepared in Controller
- View only displays it

Sometimes frameworks use methods like:

```php
return view('profile', $data);
```

---

## 4. Templating (Headers & Footers)

MVC helps avoid repeating code by using reusable templates.

Instead of copying navbar and footer in every file:

- You create separate files:
    - header.php
    - footer.php

### Example in View:

```php
require 'partials/header.php';

<h1>Page Content</h1>

require 'partials/footer.php';
```

### Benefits:

- Write once, reuse everywhere
- Easy to update (change in one place)
- Cleaner and more organized code

---

## 5. Logic in Views

Putting complex logic inside Views is bad practice.

### Why?

1. Breaks separation of concerns
    - View should only display data
    - Logic belongs in Controller or Model

2. Hard to read and maintain
    - Mixing HTML + heavy logic = messy code

3. Hard to debug
    - Errors become confusing

4. Reduces reusability
    - Views become tightly coupled with logic

### Bad Example:

```php
<?php
foreach ($users as $user) {
    if ($user['age'] > 18) {
        // complex processing
    }
}
?>
```

### Good Practice:

- Do processing in Controller
- Send clean, ready-to-use data to View

---
