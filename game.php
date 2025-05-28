<?php
session_start();

if (!isset($_GET['name']) || strlen($_GET['name']) < 1) {
    die("Name parameter missing");
}

$names = array("Rock", "Paper", "Scissors");
$human = isset($_POST["human"]) ? $_POST["human"] + 0 : -1;
$computer = rand(0, 2);  // Random computer choice
$result = false;

function check($computer, $human) {
    if ($human == $computer) {
        return "Tie";
    } elseif (($human == 0 && $computer == 2) ||
              ($human == 1 && $computer == 0) ||
              ($human == 2 && $computer == 1)) {
        return "You Win";
    } else {
        return "You Lose";
    }
}

if (isset($_POST["logout"])) {
    header("Location: index.php");
    return;
} elseif ($human == 3) {  // Test mode
    for ($c = 0; $c < 3; $c++) {
        for ($h = 0; $h < 3; $h++) {
            $r = check($c, $h);
            echo "Human={$names[$h]} Computer={$names[$c]} Result=$r<br>";
        }
    }
} elseif ($human >= 0 && $human <= 2) {
    $result = check($computer, $human);
}
?>

<!DOCTYPE html>
<html>
<head><title>RPS Game</title></head>
<body>
    <h1>Rock Paper Scissors</h1>
    <p>Welcome: <?= htmlentities($_GET['name']) ?></p>

    <form method="POST">
        <select name="human">
            <option value="-1">Select</option>
            <option value="0">Rock</option>
            <option value="1">Paper</option>
            <option value="2">Scissors</option>
            <option value="3">Test</option>
        </select>
        <input type="submit" value="Play">
        <input type="submit" name="logout" value="Logout">
    </form>

    <?php
    if ($result !== false) {
        echo "<p>Your Play={$names[$human]} Computer Play={$names[$computer]} Result=$result</p>";
    }
    ?>
</body>
</html>
