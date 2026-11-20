<?php
namespace App\Controllers;

use App\Core\Controller;

class AdminController extends Controller {
    public function login(string $baseUrl = '..'): void {
        $user = $this->currentUser();
        if ($user && ($user['peran'] ?? '') === 'admin') {
            $this->redirect($baseUrl . '/admin/index.php');
        }

        $this->view('admin/login', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Masuk Pengelola - Skill4Life',
            'tanpaNavbar' => true,
        ]);
    }

    public function index(string $baseUrl = '..'): void {
        $this->requireAdmin($baseUrl);
        $this->view('admin/index', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Ringkasan Statistik - Panel Pengelola Skill4Life',
            'tanpaNavbar' => true,
            'layoutAdmin' => true,
        ]);
    }

    public function kursus(string $baseUrl = '..'): void {
        $this->requireAdmin($baseUrl);
        $this->view('admin/kursus', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Kelola Kursus - Panel Pengelola Skill4Life',
            'tanpaNavbar' => true,
            'layoutAdmin' => true,
        ]);
    }

    public function modul(string $baseUrl = '..'): void {
        $this->requireAdmin($baseUrl);
        $this->view('admin/modul', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Kelola Modul Pembelajaran - Panel Pengelola Skill4Life',
            'tanpaNavbar' => true,
            'layoutAdmin' => true,
        ]);
    }

    public function kuis(string $baseUrl = '..'): void {
        $this->requireAdmin($baseUrl);
        $this->view('admin/kuis', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Kelola Soal Kuis - Panel Pengelola Skill4Life',
            'tanpaNavbar' => true,
            'layoutAdmin' => true,
        ]);
    }

    public function peserta(string $baseUrl = '..'): void {
        $this->requireAdmin($baseUrl);
        $this->view('admin/peserta', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Data Peserta & Sertifikat - Panel Pengelola Skill4Life',
            'tanpaNavbar' => true,
            'layoutAdmin' => true,
        ]);
    }
}
