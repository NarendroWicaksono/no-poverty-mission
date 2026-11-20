<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION = [];
session_destroy();
$baseUrl = '..';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Keluar Akun - Skill4Life</title>
  <script>
    localStorage.removeItem('s4l_user');
    window.location.href = '<?= $baseUrl ?>/index.php';
  </script>
</head>
<body>
  <p style="text-align:center; padding:3rem; font-family:sans-serif;">Sedang keluar dari akun Skill4Life...</p>
</body>
</html>
