<?php
namespace App\Models;

use PDO;

class PenggunaModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function autentikasi(string $email, string $kataSandi, string $peranDiharapkan = 'peserta'): array {
        $emailBersih = strtolower(trim($email));
        if (!$emailBersih || strlen($kataSandi) < 8) {
            return ['ok' => false, 'pesan' => 'Alamat email dan kata sandi (minimal 8 karakter) wajib diisi.'];
        }

        $stmt = $this->pdo->prepare("SELECT * FROM pengguna WHERE LOWER(email) = ? LIMIT 1");
        $stmt->execute([$emailBersih]);
        $userRow = $stmt->fetch();

        if (!$userRow) {
            $pesan = $peranDiharapkan === 'admin'
                ? 'Email atau kata sandi pengelola tidak cocok.'
                : 'Email belum terdaftar. Silakan buat akun gratis terlebih dahulu.';
            return ['ok' => false, 'pesan' => $pesan];
        }

        if ($peranDiharapkan === 'admin' && $userRow['peran'] !== 'admin') {
            return ['ok' => false, 'pesan' => 'Email atau kata sandi pengelola tidak cocok.'];
        }

        if (!password_verify($kataSandi, $userRow['kata_sandi'])) {
            return ['ok' => false, 'pesan' => 'Kata sandi yang Anda masukkan salah.'];
        }

        $sesi = [
            'id' => (int)$userRow['id'],
            'nama_lengkap' => $userRow['nama_lengkap'],
            'email' => $userRow['email'],
            'nomor_telepon' => $userRow['nomor_telepon'] ?: '-',
            'pekerjaan' => $userRow['pekerjaan'] ?: 'Pencari kerja',
            'kota' => $userRow['kota'] ?: 'Indonesia',
            'peran' => $userRow['peran'],
        ];

        return ['ok' => true, 'user' => $sesi];
    }

    public function registrasi(array $in): array {
        $nama = trim($in['nama_lengkap'] ?? '');
        $email = strtolower(trim($in['email'] ?? ''));
        $sandi = (string)($in['kata_sandi'] ?? '');
        $pekerjaan = trim($in['pekerjaan'] ?? '') ?: 'Pencari kerja';
        $kota = trim($in['kota'] ?? '') ?: 'Indonesia';

        if (!$nama || !$email || strlen($sandi) < 8) {
            return ['ok' => false, 'pesan' => 'Lengkapi seluruh data formulir. Kata sandi minimal 8 karakter.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['ok' => false, 'pesan' => 'Format alamat email tidak valid.'];
        }

        $cek = $this->pdo->prepare("SELECT id FROM pengguna WHERE LOWER(email) = ? LIMIT 1");
        $cek->execute([$email]);
        if ($cek->fetchColumn()) {
            return ['ok' => false, 'pesan' => 'Alamat email ini sudah terdaftar. Silakan masuk menggunakan email tersebut.'];
        }

        $hash = password_hash($sandi, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("
            INSERT INTO pengguna (nama_lengkap, email, kata_sandi, peran, nomor_telepon, pekerjaan, kota)
            VALUES (?, ?, ?, 'peserta', '-', ?, ?)
        ");
        $stmt->execute([$nama, $email, $hash, $pekerjaan, $kota]);
        $idBaru = (int)$this->pdo->lastInsertId();

        $sesi = [
            'id' => $idBaru,
            'nama_lengkap' => $nama,
            'email' => $email,
            'nomor_telepon' => '-',
            'pekerjaan' => $pekerjaan,
            'kota' => $kota,
            'peran' => 'peserta',
        ];

        return ['ok' => true, 'user' => $sesi];
    }

    public function perbaruiProfil(array $sesi, array $in): array {
        $namaBaru = trim($in['nama_lengkap'] ?? '') ?: $sesi['nama_lengkap'];
        $teleponBaru = trim($in['nomor_telepon'] ?? '');
        $pekerjaanBaru = trim($in['pekerjaan'] ?? '');
        $kotaBaru = trim($in['kota'] ?? '') ?: ($sesi['kota'] ?? 'Indonesia');

        $stmt = $this->pdo->prepare("
            UPDATE pengguna
            SET nama_lengkap = ?, nomor_telepon = ?, pekerjaan = ?, kota = ?
            WHERE id = ?
        ");
        $stmt->execute([$namaBaru, $teleponBaru, $pekerjaanBaru, $kotaBaru, $sesi['id']]);

        $sesiBaru = array_merge($sesi, [
            'nama_lengkap' => $namaBaru,
            'nomor_telepon' => $teleponBaru,
            'pekerjaan' => $pekerjaanBaru,
            'kota' => $kotaBaru,
        ]);

        return ['ok' => true, 'user' => $sesiBaru];
    }

    public function ubahKataSandi(int $penggunaId, string $sandiLama, string $sandiBaru): array {
        if (!$sandiLama || strlen($sandiBaru) < 8) {
            return ['ok' => false, 'pesan' => 'Masukkan kata sandi lama dan kata sandi baru (minimal 8 karakter).'];
        }

        $stmt = $this->pdo->prepare("SELECT kata_sandi FROM pengguna WHERE id = ? LIMIT 1");
        $stmt->execute([$penggunaId]);
        $hashLama = $stmt->fetchColumn();

        if (!$hashLama || !password_verify($sandiLama, $hashLama)) {
            return ['ok' => false, 'pesan' => 'Kata sandi saat ini tidak sesuai.'];
        }

        $hashBaru = password_hash($sandiBaru, PASSWORD_BCRYPT);
        $upd = $this->pdo->prepare("UPDATE pengguna SET kata_sandi = ? WHERE id = ?");
        $upd->execute([$hashBaru, $penggunaId]);

        return ['ok' => true, 'pesan' => 'Kata sandi akun berhasil diperbarui.'];
    }

    public function ambilSemuaPeserta(): array {
        $rows = $this->pdo->query("
            SELECT p.id, p.nama_lengkap, p.email, p.nomor_telepon, p.pekerjaan, p.kota, p.dibuat_pada,
                   (SELECT COUNT(*) FROM sertifikat s WHERE s.pengguna_id = p.id) AS jumlah_sertifikat,
                   (SELECT COUNT(DISTINCT hk.kursus_id) FROM hasil_kuis hk WHERE hk.pengguna_id = p.id AND hk.status_lulus = 'Lulus') AS kursus_selesai
            FROM pengguna p
            WHERE p.peran = 'peserta'
            ORDER BY p.id DESC
        ")->fetchAll();

        return array_map(fn($r) => [
            'id' => (int)$r['id'],
            'nama' => $r['nama_lengkap'],
            'email' => $r['email'],
            'nomor_telepon' => $r['nomor_telepon'] ?: '-',
            'pekerjaan' => $r['pekerjaan'] ?: 'Pencari kerja',
            'kota' => $r['kota'] ?: 'Indonesia',
            'kursus_selesai' => max((int)$r['kursus_selesai'], (int)$r['jumlah_sertifikat']),
            'sertifikat' => (int)$r['jumlah_sertifikat'],
            'status' => 'Aktif',
            'tgl_daftar' => substr((string)$r['dibuat_pada'], 0, 10),
        ], $rows);
    }
}
