<?php

class Game
{
    private $playerName;
    private $playerStones = array();
    private $computerStones = array();

    public function __construct($playerName)
    {
        $this->playerName = $playerName;
    }

    public function start()
    {
        echo "Добро пожаловать в игру Жадюги!\n";
        echo "Нажмите любую клавишу, чтобы начать игру...\n";
        $this->readline();

        $this->play();
    }

    private function play()
    {
        $this->playerStones = $this->generateStones();
        $this->computerStones = $this->generateStones();

        while (count($this->playerStones) > 0 && count($this->computerStones) > 0) {
            $this->printGameState();

            $playerStone = $this->getPlayerStone();
            $computerStone = $this->getComputerStone();

            $this->removeStone($playerStone, $this->playerStones);
            $this->removeStone($computerStone, $this->computerStones);

            $this->printResult($playerStone, $computerStone);
        }

        $this->printWinner();
    }

    private function generateStones()
    {
        $stones = array();
        $stoneTypes = array("красный", "зеленый", "синий");

        for ($i = 0; $i < 3; $i++) {
            $randomIndex = rand(0, 2);
            $stones[] = $stoneTypes[$randomIndex];
        }

        return $stones;
    }

    private function getPlayerStone()
    {
        echo "Выберите камень (красный, зеленый, синий): ";
        $stone = $this->readline();

        while (!in_array($stone, $this->playerStones)) {
            echo "Неверный выбор. Попробуйте еще раз: ";
            $stone = $this->readline();
        }

        return $stone;
    }

    private function getComputerStone()
    {
        $randomIndex = rand(0, count($this->computerStones) - 1);
        return $this->computerStones[$randomIndex];
    }

    private function removeStone($stone, &$stones)
    {
        $index = array_search($stone, $stones);
        unset($stones[$index]);
        $stones = array_values($stones);
    }

    private function printGameState()
    {
        echo "\n";
        echo "Игрок: " . $this->playerName . "\n";
        echo "Ваши камни: " . implode(", ", $this->playerStones) . "\n";
        echo "\n";
        echo "Компьютер:\n";
        echo "Камни: " . implode(", ", $this->computerStones) . "\n";
        echo "\n";
    }

    private function printResult($playerStone, $computerStone)
    {
        echo "Вы выбрали: " . $playerStone . "\n";
        echo "Компьютер выбрал: " . $computerStone . "\n";
        echo "\n";
    }

    private function printWinner()
    {
        if (count($this->playerStones) == 0) {
            echo "Вы проиграли! Компьютер победил.\n";
        } else {
            echo "Вы победили! Компьютер проиграл.\n";
        }
    }

    private function readline()
    {
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        fclose($handle);
        return trim($line);
    }
}

echo "Введите ваш никнейм: ";
$playerName = readline();

$game = new Game($playerName);
$game->start();