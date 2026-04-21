# Task 16 - PHP OOP (Part 3)

---

## 1. Traits

PHP does not support multiple inheritance, meaning a class cannot extend more than one class. Traits solve this problem by allowing developers to reuse methods and properties from multiple sources.

A Trait is like a reusable piece of code that can be included inside a class using the `use` keyword.

### Why use Traits?

- To avoid code duplication
- To share functionality between unrelated classes
- To simulate multiple inheritance

### Example:

```php
trait Logger {
    public function log($message) {
        echo $message;
    }
}

class User {
    use Logger;
}

class Product {
    use Logger;
}
```

---

## 2. Namespaces

A Namespace in PHP is a way to organize code and avoid naming conflicts between classes.

Sometimes, two different libraries may have classes with the same name. Namespaces prevent this problem by grouping classes under unique names.

### Example without namespace (problem):

```php
class User {}
class User {} // Error: duplicate class name
```

### Example with namespace:

```php
namespace App\Models;

class User {}

namespace App\Controllers;

class User {}
```

Now both classes can exist without conflict.

---

## 3. Autoloading

Before autoloading, developers had to manually include every class file using `require` or `include`.

Autoloading automatically loads the required class file when you use the class, without needing to include it manually.

### Benefits:

- Saves time
- Cleaner code
- No need to remember file paths

### Example:

```php
spl_autoload_register(function ($class) {
    include $class . '.php';
});
```

---

## 4. Magic Methods (**get and **set)

Magic methods are special methods in PHP that are automatically triggered in certain situations.

### \_\_get:

- Called when trying to access a property that is not accessible or does not exist.

### \_\_set:

- Called when trying to assign a value to a property that is not accessible or does not exist.

### Example:

```php
class User {
    private $data = [];

    public function __get($name) {
        return $this->data[$name] ?? null;
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
}
```

---

## 5. Static Methods and Properties

When a method or property is declared as `static`, it belongs to the class itself, not to an instance (object) of the class.

### Key Points:

- You do NOT need to create an object using `new`
- Accessed using `ClassName::methodName()`

### Example:

```php
class Math {
    public static function add($a, $b) {
        return $a + $b;
    }
}

echo Math::add(5, 3);
```

### Static Property Example:

```php
class Counter {
    public static $count = 0;
}

Counter::$count++;
```

---

## Summary

- Traits allow code reuse and simulate multiple inheritance
- Namespaces organize code and prevent naming conflicts
- Autoloading loads classes automatically without manual includes
- **get and **set handle inaccessible properties dynamically
- Static methods/properties belong to the class, not objects

---
