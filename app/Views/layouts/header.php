<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($baseUrl)) {
    if (file_exists('assets/css/variabel.css')) {
        $baseUrl = '.';
    } elseif (file_exists('../assets/css/variabel.css')) {
        $baseUrl = '..';
    } elseif (file_exists('../../assets/css/variabel.css')) {
        $baseUrl = '../..';
    } else {
        $baseUrl = '.';
    }
}
$judulSitus = isset($judulHalaman) ? htmlspecialchars($judulHalaman) : 'Skill4Life - Kursus Keterampilan Kerja Gratis dan Bersertifikat';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $judulSitus ?></title>
  <meta name="description" content="Skill4Life menyediakan kursus keterampilan kerja online gratis bersertifikat untuk mendukung SDG 1 No Poverty.">

  <link rel="icon" type="image/svg+xml" href="<?= $baseUrl ?>/assets/img/logo.svg">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Public+Sans:wght@400;500;600&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600&display=swap" rel="stylesheet">

  <script src="https://unpkg.com/lucide@latest"></script>

  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/variabel.css">
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/global.css">
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/komponen.css">
  <script>
    window.__S4L_USER__ = <?= json_encode($_SESSION['user'] ?? null, JSON_UNESCAPED_UNICODE) ?>;
  </script>
</head>
<body>

<?php
if (!isset($tanpaNavbar) || !$tanpaNavbar) {
    include __DIR__ . '/navbar.php';
}
?>

<main>
