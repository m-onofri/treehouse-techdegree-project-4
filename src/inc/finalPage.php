<div id="game-over-message" class="<?php echo $result['status']; ?> animated bounceInUp">
    <?php echo $result['msg']; ?>
</div>
<div class="buttons">
    <a href="<?php echo 'play.php?last_id=' . $game->getCurrentPhraseId(); ?>" class="btn">Play Again</a>
    <a href="/treehouse-techdegree-project-4" class="btn">Exit</a>
</div>