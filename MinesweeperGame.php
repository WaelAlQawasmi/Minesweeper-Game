<?php

/**
 * Summary of MinesweeperGame
 * - we set the position on Mines randomly
 * - Then add 1 to all neighbors of call 
 * 
 * @author Wael Al Qawasmi
 */
class MinesweeperGame
{
    private $minesPoisons = [];
    private array $matrix = [];
    private int $matrixSize = 3;

    public function __construct($matrixSize = 3)
    {
        $this->matrixSize = $matrixSize;
        $this->matrix = array_fill(0, $matrixSize, array_fill(0, $matrixSize, 0));
        $this->addMinesPoison();
        $this->calculateOtherPoisons();
    }

    private function addMinesPoison()
    {
        for ($i = 0; $i < $this->matrixSize; $i++) {
            $minesRow = rand(0, $this->matrixSize - 1);
            $minesCol = rand(0, $this->matrixSize - 1);
            if ($this->matrix[$minesRow][$minesCol] === "💥") {
                $i--;
                continue;
            }
            $this->minesPoisons[] = [$minesRow, $minesCol];
            $this->matrix[$minesRow][$minesCol] = '💥';
        }
    }

    public function getMatrixSize()
    {
        return $this->matrixSize;
    }

    private function calculateOtherPoisons()
    {
        $cellNeighbors = [
            [1, 0],  // Down
            [0, 1],  // Right
            [0, -1], // Left
            [-1, 0], // Up
            [1, 1],  // Down-Right
            [1, -1], // Down-Left
            [-1, -1], // Up-Left
            [-1, 1]  // Up-Right
        ];
        foreach ($this->minesPoisons as $mine) {
            $minesRow = $mine[0];
            $minesCol = $mine[1];
            foreach ($cellNeighbors as $neighbor) {
                $newRow = $minesRow + $neighbor[0];
                $newCol = $minesCol + $neighbor[1];
                if ($this->isValidPosition($newRow, $newCol))
                    $this->calculateCell($newRow, $newCol);
            }
        }
    }

    private function isValidPosition($row, $col)
    {
        return $row >= 0 && $row < $this->matrixSize && $col >= 0 && $col < $this->matrixSize;
    }

    /**
     * @desc if the cell didn't contain mines then will add 1 to it's value
     */
    private function calculateCell($row, $col)
    {
        if (is_numeric($this->matrix[$row][$col])) {
            $this->matrix[$row][$col] += 1;
        }
    }

    /**
     * @desc This method to render the matrix in backend on cmd line
     */
    public function renderTheMatrix()
    {
        for ($row = 0; $row < $this->matrixSize; $row++) {
            for ($col = 0; $col < $this->matrixSize; $col++) {
                echo $this->matrix[$row][$col] . ' ';
            }
            echo PHP_EOL;
        }
    }
    /**
     * @desc This method to render the matrix in html format
     */
    public function renderGameUI()
    {
        for ($row = 0; $row < $this->matrixSize; $row++) {
            echo '<div class="row">';
            for ($col = 0; $col < $this->matrixSize; $col++) {
                $cellValue = $this->matrix[$row][$col];
                echo "<button class=\"btn btn-secondary col  p-0 m-1\"  onclick=\"cellClicked(this,'$cellValue')\"><span class= \"invisible\">$cellValue</span></button>" . ' ';
            }
            echo '</div>';
        }
    }
}
