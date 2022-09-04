<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications Management System</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
</head>
<h1 class="main">PUBLICATION MANAGEMENT SYSTEM</h1>
<div class="signer">
    <form class="sign" action="core.php" method="post">
        <h1 class="title">Create a free account now</h1>
        <input class="input" name="firstname" type="text" placeholder="First Name">
        <br>
        <input class="input" name="lastname" type="text" placeholder="Last Name">
        <br>
        <input class="input" name="email" type="text" placeholder="Email">
        <br>
        <input class="input" name="username" type="text" placeholder="Username">
        <br>
        <input class="input" name="password" type="password" placeholder="Password">
        <br>
        <input class="input" name="register" type="submit" value="Sign Up" id="button">
        <br>
        <p> Already Have an account? <a href="signin.php">Sign In</a></p>
    </form>
</div>
<footer id="pms">A Group C Production © 2022 All Rights Reserved.</footer>
</body>

</html>-