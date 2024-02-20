let randomNumber = Math.floor(Math.random() * 100) + 1;
let guessCount = 0;
let noticeText = '';

document.getElementById('guess-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let userGuess = parseInt(document.getElementById('guess-field').value);
    guessCount++;

    if (isNaN(userGuess)) {
        noticeText = 'Please enter a valid number.';
    } else if (userGuess < 1 || userGuess > 100) {
        noticeText = 'Please enter a number between 1 and 100.';
    } else {
        if (userGuess === randomNumber) {
            noticeText = 'Congratulations! You guessed the number.';
        } else if (userGuess < randomNumber) {
            noticeText = 'Your guess is too low.';
        } else if (userGuess > randomNumber) {
            noticeText = 'Your guess is too high.';
        }
    }

    document.getElementById('notice').textContent = noticeText;
    document.getElementById('guess-count').textContent = 'Number of guesses: ' + guessCount;

    document.getElementById('guess-field').value = '';
});