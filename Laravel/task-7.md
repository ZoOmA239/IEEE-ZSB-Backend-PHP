# Task 7: Design Patterns and Concurrency Research

This document summarizes my learnings on essential design patterns and database concurrency concepts, including how they apply to real-world backend development.

## 1. Strategy Pattern

The Strategy Pattern is a behavioral design pattern that lets you define a family of algorithms, put each of them into a separate class, and make their objects interchangeable.

- **What I learned:** Instead of having massive `if/else` or `switch` statements to determine behavior, you extract those behaviors into separate "Strategy" classes that all implement the same interface. The context object then delegates the work to a linked strategy object.
- **Use Case:** Handling different payment gateways (e.g., `PaypalStrategy`, `StripeStrategy`). At runtime, the application can switch between these strategies without changing the core checkout logic.

## 2. Factory Design Pattern

The Factory Pattern is a creational pattern that provides an interface for creating objects in a superclass but allows subclasses to alter the type of objects that will be created.

- **What I learned:** It separates the code that constructs objects from the code that uses them. This makes the codebase easier to extend. If I need to add a new product type, I just create a new specific creator class without breaking existing client code.
- **Use Case:** Generating different types of user notifications. A `NotificationFactory` can return an `EmailNotification` or `SMSNotification` object depending on the input, keeping the instantiation logic out of the main controllers.

## 3. Concurrency

Concurrency is the ability of an application to make progress on multiple tasks simultaneously.

- **What I learned:** While traditional PHP is synchronous (processing one request at a time per script execution), concurrency at the database and application level is crucial for handling multiple users hitting the server at the exact same time. Modern tools and queue workers handle multiple processes concurrently, requiring careful management of shared resources.

## 4. Atomicity

Atomicity ensures that a series of database operations either completely succeed or completely fail. It's the "A" in the ACID properties of databases.

- **What I learned:** There is no "partial" completion. If step 1 and 2 succeed but step 3 fails, the entire transaction rolls back, leaving the database exactly as it was before step 1.
- **Use Case:** Transferring money between accounts. Deducting from Account A and adding to Account B must be atomic. In Laravel, this is handled using `DB::transaction()`.

## 5. Concurrency (Race Conditions)

A race condition occurs when two or more processes try to read and write to shared data at the exact same time, and the final state of the data depends on the unpredictable timing of their execution.

- **What I learned (Demo context):** If two users try to buy the last concert ticket simultaneously, both processes might check the database, see `tickets_available = 1`, and both proceed to buy it, resulting in `-1` tickets.
- **Solution:** We use database locks. Using pessimistic locking (like `lockForUpdate()` in Eloquent) forces the second process to wait until the first process finishes its transaction before it can even read the ticket count.

## 6. Deadlocks

A deadlock happens when two or more processes are unable to proceed because each is waiting for the other to release a lock.

- **What I learned (Demo context):**
    - Process A locks Resource 1 and needs Resource 2.
    - Process B locks Resource 2 and needs Resource 1.
    - Both are stuck infinitely waiting for each other.
- **Solution:**
    1.  Always acquire locks in a consistent, predefined order across the entire application.
    2.  Keep transactions as short as possible.
    3.  Implement lock timeouts so a process will eventually fail rather than freeze forever.

---

### Resources Consulted

- **Refactoring.guru:** For deep dives into the Strategy and Factory design patterns.
- **Laravel Documentation (Database / Queries):** To understand how atomic transactions (`DB::transaction`) and pessimistic locking (`sharedLock`, `lockForUpdate`) are implemented in practice.
- **General Engineering Blogs:** Articles on database isolation levels and handling race conditions in concurrent web environments.

### LLM Chat Usage

During this task, I utilized an LLM to clarify the exact difference between standard pessimistic locking and optimistic locking when dealing with race conditions, and to help structure this markdown document cleanly.
