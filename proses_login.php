<?php
session_start();
include "config_log/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // validasi
    if (empty($email) || empty($password)) {
        $error = "Email dan password wajib diisi!";
    } else {

        // cek email sudah ada
        $cek = mysqli_query($koneksi, "SELECT * FROM tbl_formlog WHERE email='$email'");

        if (mysqli_num_rows($cek) > 0) {

            $error = "Email sudah terdaftar!";

        } else {

            // hash password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // insert database
            $query = mysqli_query($koneksi,
                "INSERT INTO tbl_formlog (email, password)
                 VALUES ('$email','$password_hash')"
            );

            if ($query) {

                // 🔥 AUTO LOGIN
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
  <title>Register</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>

    <?php if (isset($success)): ?>
        <script>
        Swal.fire({
          icon: 'success',
          title: 'Registrasi berhasil!',
          text: 'Selamat datang 👋',
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
          text: '<?php echo $error; ?>'
        }).then(() => {
          window.location = 'register.php';
        });
        </script>
    <?php endif; ?>

<?php endif; ?>

</body>
</html>
