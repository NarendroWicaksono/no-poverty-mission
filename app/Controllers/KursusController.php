<?php
namespace App\Controllers;

use App\Core\Controller;

class KursusController extends Controller {
    public function katalog(string $baseUrl = '..'): void {
        $this->view('kursus/katalog', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Katalog Kursus Keterampilan Kerja - Skill4Life',
        ]);
    }

    public function detail(string $baseUrl = '..'): void {
        $this->view('kursus/detail', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Rincian Kursus - Skill4Life',
        ]);
    }

    public function belajar(string $baseUrl = '..'): void {
        $this->view('kursus/belajar', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Ruang Belajar - Skill4Life',
        ]);
    }

    public function kuis(string $baseUrl = '..'): void {
        // Wajib login sebelum mengerjakan kuis akhir kelulusan agar sertifikat dapat diterbitkan
        if (!$this->currentUser()) {
            $this->redirect($baseUrl . '/auth/login.php?pesan=harap_login');
        }

        $this->view('kursus/kuis', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Kuis Akhir Kelulusan - Skill4Life',
        ]);
    }
}
