<?php
namespace App\Controllers;

use App\Core\Controller;

class SertifikatController extends Controller {
    public function lihat(string $baseUrl = '..'): void {
        $this->view('sertifikat/lihat', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Sertifikat Kelulusan Resmi - Skill4Life',
        ]);
    }

    public function verifikasi(string $baseUrl = '..'): void {
        $this->view('sertifikat/verifikasi', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Verifikasi Sertifikat - Skill4Life',
        ]);
    }
}
