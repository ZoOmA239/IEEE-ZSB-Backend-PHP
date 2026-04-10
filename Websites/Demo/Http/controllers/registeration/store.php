<?php

use Core\Validator;
use Core\App;

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form data
if (! Validator::email($email)) {
    $errors['email'] = "Please enter a valid email address";
}

if (! Validator::string($password, 7, 255)) {
    $errors['password'] = "Please enter a valid password with at least 7 characters";
}

if (! empty($errors)) {
    return view("registeration/create.view.php", [
        "errors" => $errors
    ]);
}

$db = App::resolve("Core\Database");
// check if the account exists
$user = $db->query("select * from users where email = :email", [
    "email" => $email
])->find();

// if yes, redirect to the login page
if ($user) {

    header("location: /");
    exit();
} else {
    // if no, save one to the databse and then login the user and redirect to the home page
    $db->query("insert into users (email, password) values (:email, :password)", [
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ]);


    // mark the user has logged in
    login($user);

    header("location: /");
    exit();
}
