<?php

class Game
{
    private $phrase;
    private $scoreBoard;
    private $lives = 5;
    private $keyboard;

    /*It takes 2 parameters: a Phrase object and an integer as the number of lives (optional)
    **It creates a new ScoreBoard object and a new keyBoard object*/
    public function __construct($phrase, $lives = null)
    {
        $this->phrase = $phrase;
        $this->scoreBoard = new ScoreBoard($lives = null);
        $this->keyBoard = new KeyBoard();
    }

    /*It takes no parameters
    **It checks if all the letters of the Phrase are displayed; if yes it returns true, otherwise false */
    private function checkForWin()
    {
        //It finds how many letters are not displayed yet
        $remainingLetters = array_filter(
            $this->phrase->getArrayPhrase(), 
            function($a){return $a->getStatus() == "hide";});

        if (count($remainingLetters) == 0) {
            return true;
        }
        return false;
    }

    /*It takes no parameters
    **It checks if the user lost all his lives; if yes it returns true, otherwise false */
    private function checkForLose()
    {
        if ($this->scoreBoard->getRemainingLives() == 0) {
            return true;
        }
        return false;
    }

    /*It takes no parameters
    **It checks if the game is over and if the user won or lost the game. 
    **If the game is not over it returns false, 
    ** otherwise it returns an array with the status of the match (win or lose) and a relative message*/
    public function gameOver()
    {
        if ($this->checkForWin()) {
            return [
                'msg' => "<h4>Congratulations on guessing:</h4><h3>'" . $this->phrase->getCurrentPhrase() . "'</h3>",
                'status' => 'win'
            ];
        } elseif ($this->checkForLose()) {
            return [
                'msg' => "<h4>The phrase was:</h4><h3>'" . $this->phrase->getCurrentPhrase() . "'</h3><h4> Better luck next time!<h4>",
                'status' => 'lose'
            ];
        } else {
            return false;
        }
    }

    /*It takes 1 parameter: a string corresponding tho the letter chosen by the user
    **It checks if the letter chosen by the user matches with one or more in the phrase and
    **it updates the Phrase, the KeyBoard and the ScoreBoard objects accordingly.*/
    public function handleUserChoice($choice)
    {
        $this->phrase->update($choice);
        if ($this->phrase->checkLetter($choice)) {
            $this->keyBoard->update($choice, "correct");
        } else {
            $this->scoreBoard->update();
            $this->keyBoard->update($choice, "incorrect");
        }
    }

    public function getCurrentPhraseId()
    {
        return $this->phrase->getCurrentPhraseId();
    }

    //Display the keyboard on the screen
    public function displayKeyboard()
    {
        return $this->keyBoard->display();
    }

    //Display the ScoreBoard on the screen
    public function displayScoreBoard()
    {
        return $this->scoreBoard->display();

    }

    //Display the phrase on the screen
    public function displayPhrase()
    {
        return $this->phrase->display();
    }
}