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
            'year' => 1997,
            'url' => "https://en.wikipedia.org/wiki/Harry_Potter"
        ],
        [
            'name' => "The Lord of the Rings",
            'author' => "J.R.R. Tolkien",
            'year' => 1954,
            'url' => "https://en.wikipedia.org/wiki/The_Lord_of_the_Rings"
        ],
        [
            'name' => "The Great Gatsby",
            'author' => "F. Scott Fitzgerald",
            'year' => 1925,
            'url' => "https://en.wikipedia.org/wiki/The_Great_Gatsby"
        ],
        [
            'name' => "To Kill a Mockingbird",
            'author' => "J.K. Rowling",
            'year' => 1960,
            'url' => "https://en.wikipedia.org/wiki/To_Kill_a_Mockingbird"
        ]

    ];



    function filter($items, $function)
    {
        $filtereditems = [];
        foreach ($items as $item) {
            if ($function($item)) {
                $filtereditems[] = $item;
            }
        }
        return $filtereditems;
    }




    $filteredBooks = filter($books, function ($book) {
        return $book['year'] < "1960";
    });

    ?>





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