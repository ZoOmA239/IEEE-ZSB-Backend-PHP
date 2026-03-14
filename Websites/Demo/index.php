<?php

require "functions.php";
// require "router.php";


// connect to our mysql database

$dsn = "mysql:host=localhost;port=3306;user=root;charset=utf8mb4;dbname=myApp";

$pdo = new PDO($dsn);

$statment = $pdo->prepare("SELECT * FROM posts");

$statment->execute();
$posts = $statment->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo "<li>{$post['Title']}</li>";
}
