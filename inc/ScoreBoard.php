<?php

class ScoreBoard
{
    public $lives = 5;
    private $remainingLives = 5;
    private $urlLiveHeart = "images/liveHeart.png";
    private $urlLostHeart = "images/lostHeart.png";

    public function __construct($lives = null)
    {
        if (!empty($lives)) {
            $this->lives = $lives;
            $this->remainingLives = $lives;
        }
    }

    public function display()
    {
        $lostLives = $this->lives - $this->remainingLives;
        $result = "<div id='scoreboard' class='section'><ol>";
        $result .= "<h4>Remaining Lives</h4>";

        for ($i = 0; $i < $this->remainingLives; $i++) { 
           $result .= " <li class='tries'><img src='$this->urlLiveHeart' height='35px' widght='30px'></li>";
        }

        for ($i = 0; $i < $lostLives; $i++) { 
            $result .= " <li class='tries'><img src='$this->urlLostHeart' height='35px' widght='30px'></li>";
        }

        $result .= "</ol></div>";

        return $result;

    }

    public function update()
    {
        $this->remainingLives -= 1;
    }

    public function getRemainingLives()
    {
        return $this->remainingLives;
    }
}
