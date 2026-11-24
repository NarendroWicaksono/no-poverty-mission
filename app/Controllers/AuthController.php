<?php
namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller {
    public function login(string $baseUrl = '..'): void {
        $user = $this->currentUser();
        if ($user && !isset($_GET['ganti'])) {
            if (($user['peran'] ?? '') === 'admin') {
                $this->redirect($baseUrl . '/pengelola/index.php');
            }
            $this->redirect($baseUrl . '/dashboard/index.php');
        }

        $this->view('auth/login', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Masuk Akun - Skill4Life',
        ]);
    }

    public function daftar(string $baseUrl = '..'): void {
        $user = $this->currentUser();
        if ($user && ($user['peran'] ?? '') === 'peserta') {
            $this->redirect($baseUrl . '/dashboard/index.php');
        }

        $this->view('auth/daftar', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Pendaftaran Akun - Skill4Life',
        ]);
    }

    public function logout(string $baseUrl = '..'): void {
        $_SESSION = [];
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $this->redirect($baseUrl . '/index.php');
    }
}
