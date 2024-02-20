<?php
    $notice = '';
    $guessCount = 0;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userGuess = $_POST['guess'];
        $guessCount++;

        if (is_numeric($userGuess)) {
            if ($userGuess < 1 || $userGuess > 100) {
                $notice = 'Please enter a number between 1 and 100.';
            } else {
                $randomNumber = rand(1, 100);

                if ($userGuess == $randomNumber) {
                    $notice = 'Congratulations! You guessed the number.';
                } else if ($userGuess < $randomNumber) {
                    $notice = 'Your guess is too low.';
                } else if ($userGuess > $randomNumber) {
                    $notice = 'Your guess is too high.';
                }
            }
        } else {
            $notice = 'Please enter a valid number.';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guessing Game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Guess the Number</h1>
    <p>We have selected a random number between 1 and 100. See if you can guess it in 10 turns or fewer. We'll tell you if your guess was too high or too low.</p>
    <form id="guess-form" method="post">
        <label for="guess-field">Enter a guess: </label>
        <input type="text" id="guess-field" name="guess" class="guess-field">
        <input type="submit" value="Submit guess" class="guess-submit">
    </form>
    <div id="result-panel" class="result-panel">
        <p id="notice"> <?php echo $notice; ?> </p>
        <p id="guess-count">Number of guesses: <?php echo $guessCount; ?></p>
    </div>
    <script src="script.js"></script>
</body>
</html>