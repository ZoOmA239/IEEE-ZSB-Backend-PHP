# Task 15 - PHP OOP Research

## 1. Inheritance

Inheritance is a concept in Object-Oriented Programming that allows a class (child) to reuse properties and methods from another class (parent).  
The main benefit is **code reusability** and better organization.

### Example:

```php
class Animal {
    public function makeSound() {
        echo "Some sound";
    }
}

class Dog extends Animal {
    public function bark() {
        echo "Bark";
    }
}
```

Here, `Dog` inherits from `Animal`, so it can use `makeSound()` without rewriting it.

---

## 2. The `final` Keyword

The `final` keyword prevents modification.

- If used with a **class** → the class cannot be inherited.
- If used with a **method** → the method cannot be overridden.

### Example:

```php
final class Car {
    // cannot be extended
}

class Animal {
    final public function move() {
        echo "Moving";
    }
}
```

Developers use `final` to **protect important logic** from being changed.

---

## 3. Overriding Methods

Overriding means redefining a method in the child class that already exists in the parent class.

### Example:

```php
class Animal {
    public function makeSound() {
        echo "Animal sound";
    }
}

class Dog extends Animal {
    public function makeSound() {
        echo "Bark";
    }
}
```

### Calling Parent Method:

You can call the original method using `parent::`

```php
class Dog extends Animal {
    public function makeSound() {
        parent::makeSound();
        echo " + Bark";
    }
}
```

---

## 4. Abstract Class vs Interface

### Abstract Class:

- Can have **methods with code** and **without code**
- Can have **properties**
- A class can extend only **one abstract class**

### Interface:

- Contains only **method declarations (no code)**
- No properties (except constants)
- A class can implement **multiple interfaces**

### Example:

```php
interface Flyable {
    public function fly();
}

interface Swimmable {
    public function swim();
}

class Duck implements Flyable, Swimmable {
    public function fly() {
        echo "Flying";
    }

    public function swim() {
        echo "Swimming";
    }
}
```

✅ Yes, a class can implement multiple interfaces.

---

## 5. Polymorphism

Polymorphism means "one interface, many forms".
Different objects can use the same method name but behave differently.

### Example:

```php
class Animal {
    public function makeSound() {
        echo "Some sound";
    }
}

class Dog extends Animal {
    public function makeSound() {
        echo "Bark";
    }
}

class Cat extends Animal {
    public function makeSound() {
        echo "Meow";
    }
}
```

### Usage:

```php
$animals = [new Dog(), new Cat()];

foreach ($animals as $animal) {
    $animal->makeSound();
}
```

Each object responds differently to the same method `makeSound()`.

---
