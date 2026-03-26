<?Php


$config = require  base_path("config.php");

$db = new Database($config['Database']);



$notes = $db->query("SELECT * FROM notes where user_id = 1;")->get();



view("notes/index.view.php", [
    'heading' => "My Notes",
    'notes' => $notes
]);
