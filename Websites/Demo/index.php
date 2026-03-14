<?php

require "functions.php";
// require "router.php";
require "Database.php";


// connect to the database and execute a query

$config = require "config.php";

$db = new Database($config['Database']);

$id = $_GET['id'];

$query = "SELECT * FROM posts where id = :id";


$posts = $db->query($query, [':id' => $id])->fetch();

dd($posts);
