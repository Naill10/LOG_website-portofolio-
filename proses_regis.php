<?php
session_start();
include "config_log/config.php";

$success = false;
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($nama) || empty($email) || empty($password)) {
        $error = "Semua field wajib diisi!";
    } else {

        $email = mysqli_real_escape_string($koneksi, $email);

        $cek = mysqli_query($koneksi, "SELECT * FROM tbl_regis WHERE email='$email'");

        if (mysqli_num_rows($cek) > 0) {
            $error = "Email sudah terdaftar!";
        } else {

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $query = mysqli_query($koneksi,
                "INSERT INTO tbl_regis (nama, email, password)
                 VALUES ('$nama','$email','$password_hash')"
            );

            if ($query) {
                $_SESSION['email'] = $email;
                $success = true;
            } else {
                $error = "Gagal registrasi!";
            }
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
    title: 'Berhasil!',
    text: 'Akun dibuat',
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
    title: 'Gagal!',
    text: '<?= $error ?>'
}).then(() => {
    window.location = 'login/login.php';
});
</script>
<?php endif; ?>

</body>
</html>