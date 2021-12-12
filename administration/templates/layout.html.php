<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <link rel="stylesheet" type="text/css" href="css/<?= $theme ?>">
    <title><?= $title ?></title>
</head>
<body>
    <div id="wrapper">
        <h1><?=  $pageHeading ?></h1>
        <nav>
            <ul>
                <li><a href="./home.php">Admin Home</a></li>
                <li><a href="./update-item.php">Edit Items</a></li>
                <li><a href="./update-category.php">Edit Categories</a></li>
                <li><a href="./create-user.php">Create Another User</a></li>
                <li><a href="./logout.php">Logout</a></li>
                <li><a href="./change-password.php">Change Password</a></li>
                <li><a href="./choose-frame-colour.php">Choose a Frame Colour</a></li>
            </ul>
        </nav>
        
        <?= $output ?>
        <p><a href="../index.php">Back to public site</a>. </p>
    </div>
</body>
</html>