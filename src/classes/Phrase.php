<?php

class Phrase implements Board
{
    private $currentPhrase;
    private $currentPhraseId;
    private $arrayPhrase = [];
    private $selected = [];
    private $phrases = [
        "The Phantom Menace",
        "The Empire Strikes Back",
        "The Force Awakens",
        "Attack of the Clones",
        "Raiders of the Lost Ark",
        "Once Upon a Time in the West",
        "From Dusk till Down",
        "A Fistful of Dollars",
        "Flags of Our Fathers",
        "Where Eagles Dare",
        "The Good, the Ugly and the Bad",
        "They Shoot Horses, Don't They?"
    ];

    //It takes 2 optional parameters: a phrase as a string and an array of letters
    public function __construct($currentPhrase = null, $selected = null, $previousPhraseIndex= null)
    {
       if (!empty($currentPhrase)) {
           $this->currentPhrase = $currentPhrase;
       } else {
            //If no phrase is passed, it select a random phrase from the $phrases array
            $this->currentPhrase = $this->getRandomPhrase($previousPhraseIndex); 
       }

       if (!empty($selected)) {
           $this->selected = $selected;
       }

       //The phrase is converted in ar array of Letter objects
       $this->setArrayPhrase();
    }

    /*It takes no parameters
    **It returns a string containing the HTML displaying the phrase */
    public function display()
    {
        $phrase = "<div id='phrase' class='section'>";
        $phrase .= $this->addPhraseToDisplay();
        $phrase .= "</div>";

        return $phrase;
    }

    /*It takes no parameters
    **It returns a string containing the HTML specifically displaying the phrase */
    private function addPhraseToDisplay()
    {
        //To prevent that words were cut off in the middle when the sentence is very long, each word is inserted inside a div
        $phrase = "<div class='word'>";

        foreach ($this->arrayPhrase as $letter) {
            if ($letter->getCategory() == "space") {
                $phrase .= "</div>";
                $phrase .= "$letter";
                $phrase .= "<div class='word'>";
            } else {
                $phrase .= "$letter";
            }
        }

        $phrase .= "</div>";

        return $phrase;
    }

    //It takes 2 optional parameters: a letter as a string and a status as a string
    //According to the letter chosen by the user, it updates the Letter object status and enable/disable animation
    public function update($letter= null, $newStatus = "show")
    {
        foreach ($this->arrayPhrase as $char) {
            if ($letter == strtolower($char->getContent())) {
                $char->setStatus($newStatus);
                $char->setAnimate(true);
            } else {
                $char->setAnimate(false);
            }
        }
    }

    /*It takes one parameter: the letter chosen by the user as a string
    **It returns tru if the letter matches with one letterin the phrase, otherwise it returns false*/
    public function checkLetter($letter)
    {
        if (strpos(strtolower($this->currentPhrase), $letter) === false) {
            return false;
        }
        return true;
    }

    public function getArrayPhrase() {
        return $this->arrayPhrase;
    }

    public function getCurrentPhrase() {
        return $this->currentPhrase;
    }

    public function getCurrentPhraseId() {
        return $this->currentPhraseId;
    }

    /*It takes one optional parameter: the index of the previous phrase as an integer
    **It returns a random phrase from the ones stored in the $phrase array */
    private function getRandomPhrase($previousPhraseIndex = null)
    {
        $index = rand(0, count($this->phrases)- 1);
        if (!empty($previousPhraseIndex)) {
            while ($index == $previousPhraseIndex) {
                $index = rand(0, count($this->phrases)- 1);
            }
        }
        $this->currentPhraseId = $index;
        return $this->phrases[$index];
    }

    /*It takes no parameters
    **For each charachters in the phrase, it creates a new Letter objects, and store them in the $arrayPhrase **property*/
    private function setArrayPhrase()
    {
        $phraseArr = str_split($this->currentPhrase);

        foreach ($phraseArr as $char) {
            switch (true) {
                case preg_match("/\s/", $char):
                    $this->arrayPhrase[] = new Letter($char, "display", "space");
                    break;
                case preg_match("/[a-zA-Z]/", $char):
                    $this->arrayPhrase[] = new Letter($char, "hide", "letter");
                    break;
                case preg_match("/[,?!;:.']/", $char):
                    $this->arrayPhrase[] = new Letter($char, "display", "punctuation");
                    break;
                default:
                    $this->arrayPhrase[] = new Letter("*", "display", "punctuation");
                    break;
            }
        }
    }
}