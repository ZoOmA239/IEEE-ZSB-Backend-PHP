# Task 19 - MVC Part 3 Research

## 1. In the MVC pattern, what is the only part of the application that should be allowed to talk directly to the database? Why?

The only part of the application that should communicate directly with the database is the **Model**.

The reason for this is separation of concerns. The Model is responsible for handling data, business logic, and database operations. By keeping database access inside the Model:

- The code becomes more organized and maintainable
- The Controller focuses only on handling user requests and logic flow
- The View remains responsible to show the data.

This structure makes the application easier to scale, debug, and update without affecting other parts.

---

## 2. Why should sensitive information (like database passwords) be stored in a separate configuration file instead of being hardcoded in your main application files?

Sensitive data should be stored in a separate configuration file for several important reasons:

- **Security:** Keeping passwords outside the main code reduces the risk of exposing them if the code is shared or uploaded to GitHub
- **Flexibility:** You can easily change database credentials without modifying the core application code
- **Environment Management:** Different environments (development, testing, production) can use different configs
- **Cleaner Code:** Keeps the main application logic clean and focused

Often, these config files are excluded from version control using `.gitignore`.

---

## 3. What is PDO in PHP, and why is it preferred over older methods like mysqli?

PDO (PHP Data Objects) is a database access layer that provides a consistent way to connect to different databases using the same interface.

It is preferred because:

- **Database Independence:** You can switch between MySQL, PostgreSQL, SQLite, etc. without changing much code
- **Security:** Supports prepared statements which protect against SQL injection
- **Cleaner API:** More structured and easier to use in large applications
- **Error Handling:** Supports exceptions for better debugging

Compared to mysqli, PDO is more flexible and widely used in modern PHP applications.

---

## 4. How do "Prepared Statements" protect your website from SQL Injection attacks?

Prepared Statements separate the SQL query from the user input.

Instead of inserting user input directly into the query, placeholders are used. Then the actual values are bound to these placeholders.

Example:

```sql
SELECT * FROM users WHERE email = :email
```

This prevents SQL injection because:

- The database treats user input as data, not executable code
- Malicious input cannot change the structure of the SQL query

So even if a user tries to inject SQL code, it will not be executed.

---

## 5. When you query a database, you can fetch a single row or multiple rows. Give a real-world example of each.

### Single Row Example:

When a user logs in, you fetch one row from the database:

- Example: Get user data using email
- Because each email is unique, only one row is returned

### Multiple Rows Example:

When displaying a list of products:

- Example: Fetch all products from a category
- Many products exist, so multiple rows are returned as an array

---
