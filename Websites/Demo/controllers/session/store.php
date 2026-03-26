<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
// validate the form data
if (! Validator::email($email)) {
    $errors['email'] = "Please enter a valid email address";
}

if (! Validator::string($password)) {
    $errors['password'] = "Please enter a valid password";
}

if (! empty($errors)) {
    return view("session/create.view.php", [
        "errors" => $errors
    ]);
}

// match the cardentials with the database
$user = $db->query("select * from users where email = :email", [
    "email" => $email
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {


        login([
            'email' => $email
        ]);

        header('location: /');
        exit();
    }
}


return view("session/create.view.php", [
    "errors" => [
        "email" => "No matching account for this email and password"
    ]
]);
