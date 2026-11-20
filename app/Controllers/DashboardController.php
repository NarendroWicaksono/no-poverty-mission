<?php
namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller {
    public function index(string $baseUrl = '..'): void {
        $this->requirePeserta($baseUrl);
        $this->view('dashboard/index', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Dashboard Peserta - Skill4Life',
        ]);
    }

    public function profil(string $baseUrl = '..'): void {
        $this->requirePeserta($baseUrl);
        $this->view('dashboard/profil', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Pengaturan Profil - Skill4Life',
        ]);
    }
}
