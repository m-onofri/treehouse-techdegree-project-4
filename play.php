<?php

include('inc/Char.php');
include('inc/Key.php');
include('inc/Letter.php');
include('inc/Phrase.php');
include('inc/Game.php');

session_start();

if (empty($_GET['key'])) {
    $phrase = new Phrase("Hello Kitty");
    $game = new Game($phrase);
    // echo(var_dump($game));
    // die;
    $_SESSION['game'] = $game;
} else {
    $key = trim(filter_input(INPUT_GET, 'key', FILTER_SANITIZE_STRING));
    $game = $_SESSION['game'];
    // echo(var_dump($game));
    // die;
    $game->handleUserChoice($key);
    
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
<div class="main-container">
    <div id="banner" class="section">
        <h2 class="header">Phrase Hunter</h2>
        <?php echo $game->phrase->addPhraseToDisplay(); ?>
        <?php echo $game->displayKeyboard(); ?>
        <?php echo $game->displayScore(); ?>
    </div>
</div>

</body>
</html>
