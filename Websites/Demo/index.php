<!DOCTYPE html>
<html lang="en">

<head>
    <title>Demo</title>
    <!-- <style>
        body {
            display: grid;
            place-items: center;
            height: 100vh;
            margin: 0;
            font-family: sans-serif;
        }
    </style> -->
</head>

<body>

    <h1>Recommeded Books </h1>


    <?php
    $books = ["Harry Potter", "The Lord of the Rings", "The Great Gatsby", "To Kill a Mockingbird"];  ?>


    <ul>
        <?php foreach ($books as $book) : ?>
            <li><?php echo $book; ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>