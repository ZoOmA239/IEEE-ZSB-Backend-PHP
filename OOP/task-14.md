# Task 14 - PHP OOP Research

## 1. Class vs Object

A **Class** is like a blueprint or a template, while an **Object** is the actual thing created from that blueprint.

### Real-world analogy:

Think of a **Car factory design**:

- The **Class** is the design or blueprint of the car (it defines properties like color, engine, speed).
- The **Object** is the actual car produced from that design.

So:

- Class = Plan
- Object = Real instance of that plan

---

## 2. `$this` vs `self::`

### `$this`

- Refers to the **current object instance**.
- Used to access **non-static properties and methods**.

```php
class User {
    public $name;

    public function setName($name) {
        $this->name = $name;
    }
}
```

### `self::`

- Refers to the **current class itself** (not an instance).
- Used with **static properties and methods**.

```php
class Math {
    public static $pi = 3.14;

    public static function getPi() {
        return self::$pi;
    }
}
```

### When to use:

- Use `$this` → when working with object data.
- Use `self::` → when working with static (shared) data.

---

## 3. Access Modifiers (Encapsulation)

Access modifiers control how properties and methods are accessed.

### Types:

- **public** → Accessible from anywhere
- **protected** → Accessible داخل الكلاس نفسه والكلاسات الوراثة منه
- **private** → Accessible داخل الكلاس فقط

### Example:

```php
class BankAccount {
    private $balance;

    public function setBalance($amount) {
        $this->balance = $amount;
    }

    public function getBalance() {
        return $this->balance;
    }
}
```

### Why make a property private?

To **protect data** from being changed incorrectly.
For example, you don’t want someone to directly change a bank balance without validation.

---

## 4. Typed Properties

Typed properties mean defining the **data type** of a property.

### Example:

```php
class User {
    public string $name;
    public int $age;
}
```

### Without types:

```php
public $age;
```

### Benefits:

- Prevents wrong data types (e.g., string instead of integer)
- Helps catch errors early
- Makes code clearer and more predictable

---

## 5. Constructor Methods

### What is `__construct()`?

It is a special method that runs **automatically when creating a new object**.

### Example:

```php
class User {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }
}

$user = new User("Hazem");
```

### Why pass arguments?

- To initialize object data immediately
- To ensure the object is always created in a valid state
- Reduces the need for extra setter methods

---

## Summary

- Class = blueprint, Object = instance
- `$this` → current object, `self::` → current class
- Access modifiers protect and organize data
- Typed properties improve safety and reduce bugs
- Constructor initializes object at creation

---
