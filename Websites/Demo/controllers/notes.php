<?Php


$config = require "config.php";

$db = new Database($config['Database']);


$heading = "My Notes";

$notes = $db->query("SELECT * FROM notes where user_id = 1;")->fetchAll();



require "views/notes.view.php";
