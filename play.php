<?php
include('inc/phrases.php');
include('inc/Char.php');
include('inc/Key.php');
include('inc/Letter.php');
include('inc/Phrase.php');
include('inc/KeyBoard.php');
include('inc/ScoreBoard.php');
include('inc/Game.php');

session_start();

if (empty($_POST['key'])) {
    $game = new Game(new Phrase($random_phrase));
    $gamePhrase = $game->getPhrase();
    $_SESSION['game'] = $game;
} else {
    $key = trim(filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING));
    $game = $_SESSION['game'];
    $gamePhrase = $game->getPhrase();
    $game->handleUserChoice($key);   
}
?>

<?php include('inc/header.php'); ?>

<?php if ($msg = $game->gameOver()) { ?>

    <h1 id="game-over-message"><?php echo $msg; ?></h1>
    <form action="play.php">
        <input id="btn__reset" type="submit" value="Play Again" />
    </form>
    <a href="/" class="btn" id="btn__reset">Exit</a>

<?php } else { ?>

    <?php echo $gamePhrase->addPhraseToDisplay(); ?>
    <?php echo $game->displayKeyboard(); ?>
    <?php echo $game->displayScore(); ?>

<?php } ?>

<?php include('inc/footer.php'); ?>