<!DOCTYPE html>
<html>
<head>
  <title>Snake Game</title>
</head>
<body>
  <pre id="game"></pre>
  <?php
  class Snake {
    public $width = 0;
    public $height = 0;

    public $positionX = 0;
    public $positionY = 0;

    public $appleX = 15;
    public $appleY = 15;

    public $movementX = 0;
    public $movementY = 0;

    public $trail = [];
    public $tail = 5;

    public $speed = 100000;

    public function __construct($width, $height) {
      $this->width = $width;
      $this->height = $height;

      $this->positionX = rand(0, $width - 1);
      $this->positionY = rand(0, $height - 1);

      $appleX = rand(0, $width - 1);
      $appleY = rand(0, $height - 1);

      while (array_search([$appleX, $appleY], $this->trail) !== FALSE) {
        $appleX = rand(0, $width - 1);
        $appleY = rand(0, $height - 1);
      }
      $this->appleX = $appleX;
      $this->appleY = $appleY;
    }
  }

  function translateKeypress($key) {
    switch ($key) {
      case "w":
        return "UP";
      case "s":
        return "DOWN";
      case "d":
        return "RIGHT";
      case "a":
        return "LEFT";
    }
    return "";
  }

  function direction($stdin, $snake) {
    if (isset($_GET['direction'])) {
      $key = $_GET['direction'];
      if ($key) {
        $key = translateKeypress($key);
        switch ($key) {
          case "UP":
            $snake->movementX = -1;
            $snake->movementY = 0;
            break;
          case "DOWN":
            $snake->movementX = 1;
            $snake->movementY = 0;
            break;
          case "RIGHT":
            $snake->movementX = 0;
            $snake->movementY = 1;
            break;
          case "LEFT":
            $snake->movementX = 0;
            $snake->movementY = -1;
            break;
         }
      }
    }
  }

  function move($snake) {
    // Move the snake.
    $snake->positionX += $snake->movementX;
    $snake->positionY += $snake->movementY;

    // Wrap the snake around the boundaries of the board.
    if ($snake->positionX < 0) {
      $snake->positionX = $snake->width - 1;
    }
    if ($snake->positionX > $snake->width - 1) {
      $snake->positionX = 0;
    }
    if ($snake->positionY < 0) {
      $snake->positionY = $snake->height - 1;
    }
    if ($snake->positionY > $snake->height - 1) {
      $snake->positionY = 0;
    }

    // Add to the snakes trail at the front.
    array_unshift($snake->trail, [$snake->positionX, $snake->positionY]);

    // Remove a block from the end of the snake (but keep correct length).
    if (count($snake->trail) > $snake->tail) {
      array_pop($snake->trail);
    }

    if ($snake->appleX == $snake->positionX && $snake->appleY == $snake->positionY) {
      // The snake has eaten an apple.
      $snake->tail++;

      if ($snake->speed > 2000) {
        // Increase the speed of the game up to a certain limit.
        $snake->speed = $snake->speed - ($snake->tail * ($snake->width / $snake->height + 10));
      }
      // Figure out a different place for the apple.
      $appleX = rand(0, $snake->width - 1);
      $appleY = rand(0, $snake->height - 1);
      while (array_search([$appleX, $appleY], $snake->trail) !== FALSE) {
        $appleX = rand(0, $snake->width - 1);
        $appleY = rand(0, $snake->height - 1);
      }
      $snake->appleX = $appleX;
      $snake->appleY = $appleY;
    }
  }

  function gameOver($snake) {
    if ($snake->tail > 5) {
      // If the trail is greater than 5 then check for end condition.
      for ($i = 1; $i < count($snake->trail); $i++) {
        if ($snake->trail[$i][0] == $snake->positionX && $snake->trail[$i][1] == $snake->positionY) {
          die('dead :(');
        }
      }
    }
  }

  $width = 20;
  $height = 30;
  $snake = new Snake($width, $height);
  $stdin = fopen("php://stdin", "r");

  while (1) {
    echo "<script>document.location.href='?direction=" . $snake->movementX . "&" . $snake->movementY . "';</script>";
    system('clear');
   