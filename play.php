<?php
include('inc/Char.php');
include('inc/Key.php');
include('inc/Letter.php');
include('inc/Phrase.php');
include('inc/KeyBoard.php');
include('inc/ScoreBoard.php');
include('inc/Game.php');

session_start();

if (empty($_POST['key'])) {
    $game = new Game();
    $_SESSION['game'] = $game;
} else {
    $key = trim(filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING));
    $game = $_SESSION['game'];
    $game->handleUserChoice($key);   
}
?>

<?php include('inc/header.php'); ?>

<?php if ($result = $game->gameOver()) { ?>
    <div id="game-over-message" class="<?php echo $result['status']; ?>">
        <h1><?php echo $result['msg']; ?></h1>
    </div>
    <div class="buttons">
        <a href="play.php" class="btn">Play Again</a>
        <a href="/" class="btn">Exit</a>
    </div>

<?php } else { ?>

    <?php echo $game->displayPhrase(); ?>
    <?php echo $game->displayKeyboard(); ?>
    <?php echo $game->displayScore(); ?>

<?php } ?>

<?php include('inc/footer.php'); ?>