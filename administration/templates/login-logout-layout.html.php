<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title><?= $title ?></title>
</head>
<body>
    <div id="wrapper">
        <h1><?=  $pageHeading ?></h1>
        <nav>
            <ul>
                <li><a href="./logout.php">Logout</a></li>
                <li><a href="./login.php">Login</a></li>
            </ul>
        </nav>
        
        <?= $output ?>
    </div>
</body>
</html>