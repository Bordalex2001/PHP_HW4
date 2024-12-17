<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
elseif (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $_SESSION['username'] = $username;
}
else {
    header('Location: signin.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <a href="signout.php">Sign out</a>
</body>
</html>