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


    <ul>
        <?php foreach ($filteredBooks as $book) : ?>
            <li>
                <a href="<?php echo $book['url']; ?>">
                    <?php echo $book['name']; ?> (<?php echo $book['year']; ?>) by <?php echo $book['author']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>