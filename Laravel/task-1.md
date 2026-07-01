---
---

## 1. Blade Templates and How They Work

### What is Blade?

**Blade** is the powerful, lightweight templating engine provided by Laravel. Unlike other PHP templating engines, Blade does not restrict you from using plain PHP code in your views. All Blade views are compiled into plain PHP code and cached until they are modified, meaning Blade adds essentially zero overhead to your application.

### How It Works Under the Hood

1. **File Extension**: Blade files use the `.blade.php` extension and are typically stored in the `resources/views` directory.
2. **Compilation**: When a request hits a route that returns a Blade view, Laravel's compiler reads the file, parses the custom Blade directives (like `@if`, `@foreach`, `{{ $variable }}`), and converts them into standard PHP evaluation loops and `<?php echo ?>` statements.
3. **Caching**: The compiled PHP files are stored in the `storage/framework/views` directory. On subsequent requests, Laravel serves the cached plain PHP file directly, making rendering incredibly fast. It only re-compiles if the original `.blade.php` file is modified.
4. **Template Inheritance**: Blade allows you to create a master layout with placeholders (`@yield`) that child views can extend (`@extends`) and fill with unique content (`@section`), promoting heavy code reuse.

---

## 2. Object-Relational Mapping (ORM)

### What is an ORM?

An **Object-Relational Mapper (ORM)** is a programming technique that lets you query and manipulate data from a database using an object-oriented paradigm. Instead of writing raw SQL queries, you interact with database tables as if they were standard programming objects (Models). Laravel’s built-in ORM is called **Eloquent**.

### Why It Is Useful

- **Abstraction of SQL**: You don't need to write long, error-prone SQL strings. Complex joins, inserts, and updates are handled via intuitive method chains.
- **Maintainability & Portability**: If you change your underlying database engine (e.g., switching from MySQL to PostgreSQL), Eloquent handles the syntax differences automatically. Your codebase remains unchanged.
- **Security**: Eloquent automatically uses PDO parameter binding to safeguard your application against **SQL Injection** attacks.
- **Relationships Made Easy**: Defining relations (One-to-One, One-to-Many, Many-to-Many) is done elegantly using model methods, allowing you to load related data effortlessly using eager loading (`with()`).

---

## 3. Facade Design Pattern

### Concept

The **Facade Design Pattern** provides a simplified, static-like interface to a complex underlying subsystem of classes. It hides the complexities of initialization, dependency injection, and configuration behind a single, clean structural gateway.

### How Laravel Uses It

In Laravel, Facades serve as "static proxies" to underlying classes instantiated inside the Service Container. When you call a static method on a Laravel Facade (like `Route::get()`, `Cache::get()`, or `DB::table()`), Laravel resolves the actual class instance out of the container and calls the dynamic method on it behind the scenes. This gives you the syntax brevity of static methods while maintaining the testability and flexibility of dependency injection.

### Example of Usage in Laravel

Instead of manually instantiating a caching service or extracting it from a container, you use the `Cache` facade:

```php
use Illuminate\Support\Facades\Cache;

// A clean, simple static call to store data for 10 minutes
Cache::put('key', 'value', 600);

// Retrieving data effortlessly
$value = Cache::get('key');
```

---

## 4. Factory Design Pattern

### Concept

The **Factory Design Pattern** is a creational pattern that provides an interface for creating objects in a superclass, but allows subclasses to alter the type of objects that will be created. Instead of calling `new ClassName()` directly across your application, you delegate object instantiation to a dedicated "Factory" object or method. This decouples the client code from the specific implementation details of object creation.

---

Here is the updated section for **Question 5 (SOLID Principles)** rewritten completely in **PHP**, making it fit perfectly into a backend web development context.

You can replace the previous C++ section in your `task-1.md` file with this version:

---

## 5. SOLID Principles

The SOLID principles are a set of five design guidelines that make software designs more understandable, flexible, and maintainable.

### 1. Single Responsibility Principle (SRP)

> _A class should have one, and only one, reason to change._

A class must focus on doing a single job. If a class has multiple responsibilities, changes to one requirement can break functionality elsewhere.

#### PHP Code Example

```php
<?php

// BAD: This class handles both user data management AND report generation.
class UserBad {
    public string $name;

    public function saveToDatabase() {
        // Database connection and insertion logic...
    }

    public function generateReport() {
        echo "Generating report for " . $this->name;
    }
}

// GOOD: Responsibilities are split into separate classes.
class User {
    public string $name;
}

class UserRepository {
    public function save(User $user) {
        // Isolated database handling logic
    }
}

class UserReportGenerator {
    public function generate(User $user) {
        echo "Generating report for " . $user->name;
    }
}

```

### 2. Open/Closed Principle (OCP)

> _Software entities should be open for extension, but closed for modification._

You should be able to extend a class's behavior without altering its existing source code, typically achieved using polymorphism and interfaces.

#### PHP Code Example

```php
<?php

interface Shape {
    public function getArea(): float;
}

class Rectangle implements Shape {
    public float $width;
    public float $height;

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function getArea(): float {
        return $this->width * $this->height;
    }
}

class Circle implements Shape {
    public float $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function getArea(): float {
        return pi() * pow($this->radius, 2);
    }
}

// This class is closed for modification. If a new shape is added,
// we don't change this code; we just pass the new Shape implementation.
class AreaCalculator {
    public function totalArea(array $shapes): float {
        $total = 0;
        foreach ($shapes as $shape) {
            if ($shape instanceof Shape) {
                $total += $shape->getArea();
            }
        }
        return $total;
    }
}

```

### 3. Liskov Substitution Principle (LSP)

> _Subtypes must be substitutable for their base types without altering the correctness of the program._

Objects of a superclass should be replaceable with objects of its subclasses without breaking the application logic or throwing unexpected exceptions.

#### PHP Code Example

```php
<?php

class Bird {
    public function fly() {
        return "Flying high!";
    }
}

// BAD: Ostrich inherits from Bird but cannot fly, breaking runtime expectations.
class OstrichBad extends Bird {
    public function fly() {
        throw new Exception("Ostriches cannot fly!");
    }
}

// GOOD: Separate behaviors into correct, distinct abstractions.
class GroundBird {
    // Walking behaviors...
}

class FlyingBird {
    public function fly() {
        return "Flying high!";
    }
}

class Ostrich extends GroundBird {
    // Correct structure, avoids inheriting an impossible behavior
}

```

### 4. Interface Segregation Principle (ISP)

> _Clients should not be forced to depend upon interfaces that they do not use._

It is better to have many small, specific interfaces rather than one monolithic, bloated interface.

#### PHP Code Example

```php
<?php

// BAD: Forces simple printers to implement scanning/faxing functions they don't have.
interface MultiFunctionDevice {
    public function printDocument();
    public function scanDocument();
}

// GOOD: Segregated interfaces based on specific roles.
interface Printer {
    public function printDocument();
}

interface Scanner {
    public function scanDocument();
}

// A basic printer only depends on what it actually does
class BasicPrinter implements Printer {
    public function printDocument() {
        // Printing logic...
    }
}

```

### 5. Dependency Inversion Principle (DIP)

> _High-level modules should not depend on low-level modules. Both should depend on abstractions._

Depend on interfaces/abstract classes rather than concrete implementations. This decouples systems and makes components cleanly hot-swappable.

#### PHP Code Example

```php
<?php

// The Abstraction (Interface)
interface SwitchableDevice {
    public function turnOn();
}

// Low-level Module
class LightBulb implements SwitchableDevice {
    public function turnOn() {
        return "Bulb turned on.";
    }
}

// High-level Module depends on the interface abstraction, not the concrete LightBulb
class PowerSwitch {
    private SwitchableDevice $device;

    // Dependency is injected via the interface
    public function __construct(SwitchableDevice $device) {
        $this->device = $device;
    }

    public function operate() {
        return $this->device->turnOn();
    }
}

```
