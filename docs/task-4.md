# Task 4 – PHP Backend Learning Notes

## Introduction

In this task, I continued building my PHP mini-framework by following the Laracasts “PHP For Beginners” course.  
The main focus was improving the structure of the application by separating responsibilities, handling validation properly, and improving the developer experience using Composer and testing tools.

---

## 1. Extract a Form Validation Object

At first, validation logic was scattered inside controllers or request handlers. This made the code messy and hard to reuse.

So I extracted a dedicated `Validator` (or Form Validation Object).

### Why this is useful:

- Keeps controllers clean
- Makes validation reusable across multiple forms
- Easier to test and extend

### Example idea:

Instead of writing validation logic everywhere:

```php
if (strlen($email) === 0) {
    $errors['email'] = 'Email is required';
}
```

We move it into a class:

```php
Validator::validate($data, [
    'email' => 'required|email',
    'password' => 'required|min:6'
]);
```

Now validation becomes centralized and reusable.

---

## 2. Extract an Authenticator Class

Authentication logic should not live inside controllers.

So we created an `Authenticator` class to handle:

- login
- logout
- checking credentials
- storing user session

### Benefits:

- Separation of concerns
- Easier to maintain authentication logic
- Can be reused in multiple routes

### Example responsibilities:

```php
class Authenticator {
    public function attempt($email, $password) {
        // check database user
        // verify password
        // store session if valid
    }

    public function logout() {
        // clear session
    }
}
```

This makes authentication a dedicated service instead of scattered logic.

---

## 3. PRG Pattern (Post / Redirect / Get)

The PRG pattern is used to avoid form resubmission problems.

### Problem without PRG:

- User submits form
- Refresh page → form submits again

### Solution:

After processing POST request:

1. Save data or errors in session
2. Redirect to another page (GET request)

### Flow:

```
POST → process → redirect → GET
```

### Why it matters:

- Prevents duplicate submissions
- Improves UX
- Makes navigation safer

---

## 4. Session Flashing

Flash messages are temporary session data that disappear after one request.

### Used for:

- success messages
- error messages
- validation errors

### Example:

```php
$_SESSION['flash']['success'] = 'Account created successfully';
```

Then after displaying:

```php
unset($_SESSION['flash']);
```

This ensures messages only appear once.

---

## 5. Flash Old Form Data

When validation fails, users should not lose their input.

So we store old input in session:

```php
$_SESSION['old'] = $_POST;
```

Then repopulate the form:

```php
value="<?= old('email') ?>"
```

### Benefits:

- Better user experience
- No need to retype form data
- Common in real-world frameworks like Laravel

---

## 6. Automatically Redirect Back on Failed Validation

Instead of manually handling errors in every controller, we centralize behavior:

### Idea:

- If validation fails:
    - flash errors
    - flash old input
    - redirect back automatically

### Example behavior:

```php
Validator::validate($data, $rules);
// if fails → exception or redirect happens internally
```

This keeps controllers very clean and consistent.

---

## 7. Composer and Autoloading

Composer is the dependency manager for PHP.

### What I learned:

- Installing packages
- Autoloading classes automatically
- No need for manual `require` statements

### PSR-4 Autoloading:

Maps namespaces to folders:

```json
"autoload": {
    "psr-4": {
        "Core\\": "core/"
    }
}
```

Then run:

```bash
composer dump-autoload
```

Now PHP loads classes automatically.

---

## 8. Installing Composer Packages

### 1. Collections Package

Used for better array handling.

Benefits:

- cleaner loops
- functional programming style
- readable transformations

Example:

```php
collect($users)->map(function ($user) {
    return $user->email;
});
```

---

### 2. PestPHP Testing Framework

Pest is a modern testing framework built on top of PHPUnit.

### Why Pest:

- cleaner syntax
- readable tests
- less boilerplate

Example:

```php
it('can login a user', function () {
    expect(true)->toBeTrue();
});
```

---

## 9. Testing Approaches, Terms, and Considerations

### Types of testing I learned:

- Unit Testing → test small functions/classes
- Feature Testing → test full features (login, register)
- Integration Testing → test system interactions

### Important terms:

- Assertion: checking expected result
- Mocking: simulating dependencies
- Test coverage: how much code is tested

### Good practices:

- keep tests independent
- avoid database dependency when possible
- test behavior, not implementation

---

## 10. Next Step in My PHP Journey

After finishing this stage, I should focus on:

### Next improvements:

- building routing system from scratch
- middleware concept (auth protection)
- service container (dependency injection)
- database abstraction layer improvement
- improving error handling system

### Long-term goal:

To reach a level where I can build:

- Laravel-like architecture
- scalable backend applications
- clean, maintainable APIs

---

## Conclusion

This task helped me understand how real backend frameworks are structured.
The main improvement was moving from “working code” to “organized architecture” using services, validation objects, and proper patterns like PRG and autoloading.
