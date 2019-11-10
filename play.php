<?php
include('src/config.php');

session_start();

if (empty($_POST['key'])) {
    //Create a new Phrase objext
    $phrase = new Phrase();
    //Create a new Game object
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
?>

<?php include('src/inc/header.php'); ?>

<?php if ($result = $game->gameOver()) { ?>
    <!-- If the game is over, display the phrase and the result -->
    <div id="game-over-message" class="<?php echo $result['status']; ?> animated bounceInUp">
        <?php echo $result['msg']; ?>
    </div>
    <div class="buttons">
        <a href="play.php" class="btn">Play Again</a>
        <a href="/treehouse-techdegree-project-4" class="btn">Exit</a>
    </div>

<?php } else { ?>
    <!-- If the game is not over, display the Phrase, the Keyboard and the Scoreboard -->
    <?php echo $game->displayPhrase(); ?>
    <?php echo $game->displayKeyboard(); ?>
    <?php echo $game->displayScoreBoard(); ?>

<?php } ?>

<?php include('src/inc/footer.php'); 


?>