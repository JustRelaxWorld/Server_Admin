<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <?php if (count($errors) > 0): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="success">
                <p><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
            </div>
        <?php endif ?>

        <form method="post" action="process.php">
            <label for="username">Username</label>
            <input type="text" name="username" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <button type="submit" name="reg_user">Register</button>
        </form>
    </div>
</body>
</html>

