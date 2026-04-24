# MVC - Task 17

## Part A: The Research

### 1. The MVC Pattern

MVC stands for **Model - View - Controller**. It is a design pattern used to organize code in web applications.

- **Model:**  
  Responsible for handling the data and business logic. It interacts with the database (CRUD operations) and processes data.

- **View:**  
  Responsible for displaying the data to the user. It contains the UI (HTML, CSS) and shows information received from the controller.

- **Controller:**  
  Acts as a middle layer between Model and View. It receives user input (like requests), processes it using the Model, and then returns the appropriate View.

---

### 2. Routing

A **Router** is a component that decides how the application responds to a specific request (URL).

It works like a **traffic cop**:

- It checks the incoming URL.
- Based on the URL, it decides which controller and method should handle the request.
- Then it forwards the request to the correct place.

Example:  
`/users/profile` → goes to `UserController` → calls `profile()` function.

---

### 3. The Front Controller

A **Front Controller** means having a single entry point for the entire application, usually `index.php`.

Instead of having multiple files like:

- `about.php`
- `contact.php`
- `profile.php`

All requests go through:

- `index.php`

Benefits:

- Centralized control of requests
- Easier routing
- Better security and organization
- Cleaner structure

---

### 4. Clean URLs

Clean URLs look like this:

```

example.com/users/profile

```

Instead of messy URLs like:

example.com/index.php?page=users&action=profile

**Why clean URLs are better:**

- Easier to read and understand
- Better for SEO (Search Engine Optimization)
- More professional appearance
- Easier to remember and share

---

### 5. Separation of Concerns

Separation of Concerns means each part of the application has a specific responsibility.

Putting SQL queries inside HTML files is a bad idea because:

- Makes code messy and hard to read
- Difficult to maintain and debug
- Breaks the MVC structure
- Reduces security (risk of SQL injection if not handled properly)

**Best practice:**

- SQL queries → Model
- Logic → Controller
- UI → View

This makes the application:

- Cleaner
- Easier to manage
- More scalable

---
