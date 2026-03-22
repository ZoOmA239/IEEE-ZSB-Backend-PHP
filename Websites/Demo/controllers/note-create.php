<?php

$config = require "config.php";
$db = new Database($config['Database']);


$heading = "Create Note";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db->query("Insert into notes (body, user_id) values (:body, :user_id)", [
        'body' => $_POST['body'],
        'user_id' => 1
    ]);
}
require "views/note-create.view.php";
