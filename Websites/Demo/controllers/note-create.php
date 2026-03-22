<?php

$config = require "config.php";
$db = new Database($config['Database']);


$heading = "Create Note";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];
    if (strlen($_POST['body']) == 0) {
        $errors['body'] = "A body is required";
    }


    if (strlen($_POST['body']) > 1000) {
        $errors['body'] = "The body must be less than 1000 characters";
    }

    if (empty($errors)) {
        $db->query("Insert into notes (body, user_id) values (:body, :user_id)", [
            'body' => $_POST['body'],
            'user_id' => 1
        ]);
    }
}
require "views/note-create.view.php";
