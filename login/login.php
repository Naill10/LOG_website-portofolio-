<?php
include "../config_log/config.php";


session_start();



?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Register</title>
<link rel="stylesheet" href="style11.css">
</head>
<body>

<div class="container" id="container">

    <!-- SIGN UP -->
    <div class="form-container sign-up" >
        <form action="../proses_regis.php" method="POST">
            <h1>Create Account</h1>
            <input name="nama" type="text" placeholder="Name">
            <input name="email" type="email" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <button type="submit">Sign Up</button>
            <button type="button" onclick="window.location.href='sign_login.php'">Sign Up with Google</button>
        </form>
    </div>

    <!-- SIGN IN -->
    <div class="form-container sign-in" >
        <form action="../proses_login.php" method="POST">
            <h1>Sign In</h1>
            <input name="email" type="email" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <button type="submit">Sign In</button>
        </form>
    </div>

    <!-- OVERLAY -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel left">
                <h1>Welcome Back!</h1>
                <p>Login dengan akun kamu</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>

            <div class="overlay-panel right">
                <h1>Hello, Friend!</h1>
                <p>Daftar dulu biar bisa masuk</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>

</div>

<script src="script.js"></script>
</body>
</html>