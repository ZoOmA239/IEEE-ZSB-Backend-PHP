# Task 3 – PHP Backend Learning Notes

## Introduction

In this stage of the course, I focused on improving the structure of the application and making it closer to real-world backend systems. I learned how to organize code better, handle authentication, and build reusable components like routers and service containers.

---

# 1. Resourceful Naming Conventions

Resourceful naming is a way to structure routes based on resources instead of random naming.

Example:

* GET /users → list all users
* GET /users/create → show form
* POST /users → store new user
* GET /users/edit → edit form

This approach makes the application easier to understand and similar to modern frameworks.

---

# 2. PHP Autoloading and Extractions

Instead of manually requiring files everywhere, we use autoloading to load classes automatically.

This helps in:

* reducing repetition
* organizing code better
* improving scalability

Extraction means moving logic into separate classes or files instead of keeping everything in one place.

---

# 3. Namespacing

Namespaces are used to organize classes and avoid naming conflicts.

Example:

```php
namespace Core;

class Router {
    // code
}
```

This allows us to have multiple classes with the same name but in different namespaces.

---

# 4. Handle Multiple Request Methods from a Controller Action

Sometimes the same route needs to handle both GET and POST.

Example:

```php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // show form
} else {
    // handle submission
}
```

This is useful for forms like login or register.

---

# 5. Build a Better Router

The router decides which controller should handle a request.

Instead of using if/else, we build a router class:

* maps routes to controllers
* supports different HTTP methods
* improves readability

---

# 6. One Request One Controller

Each request should be handled by a single controller.

This improves:

* clarity
* maintainability
* separation of concerns

Example:

* /login → LoginController
* /register → RegisterController

---

# 7. Service Container

A service container is used to manage dependencies.

Instead of creating objects manually everywhere, we register them in one place.

Example:

```php
App::bind('database', function () {
    return new Database();
});
```

This makes the application more flexible and easier to scale.

---

# 8. Updating with PATCH Requests

PATCH is used to update existing data partially.

Example:

* POST → create
* PATCH → update

This follows REST principles and makes the API cleaner.

---

# 9. PHP Sessions 101

Sessions allow us to store user data between requests.

Example:

```php
$_SESSION['user'] = $user;
```

This is mainly used for authentication.

---

# 10. Register a New User

Steps:

1. User submits form
2. Validate input
3. Hash password
4. Store in database

Example:

```php
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
```

---

# 11. Introduction to Middleware

Middleware is a layer that runs before the controller.

It is used for:

* authentication checks
* authorization
* filtering requests

Example:

* block access if user is not logged in

---

# 12. Manage Passwords Securely

Passwords should never be stored as plain text.

Use hashing:

```php
password_hash($password, PASSWORD_DEFAULT);
```

And verify using:

```php
password_verify($input, $hashedPassword);
```

This is the standard way to handle passwords securely.

---

# 13. Log In and Log Out

## Login:

1. Get user from database
2. Verify password
3. Store user in session

```php
$_SESSION['user'] = $user;
```

## Logout:

```php
session_destroy();
```

This removes user data and logs them out.

---

# Conclusion

In this part, I learned how to structure backend applications properly using controllers, routers, and service containers. I also implemented authentication features like registration, login, and logout, and understood how to handle sessions and middleware.

These concepts are essential for building scalable and secure PHP applications.
