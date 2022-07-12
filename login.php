<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Register on Photo Sharing App</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>
    <div class="header">
        <h2>Photo Sharing App - Login</h2>
    </div>

    <form method="post" action="login.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>

        <div class="input-group">
            <label>User Role</label>
            <select name="role" id="role">
                <option value="User">User</option>
                <option value="Admin">Admin</option>
            </select>
        </div>

        <div class="input-group">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
            Not yet registered? <a href="register.php">Sign up</a>
        </p>
    </form>
</body>

</html>