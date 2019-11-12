<?php include('src/inc/header.php'); ?>

<h3>Rules of the game</h3>
<ul id="rules">
	<li>Your goal is to guess all the letters in a hidden, random phrase.</li>
	<li>You start with 5 lives.</li>
	<li>At each stage of the game, you have to choose a letter between the available ones displayed in the onscreen keyboard.</li>
	<li>If the selected letter is not in the phrase, you lost one life.</li>
	<li>If the selected letter is in the phrase, all instances of the letter are made visible in the phrase.</li>
	<li>You win the game when you guess all the letters and the whole phrase is revealed.</li>
	<li>You lost the game when you make 5 incorrect guesses.</li>
</ul>
		
<form action="play.php">
	<input id="btn__reset" type="submit" value="Start Game" />
</form>

<?php include('src/inc/footer.php'); ?>
