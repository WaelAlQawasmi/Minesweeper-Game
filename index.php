<?php include('./MinesweeperGame.php'); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minesweeper Game</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="col-auto" id="reload" onclick=" location.reload();">
        <i> ↻</i> Play Again
    </div>
    <div class="container mt-5">
        <p id="message" class="alert"> </p>
        <h3 class="text-center">Simple Minesweeper Game</h3>
        <?php
        $MinesweeperGame = new MinesweeperGame($_GET['level']??2);
        $MinesweeperGame->renderGameUI();
        ?>
    </div>
</body>
<script type="text/javascript">
    let unClickedButton = Math.pow(<?= $MinesweeperGame->getMatrixSize() ?>,2);
    let numberOfMines = <?= $MinesweeperGame->getMatrixSize() ?>;
</script>
<script src="./index.js"></script>

</html>