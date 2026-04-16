<?php
session_start();
require '../vendor/autoload.php';
include "../config_log/config.php";

$client = new Google_Client();
$client->setClientId('57784371766-bq1boo41c17b81nmacnuocjn91j9ab1a.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/LOG_WEB/login/google-callback.php');

// WAJIB: cek code dulu
if (!isset($_GET['code'])) {
    die("Akses tidak valid! Klik login Google dulu.");
}

// ambil token
$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

// cek error token
if (isset($token['error'])) {
    echo "<pre>";
    print_r($token);
    echo "</pre>";
    exit;
}

// set token (PAKAI ARRAY LANGSUNG)
$client->setAccessToken($token);

// ambil data user dari Google
$oauth = new Google_Service_Oauth2($client);
$user = $oauth->userinfo->get();

$email = $user->email;
$nama  = $user->name;

// cek user di database
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
$data = mysqli_fetch_assoc($query);

// kalau belum ada → insert
if (!$data) {
    mysqli_query($koneksi, "INSERT INTO users (name, email) VALUES ('$name', '$email')");
}

// login
$_SESSION['login'] = true;
$_SESSION['email'] = $email;

// redirect
header("Location: https://naill10.github.io/wesite_portofolio/");
exit;