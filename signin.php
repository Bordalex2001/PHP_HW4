<?php
session_start();
const USER_FILE = 'users.json';

if (isset($_SESSION['username']))
{
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!file_exists(USER_FILE))
    {
        echo 'File \'users.json\' not found!';
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember_me = isset($_POST['remember_me']);
    $user_is_valid = false;

    $users = json_decode(file_get_contents(USER_FILE), true);

    foreach ($users as $user){
        if ($username === $user['username'] && password_verify($password, $user['password'])){
            $user_is_valid = true;
            break;
        }
    }

    if ($user_is_valid)
    {
        $_SESSION['username'] = $username;

        if ($remember_me)
        {
            setcookie('remember_me', $username, time() + (86400 * 30));
        }

        header('Location: index.php');
        exit;
    }
    else
    {
        echo 'Invalid username or password!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Remember Me: <input type="checkbox" name="remember_me"><br><br>
    <button type="submit">Sign in</button>
</form>
</body>
</html>