<!DOCTYPE html>
<html lang="en">

<head>
    <title>Demo</title>
    <style>
        body {
            display: grid;
            place-items: center;
            height: 100vh;
            margin: 0;
            font-family: sans-serif;
        }
    </style>
</head>

<body>
    <?php
    $name = "Harry Potter";
    $read = false;

    if ($read) {
        $messag = "You have read $name";
    } else {
        $messag = "You have not read $name";
    }

    ?>

    <h1>
        <?php echo $messag; ?>
    </h1>

</body>

</html>