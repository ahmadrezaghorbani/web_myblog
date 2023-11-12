<?php include 'config.php';
include 'PDO.php';
$query="SELECT * FROM `categories`";
$result=$con->query($query);
?>
<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/maine.css">
    <title>Document</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand order-md-2" href="index.php">WEBPROG.ir</a>
            <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="my-nav" class="collapse navbar-collapse">
                <ul class="navbar-nav order-md-1">
                    <?php if ($result->rowCount() > 0){
                    foreach ($result as $row){
                        ?>
                    <li class="nav-item">
                        <a class="nav-link <?PHP echo (isset($_GET['category']) and $row['id'] == $_GET['category']) ? "active" : ""; ?>" href="index.php?category=<?php echo $row['id'];?>"><?php echo $row['title'];?></a>
                    </li>
                        <?php
                    }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>