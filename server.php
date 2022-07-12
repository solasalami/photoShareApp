<?php
session_start();

// initialize application variables
$username = "";
$email    = "";
$role    = "";
$errors = array();

// connect to the database
// pass database credentials

$db = mysqli_connect('localhost', 'root', 'password2$', 'photosharingwebapp');

// Register the User  
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $role = mysqli_real_escape_string($db, $_POST['role']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // Validate all input entered by the user on the form.
    // add any  corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Username is required !");
    }
    if (empty($email)) {
        array_push($errors, "Email is required !");
    }
    if (empty($role)) {
        array_push($errors, "Role is required !");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required !");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The compare passwords do not match !");
    }

    // validate and check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "The username already exists !");
        }

        if ($user['email'] === $email) {
            array_push($errors, "The email already exists !");
        }
    }

    // register user if there are no errors encountered
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database for security reasons using md5 algorithm

        $query = "INSERT INTO users (username, email, password,role) VALUES('$username', '$email', '$password','$role')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";

        if ($role == "Admin") {
            header('location: admin/uploadImage.php');
        } else {
            header('location: index.php');
        }
    }
}

// Login User here
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['success'] = "You are now logged in";

            if ($role == "Admin") {
                header('location: admin/uploadImage.php');
            } else {
                header('location: index.php');
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
