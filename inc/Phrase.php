<?php

class Phrase implements Board
{
    private $currentPhrase;
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
        "The Good, the Ugly and the Bad"
    ];

    public function __construct($currentPhrase = null, $selected = null)
    {
       if (!empty($currentPhrase)) {
           $this->currentPhrase = $currentPhrase;
       } else {
          $this->currentPhrase = $this->getRandomPhrase(); 
       }

       if (!empty($selected)) {
           $this->selected = $selected;
       }

       $this->setArrayPhrase();
    }

    public function display()
    {
        $phrase = "<div id='phrase' class='section'>";
        $phrase .= $this->addPhraseToDisplay();
        $phrase .= "</div>";

        return $phrase;
    }

    private function addPhraseToDisplay()
    {
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

    public function update($letter= null, $newStatus = null)
    {
        foreach ($this->arrayPhrase as $char) {
            if ($letter == strtolower($char->getContent())) {
                $char->setStatus("show");
                $char->setAnimate(true);
            } else {
                $char->setAnimate(false);
            }
        }
    }

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

    private function getRandomPhrase()
    {
        return $this->phrases[rand(0, count($this->phrases) - 1)];
    }

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
                case preg_match("/[,?!;:.]/", $char):
                    $this->arrayPhrase[] = new Letter($char, "display", "punctuation");
                    break;
                default:
                    $this->arrayPhrase[] = new Letter("*", "display", "punctuation");
                    break;
            }
        }
    }
}