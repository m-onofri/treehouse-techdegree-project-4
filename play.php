<?php
include('src/config.php');

session_start();

if (empty($_POST['key'])) {
    if (!empty($_GET["last_id"])) {
        
        //Get and filter the index of the phrase displayed in the previous turn
        $last_id = filter_input(INPUT_GET, 'last_id', FILTER_SANITIZE_NUMBER_INT);
        $phrase = new Phrase(null, null, $last_id);

    } else {

        $phrase = new Phrase();
    }
    $game = new Game($phrase);
    //The Game object is assigned by reference to the SESSION
    $_SESSION['game'] = $game;

} else {

    //Get and filter the letter the user chose
    $key = trim(filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING));
    //Get back the refence to the Game object from the SESSION
    $game = $_SESSION['game'];
    //Check the user choice and update the Phrase, the Keyboard and the Scoreboard
    $game->handleUserChoice($key);

}

include('src/inc/header.php');

if ($result = $game->gameOver()) {

    //If the game is over, display the phrase and the result
    include('src/inc/finalPage.php');

} else {

    //If the game is not over, display the Phrase, the Keyboard and the Scoreboard
    echo $game->displayPhrase();
    echo $game->displayKeyboard();
    echo $game->displayScoreBoard();

} 

include('src/inc/footer.php'); 
