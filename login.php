<?php
session_start();

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // md5 of XyZzy12*_php123
$failure = false;

if (isset($_POST['who']) && isset($_POST['pass'])) {
    if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1) {
        $failure = "User name and password are required";
    } else {
        $check = hash('md5', $salt . $_POST['pass']);
        if ($check == $stored_hash) {
            // Redirect to game.php with the user's name
            header("Location: game.php?name=" . urlencode($_POST['who']));
            return;
        } else {
            $failure = "Incorrect password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login Page</title></head>
<body>
    <h1>Please Log In</h1>
    <?php
    if ($failure !== false) {
        echo('<p style="color:red;">'.htmlentities($failure)."</p>\n");
    }
    ?>
    <form method="POST">
        <label for="who">User Name</label>
        <input type="text" name="who" id="who"><br/>
        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass"><br/>
        <input type="submit" value="Log In">
    </form>
</body>
</html>
