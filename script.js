const randomNumber = Math.floor(Math.random() * 100) + 1;
let attempts = 0;

function checkGuess() {
    const guess = parseInt(document.getElementById('guessInput').value);
    attempts++;

    if (guess === randomNumber) {
        document.getElementById('message').innerHTML = `Congratulations! You guessed the correct number in ${attempts} attempts.`;
    } else if (guess < randomNumber) {
        document.getElementById('message').innerHTML = 'Try a higher number.';
    } else {
        document.getElementById('message').innerHTML = 'Try a lower number.';
    }
}