function cellClicked(element, val) {
    if (val !== '💥') {
        handleSafeCellClick(element);
    } else {
        handleMineClicked();
    }

    checkGameStatus();
}

function handleSafeCellClick(element) {
    element.disabled = true;
    element.children[0].classList.remove('invisible');
    unClickedButton--;
}

function handleMineClicked() {
    const elements = document.querySelectorAll(".invisible");
    elements.forEach(hiddenElement => {
        hiddenElement.parentNode.disabled = true;
        hiddenElement.classList.remove('invisible');
    });

    showAlert('failure')
}

function checkGameStatus() {
    if (unClickedButton === numberOfMines) {
        document.getElementById('reload').classList.remove('invisible');
        showAlert('success')
    }
}

function showAlert(status) {
    const messageElement = document.getElementById('message');
    switch (status) {
        case 'success': {
            messageElement.classList.add('alert-success');
            messageElement.innerHTML = `You won the game! <a href=\"./index.php?level=${numberOfMines+1}\">Go Next level </a>`
;
            break;
        }
        case 'failure': {
            messageElement.classList.add('alert-danger');
            messageElement.innerHTML = "Game Over! <a href=\"./index.php\"> <i> ↻</i> Play Again </a>";
        }
    }
}