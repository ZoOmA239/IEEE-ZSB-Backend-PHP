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

    <?Php
    $books = [
        [
            'name' => "Harry Potter",
            'author' => "J.K. Rowling",
            'year' => 1997
        ],
        [
            'name' => "The Lord of the Rings",
            'author' => "J.R.R. Tolkien",
            'year' => 1954
        ],
        [
            'name' => "The Great Gatsby",
            'author' => "F. Scott Fitzgerald",
            'year' => 1925
        ],
        [
            'name' => "To Kill a Mockingbird",
            'author' => "Harper Lee",
            'year' => 1960
        ]

    ];
    ?>




    <ul>
        <?php foreach ($books as $book) : ?>
            <li><?php echo $book['author']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>