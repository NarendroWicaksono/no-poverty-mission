<?php
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'sukses' => true,
    'pesan' => 'Modul berhasil ditandai selesai (Mode Frontend/Demo)',
    'persen' => 100
]);
