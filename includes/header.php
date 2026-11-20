<?php
// Deteksi path relatif ke root folder proyek
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

  <!-- Favicon SVG Cap Kecil -->
  <link rel="icon" type="image/svg+xml" href="<?= $baseUrl ?>/assets/img/logo.svg">

  <!-- Google Fonts: Hanya 3 keluarga (Public Sans, Source Serif 4, JetBrains Mono) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Public+Sans:wght@400;500;600&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600&display=swap" rel="stylesheet">

  <!-- Ikon Lucide CDN (Stroke 1.5 seragam, tanpa framework berat) -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Design Tokens & CSS Terstruktur -->
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/variabel.css">
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/global.css">
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/komponen.css">
</head>
<body>

<?php
// Muat navigasi jika bukan di dalam mode lembar cetak khusus
if (!isset($tanpaNavbar) || !$tanpaNavbar) {
    include __DIR__ . '/navbar.php';
}
?>

<main>
