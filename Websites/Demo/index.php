<?php

require "functions.php";
require "Database.php";
require "router.php";


// connect to the database and execute a query

$id = $_GET['id'];

$query = "SELECT * FROM posts where id = :id";


$posts = $db->query($query, [':id' => $id])->fetch();

dd($posts);
