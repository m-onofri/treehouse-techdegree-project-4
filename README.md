# treehouse-techdegree-project-4

The goal of this project is to create a browser-based, word guessing game (called "Phrase Hunter") using PHP and OOP (Object Oriented Programming) to select a random, hidden phrase, which a player tries to guess, by clicking letters on an onscreen keyboard.


 ## Rules of the game

* Your goal is to guess all the letters in a hidden, random phrase.
* You start with 5 lives.
* At each stage of the game, you have to choose a letter between the available ones displayed in the onscreen keyboard.
* If the selected letter is not in the phrase, you lost one life.
* If the selected letter is in the phrase, all instances of the letter are made visible in the phrase.
* You win the game when you guess all the letters and the whole phrase is revealed.
* You lost the game when you make 5 incorrect guesses.


## Code organization

The app is managed by several classes.

The main class is **Game**, which coordinates the creation, the update and the closure of the game.

The gameboard is composed of 3 main parts: the sentence, the keyboard and the scoreboard. 

The creation, visualization and updating of these three parts is managed by three different classes, respectively **Phrase**, **KeyBoard** and **ScoreBoard**.
Since these three classes share some specific features, all of them implement the **Board** interface.

**Phrase** and **KeyBoard** are *collections*, respectively of Letter and Key objects.

The **Letter** and **Key** classes are responsible of displaying the single letter in the phrase and the single key in the keyboard, respectively. They also keep track of the player's choices during the game.

Since both refer to alphabetic characters, they extend the *abstract class* **Char**.


## Additional features

* Add keyboard functionality: the player can use the computer keyboard to enter guesses.
* Add some animations using the Animate.css library.
* Prevent phrase repetition when the player click the "Play Again" button.


## Cross-browser consistency

The project was checked on MacOS in Chrome, Firefox, Opera and Safari, and on these browsers it works properly.


