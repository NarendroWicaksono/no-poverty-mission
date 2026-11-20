<?php
/**
 * api/index.php
 * Endpoint REST API PHP Native untuk Skill4Life (MySQL + PHP Session).
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/koneksi.php';

$aksi = $_GET['aksi'] ?? '';
$pdo = buatKoneksi();

if (!$pdo) {
    http_response_code(503);
    echo json_encode([
        'ok' => false,
        'pesan' => 'Koneksi database MySQL gagal. Pastikan layanan MySQL di Laragon aktif dan database db_skill4life tersedia.'
    ]);
    exit;
}

/**
 * Baca payload JSON dari request body.
 */
function bacaInputJSON(): array {
    $raw = file_get_contents('php://input');
    if (!$raw) {
        return $_POST;
    }
    $decoded = json_decode($raw, true);
    return is_array($decoded) ? $decoded : $_POST;
}

/**
 * Pastikan user adalah admin sebelum menjalankan aksi CRUD panel pengelola.
 */
function wajibAdmin(): void {
    $user = $_SESSION['user'] ?? null;
    if (!$user || ($user['peran'] ?? '') !== 'admin') {
        http_response_code(403);
        echo json_encode(['ok' => false, 'pesan' => 'Akses ditolak. Khusus pengelola (admin).']);
        exit;
    }
}

/**
 * Format baris kursus dari DB agar kompatibel dengan frontend.
 */
function formatKursus(array $row): array {
    $tujuan = array_values(array_filter(array_map('trim', explode("\n", $row['tujuan_belajar'] ?? ''))));
    return [
        'id_kursus' => (int)$row['id'],
        'judul' => $row['judul'],
        'slug' => $row['slug'],
        'kategori' => $row['nama_kategori'],
        'kategori_slug' => $row['kategori_slug'],
        'level' => $row['tingkat_kesulitan'],
        'estimasi_waktu' => $row['estimasi_waktu'],
        'jumlah_modul' => (int)($row['jumlah_modul'] ?? 0),
        'ringkasan' => $row['ringkasan'],
        'deskripsi' => $row['deskripsi'],
        'tujuan_belajar' => $tujuan,
        'populer' => (bool)$row['populer'],
    ];
}

/**
 * Format baris sertifikat dari DB agar kompatibel dengan frontend.
 */
function formatSertifikat(array $row): array {
    return [
        'nomor_sertifikat' => $row['nomor_sertifikat'],
        'nama_peserta' => $row['nama_peserta'],
        'email' => $row['email'],
        'nama_kursus' => $row['nama_kursus'],
        'kursus_slug' => $row['kursus_slug'],
        'tanggal_terbit' => $row['tanggal_terbit'],
        'nilai_kuis' => isset($row['nilai_kuis']) ? (float)$row['nilai_kuis'] : 100,
        'penyelenggara_nama' => $row['penandatangan_nama'] ?? 'Dr. Ir. Hendra Gunawan, M.T.',
        'penyelenggara_jabatan' => $row['penandatangan_jabatan'] ?? 'Direktur Pembina Skill4Life',
        'kode_verifikasi' => $row['kode_verifikasi'],
        'status' => 'Terdaftar sah',
    ];
}

/**
 * Cari ID kategori berdasarkan nama atau slug.
 */
function cariKategoriId(PDO $pdo, string $kategoriInput): int {
    $stmt = $pdo->prepare("SELECT id FROM kategori WHERE nama_kategori = ? OR slug = ? LIMIT 1");
    $stmt->execute([$kategoriInput, $kategoriInput]);
    $id = $stmt->fetchColumn();
    if ($id) {
        return (int)$id;
    }
    $fallback = $pdo->query("SELECT id FROM kategori ORDER BY id ASC LIMIT 1")->fetchColumn();
    return $fallback ? (int)$fallback : 1;
}

try {
    switch ($aksi) {
        case 'cek_status':
            echo json_encode([
                'ok' => true,
                'mode' => 'mysql',
                'database' => DB_NAME,
            ]);
            break;

        /* ========================================================
           1. AUTENTIKASI & PROFIL (PHP SESSION + MYSQL)
           ======================================================== */
        case 'login':
            $in = bacaInputJSON();
            $email = strtolower(trim($in['email'] ?? ''));
            $sandi = (string)($in['kata_sandi'] ?? '');
            $peranDiharapkan = $in['peran'] ?? 'peserta';

            if (!$email || strlen($sandi) < 8) {
                echo json_encode(['ok' => false, 'pesan' => 'Alamat email dan kata sandi (minimal 8 karakter) wajib diisi.']);
                break;
            }

            $stmt = $pdo->prepare("SELECT * FROM pengguna WHERE LOWER(email) = ? LIMIT 1");
            $stmt->execute([$email]);
            $userRow = $stmt->fetch();

            if (!$userRow) {
                $pesan = $peranDiharapkan === 'admin'
                    ? 'Email atau kata sandi pengelola tidak cocok.'
                    : 'Email belum terdaftar. Silakan buat akun gratis terlebih dahulu.';
                echo json_encode(['ok' => false, 'pesan' => $pesan]);
                break;
            }

            if ($peranDiharapkan === 'admin' && $userRow['peran'] !== 'admin') {
                echo json_encode(['ok' => false, 'pesan' => 'Email atau kata sandi pengelola tidak cocok.']);
                break;
            }

            if (!password_verify($sandi, $userRow['kata_sandi'])) {
                echo json_encode(['ok' => false, 'pesan' => 'Kata sandi yang Anda masukkan salah.']);
                break;
            }

            $sesi = [
                'id' => (int)$userRow['id'],
                'nama_lengkap' => $userRow['nama_lengkap'],
                'email' => $userRow['email'],
                'nomor_telepon' => $userRow['nomor_telepon'] ?? '-',
                'pekerjaan' => $userRow['pekerjaan'] ?? 'Pencari kerja',
                'kota' => $userRow['kota'] ?? 'Indonesia',
                'peran' => $userRow['peran'],
            ];
            $_SESSION['user'] = $sesi;
            echo json_encode(['ok' => true, 'user' => $sesi]);
            break;

        case 'daftar':
            $in = bacaInputJSON();
            $nama = trim($in['nama_lengkap'] ?? '');
            $email = strtolower(trim($in['email'] ?? ''));
            $sandi = (string)($in['kata_sandi'] ?? '');
            $pekerjaan = trim($in['pekerjaan'] ?? '') ?: 'Pencari kerja';
            $kota = trim($in['kota'] ?? '') ?: 'Indonesia';

            if (!$nama || !$email || strlen($sandi) < 8) {
                echo json_encode(['ok' => false, 'pesan' => 'Lengkapi seluruh data formulir. Kata sandi minimal 8 karakter.']);
                break;
            }

            $cek = $pdo->prepare("SELECT id FROM pengguna WHERE LOWER(email) = ? LIMIT 1");
            $cek->execute([$email]);
            if ($cek->fetchColumn()) {
                echo json_encode(['ok' => false, 'pesan' => 'Alamat email ini sudah terdaftar. Silakan masuk menggunakan email tersebut.']);
                break;
            }

            $hash = password_hash($sandi, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("
                INSERT INTO pengguna (nama_lengkap, email, kata_sandi, peran, nomor_telepon, pekerjaan, kota)
                VALUES (?, ?, ?, 'peserta', '-', ?, ?)
            ");
            $stmt->execute([$nama, $email, $hash, $pekerjaan, $kota]);
            $idBaru = (int)$pdo->lastInsertId();

            $sesi = [
                'id' => $idBaru,
                'nama_lengkap' => $nama,
                'email' => $email,
                'nomor_telepon' => '-',
                'pekerjaan' => $pekerjaan,
                'kota' => $kota,
                'peran' => 'peserta',
            ];
            $_SESSION['user'] = $sesi;
            echo json_encode(['ok' => true, 'user' => $sesi]);
            break;

        case 'logout':
            unset($_SESSION['user']);
            echo json_encode(['ok' => true]);
            break;

        case 'perbarui_profil':
            $sesi = $_SESSION['user'] ?? null;
            if (!$sesi) {
                echo json_encode(['ok' => false, 'pesan' => 'Sesi tidak ditemukan. Silakan masuk kembali.']);
                break;
            }
            $in = bacaInputJSON();
            $namaBaru = trim($in['nama_lengkap'] ?? '') ?: $sesi['nama_lengkap'];
            $teleponBaru = trim($in['nomor_telepon'] ?? '');
            $pekerjaanBaru = trim($in['pekerjaan'] ?? '');
            $kotaBaru = trim($in['kota'] ?? '') ?: ($sesi['kota'] ?? 'Indonesia');

            $stmt = $pdo->prepare("
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
            $_SESSION['user'] = $sesiBaru;
            echo json_encode(['ok' => true, 'user' => $sesiBaru]);
            break;

        /* ========================================================
           2. DATA PUBLIK: STATISTIK, KATEGORI, KURSUS, MODUL
           ======================================================== */
        case 'statistik':
            $kursus = (int)$pdo->query("SELECT COUNT(*) FROM kursus WHERE diterbitkan = 1")->fetchColumn();
            $modul = (int)$pdo->query("SELECT COUNT(*) FROM modul")->fetchColumn();
            $sertifikat = (int)$pdo->query("SELECT COUNT(*) FROM sertifikat")->fetchColumn();
            echo json_encode([
                'ok' => true,
                'data' => [
                    'total_kursus' => $kursus,
                    'total_modul' => $modul,
                    'total_sertifikat' => 839 + $sertifikat,
                    'mitra_komunitas' => 32,
                ],
            ]);
            break;

        case 'kategori':
            $rows = $pdo->query("
                SELECT kat.id, kat.nama_kategori, kat.slug, kat.ikon, kat.deskripsi,
                       (SELECT COUNT(*) FROM kursus k WHERE k.kategori_id = kat.id AND k.diterbitkan = 1) AS jumlah_kursus
                FROM kategori kat
                ORDER BY kat.id ASC
            ")->fetchAll();
            $data = array_map(fn($r) => [
                'id_kategori' => (int)$r['id'],
                'nama' => $r['nama_kategori'],
                'slug' => $r['slug'],
                'deskripsi' => $r['deskripsi'],
                'jumlah_kursus' => (int)$r['jumlah_kursus'],
                'warna' => '#1F6F4A',
                'ikon_lucide' => $r['ikon'] ?: 'folder',
            ], $rows);
            echo json_encode(['ok' => true, 'data' => $data]);
            break;

        case 'kursus':
            $rows = $pdo->query("
                SELECT k.*, kat.nama_kategori, kat.slug AS kategori_slug,
                       (SELECT COUNT(*) FROM modul m WHERE m.kursus_id = k.id) AS jumlah_modul
                FROM kursus k
                JOIN kategori kat ON k.kategori_id = kat.id
                WHERE k.diterbitkan = 1
                ORDER BY k.id ASC
            ")->fetchAll();
            echo json_encode(['ok' => true, 'data' => array_map('formatKursus', $rows)]);
            break;

        case 'detail_kursus':
            $slug = $_GET['slug'] ?? '';
            $stmt = $pdo->prepare("
                SELECT k.*, kat.nama_kategori, kat.slug AS kategori_slug,
                       (SELECT COUNT(*) FROM modul m WHERE m.kursus_id = k.id) AS jumlah_modul
                FROM kursus k
                JOIN kategori kat ON k.kategori_id = kat.id
                WHERE (k.slug = ? OR CAST(k.id AS CHAR) = ?) AND k.diterbitkan = 1
                LIMIT 1
            ");
            $stmt->execute([$slug, $slug]);
            $row = $stmt->fetch();
            echo json_encode(['ok' => true, 'data' => $row ? formatKursus($row) : null]);
            break;

        case 'modul':
            $slug = $_GET['slug'] ?? '';
            $stmt = $pdo->prepare("
                SELECT m.*, k.slug AS kursus_slug
                FROM modul m
                JOIN kursus k ON m.kursus_id = k.id
                WHERE k.slug = ?
                ORDER BY m.urutan ASC, m.id ASC
            ");
            $stmt->execute([$slug]);
            $rows = $stmt->fetchAll();
            $data = array_map(fn($r) => [
                'id' => (int)$r['id'],
                'kursus_id' => (int)$r['kursus_id'],
                'kursus_slug' => $r['kursus_slug'],
                'judul_modul' => $r['judul_modul'],
                'urutan' => (int)$r['urutan'],
                'estimasi_menit' => (int)$r['estimasi_menit'],
                'video_url' => $r['video_url'] ?? '',
                'konten' => $r['konten'],
            ], $rows);
            echo json_encode(['ok' => true, 'data' => $data]);
            break;

        /* ========================================================
           3. PROGRES BELAJAR & RINGKASAN DASHBOARD
           ======================================================== */
        case 'progres_kursus':
            $sesi = $_SESSION['user'] ?? null;
            $slug = $_GET['slug'] ?? '';
            if (!$sesi || !$slug) {
                echo json_encode(['ok' => true, 'data' => []]);
                break;
            }
            $stmt = $pdo->prepare("
                SELECT pm.modul_id
                FROM progres_modul pm
                JOIN kursus k ON pm.kursus_id = k.id
                WHERE pm.pengguna_id = ? AND k.slug = ?
            ");
            $stmt->execute([$sesi['id'], $slug]);
            $ids = array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
            echo json_encode(['ok' => true, 'data' => $ids]);
            break;

        case 'simpan_progres':
            $sesi = $_SESSION['user'] ?? null;
            $in = bacaInputJSON();
            $slug = $in['slug'] ?? '';
            $idModul = (int)($in['id_modul'] ?? 0);
            if (!$sesi || !$slug || !$idModul) {
                echo json_encode(['sukses' => false, 'modul_selesai' => []]);
                break;
            }
            $stmtK = $pdo->prepare("SELECT id FROM kursus WHERE slug = ? LIMIT 1");
            $stmtK->execute([$slug]);
            $kursusId = (int)$stmtK->fetchColumn();
            if ($kursusId) {
                $stmtIns = $pdo->prepare("
                    INSERT IGNORE INTO progres_modul (pengguna_id, modul_id, kursus_id)
                    VALUES (?, ?, ?)
                ");
                $stmtIns->execute([$sesi['id'], $idModul, $kursusId]);
            }
            $stmtP = $pdo->prepare("SELECT modul_id FROM progres_modul WHERE pengguna_id = ? AND kursus_id = ?");
            $stmtP->execute([$sesi['id'], $kursusId]);
            echo json_encode([
                'sukses' => true,
                'modul_selesai' => array_map('intval', $stmtP->fetchAll(PDO::FETCH_COLUMN)),
            ]);
            break;

        case 'hapus_progres':
            $sesi = $_SESSION['user'] ?? null;
            $in = bacaInputJSON();
            $slug = $in['slug'] ?? '';
            $idModul = (int)($in['id_modul'] ?? 0);
            if (!$sesi || !$slug || !$idModul) {
                echo json_encode(['sukses' => false, 'modul_selesai' => []]);
                break;
            }
            $stmtK = $pdo->prepare("SELECT id FROM kursus WHERE slug = ? LIMIT 1");
            $stmtK->execute([$slug]);
            $kursusId = (int)$stmtK->fetchColumn();
            if ($kursusId) {
                $stmtDel = $pdo->prepare("DELETE FROM progres_modul WHERE pengguna_id = ? AND modul_id = ?");
                $stmtDel->execute([$sesi['id'], $idModul]);
            }
            $stmtP = $pdo->prepare("SELECT modul_id FROM progres_modul WHERE pengguna_id = ? AND kursus_id = ?");
            $stmtP->execute([$sesi['id'], $kursusId]);
            echo json_encode([
                'sukses' => true,
                'modul_selesai' => array_map('intval', $stmtP->fetchAll(PDO::FETCH_COLUMN)),
            ]);
            break;

        case 'ringkasan_peserta':
            $sesi = $_SESSION['user'] ?? null;
            if (!$sesi) {
                echo json_encode(['ok' => true, 'data' => []]);
                break;
            }
            $stmt = $pdo->prepare("
                SELECT k.id AS id_kursus, k.judul, k.slug, kat.nama_kategori AS kategori, k.tingkat_kesulitan AS level,
                       (SELECT COUNT(*) FROM modul m WHERE m.kursus_id = k.id) AS total_modul,
                       (SELECT COUNT(*) FROM progres_modul pm WHERE pm.kursus_id = k.id AND pm.pengguna_id = ?) AS modul_selesai,
                       s.nomor_sertifikat, s.nilai_kuis
                FROM kursus k
                JOIN kategori kat ON k.kategori_id = kat.id
                LEFT JOIN sertifikat s ON s.kursus_id = k.id AND s.pengguna_id = ?
                WHERE k.diterbitkan = 1
                  AND (
                    EXISTS (SELECT 1 FROM progres_modul pm2 WHERE pm2.kursus_id = k.id AND pm2.pengguna_id = ?)
                    OR s.id IS NOT NULL
                  )
                ORDER BY k.id ASC
            ");
            $uid = $sesi['id'];
            $stmt->execute([$uid, $uid, $uid]);
            $rows = $stmt->fetchAll();

            $hasil = array_map(function ($r) {
                $total = (int)$r['total_modul'] ?: 4;
                $selesai = min((int)$r['modul_selesai'], $total);
                $lulus = !empty($r['nomor_sertifikat']);
                $persen = $lulus ? 100 : ($total > 0 ? (int)round(($selesai / $total) * 100) : 0);
                return [
                    'id_kursus' => (int)$r['id_kursus'],
                    'judul' => $r['judul'],
                    'slug' => $r['slug'],
                    'kategori' => $r['kategori'],
                    'level' => $r['level'],
                    'modul_selesai' => $selesai,
                    'total_modul' => $total,
                    'progress_persen' => $persen,
                    'lulus_kuis' => $lulus,
                    'nilai_kuis' => $r['nilai_kuis'] !== null ? (float)$r['nilai_kuis'] : null,
                    'nomor_sertifikat' => $r['nomor_sertifikat'] ?: null,
                ];
            }, $rows);
            echo json_encode(['ok' => true, 'data' => $hasil]);
            break;

        /* ========================================================
           4. KUIS EVALUASI & SERTIFIKAT
           ======================================================== */
        case 'soal_kuis':
            $slug = $_GET['slug'] ?? '';
            $stmt = $pdo->prepare("
                SELECT q.*, k.slug AS kursus_slug
                FROM soal_kuis q
                JOIN kursus k ON q.kursus_id = k.id
                WHERE k.slug = ?
                ORDER BY q.urutan ASC, q.id ASC
            ");
            $stmt->execute([$slug]);
            $rows = $stmt->fetchAll();
            $data = array_map(fn($r) => [
                'id' => (int)$r['id'],
                'kursus_id' => (int)$r['kursus_id'],
                'kursus_slug' => $r['kursus_slug'],
                'urutan' => (int)$r['urutan'],
                'pertanyaan' => $r['pertanyaan'],
                'pilihan' => [
                    'A' => $r['pilihan_a'],
                    'B' => $r['pilihan_b'],
                    'C' => $r['pilihan_c'],
                    'D' => $r['pilihan_d'],
                ],
                'jawaban_benar' => $r['jawaban_benar'],
                'pembahasan' => $r['pembahasan'] ?? '',
            ], $rows);
            echo json_encode(['ok' => true, 'data' => $data]);
            break;

        case 'kirim_kuis':
            $in = bacaInputJSON();
            $slug = $in['slug'] ?? '';
            $lembarJawaban = $in['jawaban'] ?? [];

            $stmtK = $pdo->prepare("SELECT id, judul FROM kursus WHERE slug = ? LIMIT 1");
            $stmtK->execute([$slug]);
            $kursusRow = $stmtK->fetch();
            if (!$kursusRow) {
                echo json_encode(['ok' => false, 'pesan' => 'Kursus tidak ditemukan.']);
                break;
            }

            $stmtQ = $pdo->prepare("SELECT * FROM soal_kuis WHERE kursus_id = ? ORDER BY urutan ASC, id ASC");
            $stmtQ->execute([$kursusRow['id']]);
            $soalRows = $stmtQ->fetchAll();

            $benar = 0;
            $evaluasi = [];
            foreach ($soalRows as $idx => $s) {
                $pilihan = [
                    'A' => $s['pilihan_a'],
                    'B' => $s['pilihan_b'],
                    'C' => $s['pilihan_c'],
                    'D' => $s['pilihan_d'],
                ];
                $sid = (string)$s['id'];
                $jawabanPeserta = $lembarJawaban[$sid] ?? ($lembarJawaban[(int)$sid] ?? null);
                $isBenar = $jawabanPeserta === $s['jawaban_benar'];
                if ($isBenar) {
                    $benar++;
                }
                $evaluasi[] = [
                    'nomor' => $idx + 1,
                    'id_soal' => (int)$s['id'],
                    'pertanyaan' => $s['pertanyaan'],
                    'pilihan' => $pilihan,
                    'jawaban_peserta' => $jawabanPeserta,
                    'teks_jawaban_peserta' => ($jawabanPeserta && isset($pilihan[$jawabanPeserta])) ? $pilihan[$jawabanPeserta] : 'Tidak dijawab',
                    'kunci_benar' => $s['jawaban_benar'],
                    'teks_kunci_benar' => $pilihan[$s['jawaban_benar']] ?? '',
                    'is_benar' => $isBenar,
                    'pembahasan' => $s['pembahasan'] ?? '',
                ];
            }

            $totalSoal = count($soalRows);
            $nilai = $totalSoal > 0 ? (int)round(($benar / $totalSoal) * 100) : 0;
            $isLulus = $nilai >= 70;
            $nomorSertifikat = null;

            $sesi = $_SESSION['user'] ?? null;
            if ($sesi) {
                $stmtHasil = $pdo->prepare("
                    INSERT INTO hasil_kuis (pengguna_id, kursus_id, total_soal, jawaban_benar, nilai, status_lulus)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                $stmtHasil->execute([
                    $sesi['id'],
                    $kursusRow['id'],
                    $totalSoal,
                    $benar,
                    $nilai,
                    $isLulus ? 'Lulus' : 'Tidak Lulus',
                ]);

                if ($isLulus) {
                    $stmtCek = $pdo->prepare("SELECT * FROM sertifikat WHERE pengguna_id = ? AND kursus_id = ? LIMIT 1");
                    $stmtCek->execute([$sesi['id'], $kursusRow['id']]);
                    $sudah = $stmtCek->fetch();

                    if ($sudah) {
                        $nomorSertifikat = $sudah['nomor_sertifikat'];
                        if ($nilai > (float)$sudah['nilai_kuis']) {
                            $pdo->prepare("UPDATE sertifikat SET nilai_kuis = ? WHERE id = ?")
                                ->execute([$nilai, $sudah['id']]);
                        }
                    } else {
                        $tahun = date('Y');
                        $last = $pdo->prepare("SELECT nomor_sertifikat FROM sertifikat WHERE nomor_sertifikat LIKE ? ORDER BY nomor_sertifikat DESC LIMIT 1");
                        $last->execute(["S4L-{$tahun}-%"]);
                        $lastNomor = $last->fetchColumn();
                        if ($lastNomor) {
                            $parts = explode('-', $lastNomor);
                            $urut = (int)end($parts) + 1;
                        } else {
                            $urut = 123;
                        }
                        $nomorSertifikat = sprintf('S4L-%s-%06d', $tahun, $urut);
                        $kodeVerifikasi = bin2hex(random_bytes(32));

                        $stmtSert = $pdo->prepare("
                            INSERT INTO sertifikat (nomor_sertifikat, pengguna_id, kursus_id, tanggal_terbit, nilai_kuis, kode_verifikasi)
                            VALUES (?, ?, ?, ?, ?, ?)
                        ");
                        $stmtSert->execute([
                            $nomorSertifikat,
                            $sesi['id'],
                            $kursusRow['id'],
                            date('Y-m-d'),
                            $nilai,
                            $kodeVerifikasi,
                        ]);
                    }
                }
            }

            echo json_encode([
                'ok' => true,
                'nilai' => $nilai,
                'jawaban_benar' => $benar,
                'total_soal' => $totalSoal,
                'lulus' => $isLulus,
                'nomor_sertifikat' => $nomorSertifikat,
                'evaluasi' => $evaluasi,
            ]);
            break;

        case 'semua_sertifikat':
            $rows = $pdo->query("
                SELECT s.*, p.nama_lengkap AS nama_peserta, p.email, k.judul AS nama_kursus, k.slug AS kursus_slug
                FROM sertifikat s
                JOIN pengguna p ON s.pengguna_id = p.id
                JOIN kursus k ON s.kursus_id = k.id
                ORDER BY s.id DESC
            ")->fetchAll();
            echo json_encode(['ok' => true, 'data' => array_map('formatSertifikat', $rows)]);
            break;

        case 'sertifikat':
            $nomor = trim($_GET['nomor'] ?? '');
            $stmt = $pdo->prepare("
                SELECT s.*, p.nama_lengkap AS nama_peserta, p.email, k.judul AS nama_kursus, k.slug AS kursus_slug
                FROM sertifikat s
                JOIN pengguna p ON s.pengguna_id = p.id
                JOIN kursus k ON s.kursus_id = k.id
                WHERE LOWER(s.nomor_sertifikat) = LOWER(?)
                LIMIT 1
            ");
            $stmt->execute([$nomor]);
            $row = $stmt->fetch();
            echo json_encode(['ok' => true, 'data' => $row ? formatSertifikat($row) : null]);
            break;

        case 'sertifikat_pengguna':
            $sesi = $_SESSION['user'] ?? null;
            if (!$sesi) {
                echo json_encode(['ok' => true, 'data' => []]);
                break;
            }
            $stmt = $pdo->prepare("
                SELECT s.*, p.nama_lengkap AS nama_peserta, p.email, k.judul AS nama_kursus, k.slug AS kursus_slug
                FROM sertifikat s
                JOIN pengguna p ON s.pengguna_id = p.id
                JOIN kursus k ON s.kursus_id = k.id
                WHERE s.pengguna_id = ?
                ORDER BY s.id DESC
            ");
            $stmt->execute([$sesi['id']]);
            $rows = $stmt->fetchAll();
            echo json_encode(['ok' => true, 'data' => array_map('formatSertifikat', $rows)]);
            break;

        case 'semua_peserta':
            $rows = $pdo->query("
                SELECT p.id, p.nama_lengkap, p.email, p.nomor_telepon, p.pekerjaan, p.kota, p.dibuat_pada,
                       (SELECT COUNT(*) FROM sertifikat s WHERE s.pengguna_id = p.id) AS jumlah_sertifikat,
                       (SELECT COUNT(DISTINCT hk.kursus_id) FROM hasil_kuis hk WHERE hk.pengguna_id = p.id AND hk.status_lulus = 'Lulus') AS kursus_selesai
                FROM pengguna p
                WHERE p.peran = 'peserta'
                ORDER BY p.id DESC
            ")->fetchAll();
            $data = array_map(fn($r) => [
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
            echo json_encode(['ok' => true, 'data' => $data]);
            break;

        /* ========================================================
           5. CRUD PANEL PENGELOLA (ADMIN)
           ======================================================== */
        case 'tambah_kursus':
            wajibAdmin();
            $in = bacaInputJSON();
            $judul = trim($in['judul'] ?? 'Kursus Baru');
            $slugDasar = trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($judul)), '-') ?: 'kursus-baru';
            $cekSlug = $pdo->prepare("SELECT COUNT(*) FROM kursus WHERE slug = ?");
            $cekSlug->execute([$slugDasar]);
            $slug = ((int)$cekSlug->fetchColumn() > 0) ? ($slugDasar . '-' . time()) : $slugDasar;

            $katId = cariKategoriId($pdo, $in['kategori'] ?? '');
            $tujuan = $in['tujuan_belajar'] ?? [
                'Memahami konsep dasar materi secara terstruktur',
                'Menerapkan keterampilan kerja secara mandiri',
            ];
            $tujuanText = is_array($tujuan) ? implode("\n", $tujuan) : (string)$tujuan;

            $stmt = $pdo->prepare("
                INSERT INTO kursus (kategori_id, judul, slug, ringkasan, deskripsi, tujuan_belajar, tingkat_kesulitan, estimasi_waktu, populer, diterbitkan)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, 1)
            ");
            $stmt->execute([
                $katId,
                $judul,
                $slug,
                $in['ringkasan'] ?? '',
                ($in['deskripsi'] ?? '') ?: ($in['ringkasan'] ?? ''),
                $tujuanText,
                $in['level'] ?? 'Pemula',
                $in['estimasi_waktu'] ?? '2 Jam',
            ]);
            $idBaru = (int)$pdo->lastInsertId();
            $row = $pdo->query("
                SELECT k.*, kat.nama_kategori, kat.slug AS kategori_slug, 0 AS jumlah_modul
                FROM kursus k JOIN kategori kat ON k.kategori_id = kat.id WHERE k.id = {$idBaru}
            ")->fetch();
            echo json_encode(['ok' => true, 'data' => formatKursus($row)]);
            break;

        case 'ubah_kursus':
            wajibAdmin();
            $in = bacaInputJSON();
            $idKursus = (int)($in['id_kursus'] ?? 0);
            $katId = cariKategoriId($pdo, $in['kategori'] ?? '');
            $stmt = $pdo->prepare("
                UPDATE kursus
                SET kategori_id = ?, judul = ?, ringkasan = ?, deskripsi = ?, tingkat_kesulitan = ?, estimasi_waktu = ?
                WHERE id = ?
            ");
            $stmt->execute([
                $katId,
                $in['judul'] ?? '',
                $in['ringkasan'] ?? '',
                ($in['deskripsi'] ?? '') ?: ($in['ringkasan'] ?? ''),
                $in['level'] ?? 'Pemula',
                $in['estimasi_waktu'] ?? '2 Jam',
                $idKursus,
            ]);
            $row = $pdo->query("
                SELECT k.*, kat.nama_kategori, kat.slug AS kategori_slug,
                       (SELECT COUNT(*) FROM modul m WHERE m.kursus_id = k.id) AS jumlah_modul
                FROM kursus k JOIN kategori kat ON k.kategori_id = kat.id WHERE k.id = {$idKursus}
            ")->fetch();
            echo json_encode(['ok' => true, 'data' => $row ? formatKursus($row) : null]);
            break;

        case 'hapus_kursus':
            wajibAdmin();
            $in = bacaInputJSON();
            $idKursus = (int)($in['id_kursus'] ?? 0);
            $pdo->prepare("DELETE FROM kursus WHERE id = ?")->execute([$idKursus]);
            echo json_encode(['ok' => true]);
            break;

        case 'tambah_modul':
            wajibAdmin();
            $in = bacaInputJSON();
            $stmtK = $pdo->prepare("SELECT id FROM kursus WHERE slug = ? LIMIT 1");
            $stmtK->execute([$in['kursus_slug'] ?? '']);
            $kursusId = (int)$stmtK->fetchColumn() ?: 1;

            $stmt = $pdo->prepare("
                INSERT INTO modul (kursus_id, judul_modul, urutan, estimasi_menit, konten, video_url)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $kursusId,
                $in['judul_modul'] ?? 'Modul Baru',
                (int)($in['urutan'] ?? 1),
                (int)($in['estimasi_menit'] ?? 20),
                $in['konten'] ?? '<p>Materi pembelajaran.</p>',
                $in['video_url'] ?? '',
            ]);
            echo json_encode([
                'ok' => true,
                'data' => [
                    'id' => (int)$pdo->lastInsertId(),
                    'kursus_id' => $kursusId,
                    'kursus_slug' => $in['kursus_slug'] ?? '',
                    'judul_modul' => $in['judul_modul'] ?? 'Modul Baru',
                    'urutan' => (int)($in['urutan'] ?? 1),
                    'estimasi_menit' => (int)($in['estimasi_menit'] ?? 20),
                    'video_url' => $in['video_url'] ?? '',
                    'konten' => $in['konten'] ?? '<p>Materi pembelajaran.</p>',
                ],
            ]);
            break;

        case 'ubah_modul':
            wajibAdmin();
            $in = bacaInputJSON();
            $idModul = (int)($in['id_modul'] ?? 0);
            $stmt = $pdo->prepare("
                UPDATE modul
                SET urutan = ?, judul_modul = ?, estimasi_menit = ?, video_url = ?, konten = ?
                WHERE id = ?
            ");
            $stmt->execute([
                (int)($in['urutan'] ?? 1),
                $in['judul_modul'] ?? '',
                (int)($in['estimasi_menit'] ?? 20),
                $in['video_url'] ?? '',
                $in['konten'] ?? '',
                $idModul,
            ]);
            echo json_encode(['ok' => true]);
            break;

        case 'hapus_modul':
            wajibAdmin();
            $in = bacaInputJSON();
            $idModul = (int)($in['id_modul'] ?? 0);
            $pdo->prepare("DELETE FROM modul WHERE id = ?")->execute([$idModul]);
            echo json_encode(['ok' => true]);
            break;

        case 'tambah_soal':
            wajibAdmin();
            $in = bacaInputJSON();
            $stmtK = $pdo->prepare("SELECT id FROM kursus WHERE slug = ? LIMIT 1");
            $stmtK->execute([$in['kursus_slug'] ?? '']);
            $kursusId = (int)$stmtK->fetchColumn() ?: 1;

            $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM soal_kuis WHERE kursus_id = ?");
            $stmtCount->execute([$kursusId]);
            $urutan = (int)$stmtCount->fetchColumn() + 1;

            $stmt = $pdo->prepare("
                INSERT INTO soal_kuis (kursus_id, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, pembahasan, urutan)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $kursusId,
                $in['pertanyaan'] ?? '',
                $in['opsi_a'] ?? '',
                $in['opsi_b'] ?? '',
                $in['opsi_c'] ?? '',
                $in['opsi_d'] ?? '',
                $in['jawaban_benar'] ?? 'A',
                $in['pembahasan'] ?? '',
                $urutan,
            ]);
            echo json_encode(['ok' => true, 'id' => (int)$pdo->lastInsertId()]);
            break;

        case 'ubah_soal':
            wajibAdmin();
            $in = bacaInputJSON();
            $idSoal = (int)($in['id_soal'] ?? 0);
            $stmt = $pdo->prepare("
                UPDATE soal_kuis
                SET pertanyaan = ?, pilihan_a = ?, pilihan_b = ?, pilihan_c = ?, pilihan_d = ?, jawaban_benar = ?, pembahasan = ?
                WHERE id = ?
            ");
            $stmt->execute([
                $in['pertanyaan'] ?? '',
                $in['opsi_a'] ?? '',
                $in['opsi_b'] ?? '',
                $in['opsi_c'] ?? '',
                $in['opsi_d'] ?? '',
                $in['jawaban_benar'] ?? 'A',
                $in['pembahasan'] ?? '',
                $idSoal,
            ]);
            echo json_encode(['ok' => true]);
            break;

        case 'hapus_soal':
            wajibAdmin();
            $in = bacaInputJSON();
            $idSoal = (int)($in['id_soal'] ?? 0);
            $pdo->prepare("DELETE FROM soal_kuis WHERE id = ?")->execute([$idSoal]);
            echo json_encode(['ok' => true]);
            break;

        case 'reset_demo':
            wajibAdmin();
            $sqlFile = __DIR__ . '/../database.sql';
            if (!file_exists($sqlFile)) {
                echo json_encode(['ok' => false, 'pesan' => 'File database.sql tidak ditemukan.']);
                break;
            }
            $pdo->exec(file_get_contents($sqlFile));
            echo json_encode(['ok' => true]);
            break;

        default:
            echo json_encode(['ok' => true, 'pesan' => 'Endpoint API PHP Native Skill4Life aktif.']);
            break;
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'pesan' => $e->getMessage()]);
}
