<?php 
    require('./config/config.php');
    $stmt = $pdo->query("SELECT * FROM flashcard_set");
    $sets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://use.fontawesome.com/a25306efbe.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/sticky-footer.css">
    <link rel="stylesheet" href="css/cards.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Flashcards-PHP</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">
        <img src="https://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Flashcards
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php foreach ($sets as $set): ?>
                <li class="nav-item">
                    <a href="set.php?set_id=<?php echo $set['set_id']; ?>" class="nav-link"><?php  echo $set['set_name']; ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
    <div class="container main">