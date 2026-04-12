# Task 5 – PHP Security Cheat Sheet

## Introduction

In this task, I focused on understanding common web security vulnerabilities and how to prevent them in PHP applications. This document acts as a quick reference guide for the most important security practices every backend developer should follow.

---

# 1. Cross-Site Scripting (XSS) & Filtering Input

## What is XSS?

XSS is an attack where a malicious user injects JavaScript code into a website, which then runs in other users’ browsers.

## How it happens

When user input is displayed without proper escaping:

```php
echo $_GET['name'];
```

An attacker can input:

```html
<script>
    alert("Hacked");
</script>
```

## Prevention

- Escape output using filter:

```php
echo filter_var($_GET('name'),FILTER_SANITIZE_STRING);
```

- Validate and sanitize input
- Never trust user input

---

# 2. Prevent SQL Injection

## What is SQL Injection?

SQL Injection is an attack where the attacker injects malicious SQL code into your query to access or manipulate your database.

---

## Bad Example (Vulnerable Code)

```php
$id = $_GET['id'];

$query = "SELECT * FROM members WHERE id = $id";
$result = mysqli_query($conn, $query);
```

### Problem

User can send:

```
?id=1 OR 1=1
```

This will return **all users**

---

## Good Example (Secure Code - PDO)

```php
<?php

include 'connect.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $userid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $stmt = $con->prepare("SELECT * FROM members WHERE id = ?");

    $stmt->execute(array($userid));

    $count = $stmt->rowCount();

    while ($row = $stmt->fetch()) {
        $id   = $row['id'];
        $name = $row['name'];
    }

    if ($count > 0) {
        echo $name;
    } else {
        echo "No User for this id";
    }
    endif;
}

    else:
    echo "Profile ID can't be empty";

    endif;
?>

---
```

## Why This is Secure?

- ✅ Uses **Prepared Statements**
- ✅ Prevents SQL injection automatically
- ✅ Separates SQL logic from user input
- ✅ Uses `filter_var` to sanitize input

---

## Best Practices

- Always use **PDO or MySQLi prepared statements**
- Never trust user input
- Avoid directly inserting variables into SQL queries
- Validate + sanitize inputs

---

---

# 3. Prevent Remote File Inclusion (RFI)

## What is RFI?

Allows attackers to include external malicious files.

## Dangerous Code

```php
include($_GET['page']);
```

## Prevention

- Never include files from user input
- Use whitelist:

```php
<?php

if (isset($_GET['page'])) {

    $allowedPages = array('testing.html', 'General_Tips.html');
    $page = $_GET('page');

    if (in_array($page,$allowdPages)) {
        include ($page);
    } else {
        echo "Not Allowed for inclusion";
    }
    endif;
}

    endif;
?>
```

- Or we can disable allow_url_include in php.ini

---

# 4. Hashing Passwords the Right Way

## Why?

Passwords should never be stored as plain text.

## Correct Way

```php
$password = "Hazem";
$HashedPassword = password_hash($password, PASSWORD_DEFAULT);
```

## Verify Password

```php
if(password_verify($password,$HashedPassword)){
    echo 'password is valid';
}else{
    echo 'invalid password';
}
```

---

# 5. Disable Errors in Production

## Problem

Displaying errors exposes sensitive data.

## Solution

```php
ini_set('display_errors', 0);
error_reporting(0);
```

Log errors instead of displaying them.

---

# 6. Disable Directory Listing (.htaccess)

## Problem

Users can see all files in a directory.

## Solution (.htaccess)

```
Options -Indexes
```

---

# 7. Header Location Redirect (Correct Way)

## Problem

Improper redirects can cause issues.

## Correct Usage

```php
$id = 0;

if($id !== 1){
    header("Location: /home");
exit;

}
endif;

echo "This info show for admin only";

```

Always call `exit` after redirect.

---

# 8. Why You Should Always Use HTTPS

## Benefits

- Encrypts data
- Prevents man-in-the-middle attacks
- Protects login credentials

---

# 9. Create Directory Firewall

## Idea

Restrict access to sensitive folders.

## Example (.htaccess)

```
Deny from all
```

## OR

Using cPanel and from Dirctory privacy we choose the file we want to create a firewall on it and give the access to someone who works with you on it.

---

## 10. Protect Directory with IP

### Description

Restrict access to a directory so only specific IP addresses can access it.

### 🛠 Example (.htaccess)

```apache
Order Deny,Allow
Deny from all
Allow from 192.168.1.1
```

### 🔍 Explanation

- Deny all users by default
- Allow access only to a specific IP

### ⚠️ Notes

- Not suitable for users with dynamic IPs
- Best used for admin panels or internal tools

---

## 11. Prevent Execution of Specific Files

### 📌 Description

Block execution of dangerous file types like `.php` or `.exe`.

### 🛠 Example

```apache
<FilesMatch "\.(php|exe)$">
    Deny from all
</FilesMatch>
```

### 🔥 Why Important?

Prevents attackers from executing malicious uploaded files.

### ✅ Best Practice

Disable PHP execution inside uploads folder:

```apache
<Directory "/uploads">
    php_flag engine off
</Directory>
```

---

## 12. Securing File Uploads

### 🚨 Risks

- Uploading malicious scripts
- Remote Code Execution (RCE)
- Malware injection

---

### 🛡 Prevention Techniques

#### 1. Validate File Type

```php
$allowed = ['image/jpeg', 'image/png'];

if (!in_array($_FILES['file']['type'], $allowed)) {
    die("Invalid file type");
}
```

---

#### 2. Rename Files

```php
$imageExtention = end(explode('.',$imagename));

$image= rand(0,100000) . "." .$imageExtention;

echo $image;
```

✔ Prevents overwriting and malicious naming

---

#### 3. Store Outside Public Directory

❌ Bad:

```
/public/uploads/file.php
```

✅ Good:

```
/storage/uploads/file.jpg
```

---

#### 4. Limit File Size

```php
if ($_FILES['file']['size'] > 2 * 1024 * 1024) {
    die("File too large");
}
```

---

#### 5. Validate Extension + MIME Type

✔ Always check both to prevent bypass

---

## 13. Why You Should Fix Error Logs

### 🚨 Problem

Error logs may expose:

- Sensitive data
- File paths
- Database queries
- API keys

---

### 🧨 Example Risk

```
Warning: include(/var/www/secret/config.php)
```

---

### 🛡 Solutions

#### 1. Hide Errors from Users

```php
ini_set('display_errors', 0);
```

---

#### 2. Log Errors Securely

```php
ini_set('log_errors', 1);
ini_set('error_log', '/secure/path/error.log');
```

---

#### 3. Protect Log Files

- Store outside public directory
- Use proper file permissions

---

#### 4. Monitor Logs

✔ Detect attacks and bugs early

---

## 14. Backend Validation

### 💡 Why?

Frontend validation can be bypassed easily.

---

### ❌ Weak Example

```js
if (email.includes("@")) {
    // valid
}
```

---

### ✅ Secure Example (PHP)

```php
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email");
}
```

---

### 🔐 Important Validations

- Emails
- Passwords
- Numbers
- File uploads
- User input

---

### 🔥 Best Practice

✔ Use **whitelist validation** instead of blacklist

---

## 15. Prevent Session Fixation

### 🚨 What is it?

An attacker forces a user to use a known session ID.

---

### 🛠 Prevention

```php
session_regenerate_id(true);
```

---

### ⏰ When to Use

- After login
- After privilege changes

---

### 🔐 Additional Security

#### 1. Secure Session Cookies

```php
session_set_cookie_params([
    'httponly' => true,
    'secure' => true,
]);
```

---

#### 2. Limit Session Lifetime

```php
ini_set('session.gc_maxlifetime', 3600);
```

---

#### 3. Bind Session to IP (Optional)

```php
if ($_SESSION['ip'] !== $_SERVER['REMOTE_ADDR']) {
    session_destroy();
}
```

---
