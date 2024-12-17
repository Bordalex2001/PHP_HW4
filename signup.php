<?php
const USER_FILE = 'users.json';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Please fill in all fields.";
    }

    if (!file_exists(USER_FILE))
    {
        file_put_contents(USER_FILE, json_encode([]));
    }

    $users = json_decode(file_get_contents(USER_FILE), true);

    foreach ($users as $user)
    {
        if ($user['username'] === $username)
        {
            echo "Username already exists.";
            exit;
        }
    }

    $users[] = [
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ];

    file_put_contents(USER_FILE, json_encode($users, JSON_PRETTY_PRINT));
    echo "Registration is successful! <a href='signin.php'>Sign in</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Register</h2>
<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Sign up</button>
</form>
</body>
</html>