<?php
session_start();

// Initializing variables
$username = "";
$errors = array();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'cafe'); // Fix: added database name in correct place

// REGISTER USER
if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);

    // Form validation
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if ($password != $confirm_password) {
        array_push($errors, "The two passwords do not match");
    }

    // Check if user already exists
    $user_check_query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }
    }

    // Register user if no errors
    if (count($errors) == 0) {
        $password = md5($password); // encrypt the password
        $query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You have signed up successfully.";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
        exit();
    }
}
?>
