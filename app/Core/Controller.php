<?php
namespace App\Core;

abstract class Controller {
    /**
     * Render view di dalam layout utama (header + view + footer).
     */
    protected function view(string $viewPath, array $data = []): void {
        extract($data);
        $baseUrl = $data['baseUrl'] ?? '.';
        $judulHalaman = $data['judulHalaman'] ?? 'Skill4Life - Kursus Keterampilan Kerja Gratis dan Bersertifikat';
        $tanpaNavbar = $data['tanpaNavbar'] ?? false;
        $layoutAdmin = $data['layoutAdmin'] ?? false;

        $viewsRoot = dirname(__DIR__) . '/Views';
        include $viewsRoot . '/layouts/header.php';

        if ($layoutAdmin) {
            include $viewsRoot . '/layouts/admin_topbar.php';
            echo '<div class="tata-aplikasi">';
            include $viewsRoot . '/layouts/admin_sidebar.php';
            echo '<main class="konten-aplikasi">';
            include $viewsRoot . '/' . $viewPath . '.php';
            echo '</main></div>';
        } else {
            include $viewsRoot . '/' . $viewPath . '.php';
        }

        include $viewsRoot . '/layouts/footer.php';
    }

    /**
     * Kirim response JSON dan hentikan eksekusi.
     */
    protected function json(array $payload, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Redirect HTTP.
     */
    protected function redirect(string $url): void {
        header('Location: ' . $url);
        exit;
    }

    /**
     * Ambil data pengguna dari session aktif.
     */
    protected function currentUser(): ?array {
        return $_SESSION['user'] ?? null;
    }

    /**
     * Guard server-side untuk halaman dashboard peserta.
     */
    protected function requirePeserta(string $baseUrl = '..'): array {
        $user = $this->currentUser();
        if (!$user) {
            $this->redirect($baseUrl . '/auth/login.php?pesan=harap_login');
        }
        if (($user['peran'] ?? '') === 'admin') {
            $this->redirect($baseUrl . '/admin/index.php');
        }
        return $user;
    }

    /**
     * Guard server-side untuk halaman panel admin.
     */
    protected function requireAdmin(string $baseUrl = '..'): array {
        $user = $this->currentUser();
        if (!$user || ($user['peran'] ?? '') !== 'admin') {
            $this->redirect($baseUrl . '/admin/login.php');
        }
        return $user;
    }

    /**
     * Guard server-side untuk endpoint API khusus peserta/pengguna terautentikasi.
     */
    protected function requireUserJson(): array {
        $user = $this->currentUser();
        if (!$user || !isset($user['id'])) {
            $this->json(['ok' => false, 'butuh_login' => true, 'pesan' => 'Sesi tidak ditemukan. Silakan masuk terlebih dahulu.'], 401);
        }
        return $user;
    }

    /**
     * Guard server-side untuk endpoint API khusus admin.
     */
    protected function requireAdminJson(): array {
        $user = $this->currentUser();
        if (!$user || ($user['peran'] ?? '') !== 'admin') {
            $this->json(['ok' => false, 'pesan' => 'Akses ditolak. Khusus pengelola (admin).'], 403);
        }
        return $user;
    }

    /**
     * Validasi CSRF token pada request POST API (via header X-CSRF-Token atau payload).
     */
    protected function verifyCsrfJson(array $input = []): void {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            return;
        }
        $sessionToken = $_SESSION['csrf_token'] ?? '';
        $headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($input['csrf_token'] ?? '');
        if (!$sessionToken || !$headerToken || !hash_equals($sessionToken, (string)$headerToken)) {
            $this->json(['ok' => false, 'pesan' => 'Token keamanan (CSRF) tidak valid atau kedaluwarsa. Muat ulang halaman dan coba lagi.'], 403);
        }
    }

    /**
     * Baca payload JSON atau POST body.
     */
    protected function getJsonInput(): array {
        $raw = file_get_contents('php://input');
        if (!$raw) {
            return $_POST;
        }
        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : $_POST;
    }
}
