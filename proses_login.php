<?php
session_start();
include "config_log/config.php";

$success = false;
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Email dan password wajib diisi!";
    } else {

        $email = mysqli_real_escape_string($koneksi, $email);

        $query = mysqli_query($koneksi, "SELECT * FROM tbl_regis WHERE email='$email'");

        if (mysqli_num_rows($query) > 0) {

            $user = mysqli_fetch_assoc($query);

            if (password_verify($password, $user['password'])) {

                session_regenerate_id(true);
                $_SESSION['email'] = $user['email'];
                $success = true;

            } else {
                $error = "Password salah!";
            }

        } else {
            $error = "Email tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php if ($success): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Login Berhasil!',
    timer: 2000,
    showConfirmButton: false
}).then(() => {
    window.location = 'https://naill10.github.io/wesite_portofolio/';
});
</script>
<?php else: ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Login Gagal!',
    text: '<?= $error ?>'
}).then(() => {
    window.location = 'login/login.php';
});
</script>
<?php endif; ?>

</body>
</html>