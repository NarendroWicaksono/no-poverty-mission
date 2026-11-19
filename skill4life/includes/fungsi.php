<?php
/**
 * includes/fungsi.php
 * Helper functions untuk Skill4Life
 * Requires: config/koneksi.php (buatKoneksi, e, buatNomorSertifikat already in koneksi or here)
 */

require_once __DIR__ . '/../config/koneksi.php';

/**
 * Ambil semua kursus dengan opsional filter.
 *
 * @param array $filter Kunci opsional:
 *   - 'kategori_slug'      => string  Filter berdasarkan slug kategori
 *   - 'tingkat_kesulitan'  => string  'Pemula' | 'Menengah' | 'Lanjut'
 *   - 'cari'               => string  Pencarian judul kursus (LIKE %cari%)
 *   - 'populer'            => bool    Hanya kursus populer
 *   - 'diterbitkan'        => bool    Default true (hanya yang diterbitkan)
 */
function ambilSemuaKursus(array $filter = []): array {
    $pdo = buatKoneksi();

    $sql    = "SELECT k.*, kat.nama_kategori, kat.slug AS kategori_slug,
                      (SELECT COUNT(*) FROM modul m WHERE m.kursus_id = k.id) AS jumlah_modul
               FROM kursus k
               JOIN kategori kat ON k.kategori_id = kat.id
               WHERE 1=1";
    $params = [];

    // Hanya tampilkan kursus yang diterbitkan kecuali ada override
    $diterbitkan = $filter['diterbitkan'] ?? true;
    if ($diterbitkan !== false) {
        $sql .= " AND k.diterbitkan = 1";
    }

    if (!empty($filter['kategori_slug'])) {
        $sql     .= " AND kat.slug = ?";
        $params[] = $filter['kategori_slug'];
    }

    if (!empty($filter['tingkat_kesulitan'])) {
        $sql     .= " AND k.tingkat_kesulitan = ?";
        $params[] = $filter['tingkat_kesulitan'];
    }

    if (!empty($filter['cari'])) {
        $sql     .= " AND k.judul LIKE ?";
        $params[] = '%' . $filter['cari'] . '%';
    }

    if (!empty($filter['populer'])) {
        $sql .= " AND k.populer = 1";
    }

    $sql .= " ORDER BY k.populer DESC, k.dibuat_pada DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Ambil detail satu kursus berdasarkan slug.
 *
 * @param string $slug Slug kursus
 * @return array|null Data kursus atau null jika tidak ada
 */
function ambilDetailKursus(string $slug): ?array {
    $pdo  = buatKoneksi();
    $stmt = $pdo->prepare("
        SELECT k.*, kat.nama_kategori, kat.slug AS kategori_slug
        FROM kursus k
        JOIN kategori kat ON k.kategori_id = kat.id
        WHERE k.slug = ? AND k.diterbitkan = 1
        LIMIT 1
    ");
    $stmt->execute([$slug]);
    $data = $stmt->fetch();
    return $data ?: null;
}

/**
 * Ambil semua modul untuk sebuah kursus, diurutkan berdasarkan urutan.
 *
 * @param int $kursusId ID kursus
 * @return array Array modul
 */
function ambilModulKursus(int $kursusId): array {
    $pdo  = buatKoneksi();
    $stmt = $pdo->prepare("
        SELECT * FROM modul
        WHERE kursus_id = ?
        ORDER BY urutan ASC
    ");
    $stmt->execute([$kursusId]);
    return $stmt->fetchAll();
}

/**
 * Cek apakah pengguna sudah memiliki sertifikat untuk kursus tertentu.
 *
 * @param int $penggunaId ID pengguna
 * @param int $kursusId   ID kursus
 * @return array|null Data sertifikat atau null
 */
function cekSertifikat(int $penggunaId, int $kursusId): ?array {
    $pdo  = buatKoneksi();
    $stmt = $pdo->prepare("
        SELECT s.*, k.judul AS judul_kursus, p.nama_lengkap
        FROM sertifikat s
        JOIN kursus k ON s.kursus_id = k.id
        JOIN pengguna p ON s.pengguna_id = p.id
        WHERE s.pengguna_id = ? AND s.kursus_id = ?
        LIMIT 1
    ");
    $stmt->execute([$penggunaId, $kursusId]);
    $data = $stmt->fetch();
    return $data ?: null;
}

/**
 * Buat nomor sertifikat unik dalam format S4L-YYYY-NNNNNN.
 *
 * @return string Nomor sertifikat
 */
function buatNomorSertifikat(): string {
    $pdo  = buatKoneksi();
    $year = date('Y');

    // Ambil nomor urut tertinggi untuk tahun ini
    $stmt = $pdo->prepare("
        SELECT nomor_sertifikat FROM sertifikat
        WHERE nomor_sertifikat LIKE ?
        ORDER BY nomor_sertifikat DESC
        LIMIT 1
    ");
    $stmt->execute(["S4L-{$year}-%"]);
    $last = $stmt->fetchColumn();

    if ($last) {
        $parts = explode('-', $last);
        $urutan = (int)end($parts) + 1;
    } else {
        $urutan = 1;
    }

    return sprintf('S4L-%s-%06d', $year, $urutan);
}

/**
 * Terbitkan sertifikat untuk pengguna pada kursus tertentu.
 * Prasyarat: semua modul selesai DAN kuis lulus.
 *
 * @param int $penggunaId ID pengguna
 * @param int $kursusId   ID kursus
 * @return string Nomor sertifikat yang diterbitkan
 * @throws RuntimeException Jika syarat belum terpenuhi
 */
function terbitkanSertifikat(int $penggunaId, int $kursusId): string {
    $pdo = buatKoneksi();

    // 1. Periksa apakah sudah punya sertifikat
    $sudahAda = cekSertifikat($penggunaId, $kursusId);
    if ($sudahAda) {
        return $sudahAda['nomor_sertifikat'];
    }

    // 2. Periksa semua modul sudah selesai
    $totalModulStmt = $pdo->prepare("SELECT COUNT(*) FROM modul WHERE kursus_id = ?");
    $totalModulStmt->execute([$kursusId]);
    $totalModul = (int)$totalModulStmt->fetchColumn();

    $selesaiModulStmt = $pdo->prepare("
        SELECT COUNT(*) FROM progres_modul
        WHERE pengguna_id = ? AND kursus_id = ?
    ");
    $selesaiModulStmt->execute([$penggunaId, $kursusId]);
    $selesaiModul = (int)$selesaiModulStmt->fetchColumn();

    if ($totalModul === 0 || $selesaiModul < $totalModul) {
        throw new RuntimeException('Belum semua modul diselesaikan.');
    }

    // 3. Periksa kuis sudah lulus
    $kuisStmt = $pdo->prepare("
        SELECT status_lulus FROM hasil_kuis
        WHERE pengguna_id = ? AND kursus_id = ?
        ORDER BY dikerjakan_pada DESC
        LIMIT 1
    ");
    $kuisStmt->execute([$penggunaId, $kursusId]);
    $hasilKuis = $kuisStmt->fetchColumn();

    if ($hasilKuis !== 'Lulus') {
        throw new RuntimeException('Kuis belum lulus. Silakan coba lagi.');
    }

    // 4. Ambil info penandatangan dari kursus (default)
    $penandatanganNama    = 'Dr. Rina Kartika, M.Pd.';
    $penandatanganJabatan = 'Direktur Skill4Life';

    // 5. Generate nomor dan kode verifikasi
    $nomorSertifikat = buatNomorSertifikat();
    $kodeVerifikasi  = bin2hex(random_bytes(32));

    // 6. Insert sertifikat
    $insertStmt = $pdo->prepare("
        INSERT INTO sertifikat
            (nomor_sertifikat, pengguna_id, kursus_id, tanggal_terbit,
             kode_verifikasi, penandatangan_nama, penandatangan_jabatan, dibuat_pada)
        VALUES (?, ?, ?, CURDATE(), ?, ?, ?, NOW())
    ");
    $insertStmt->execute([
        $nomorSertifikat,
        $penggunaId,
        $kursusId,
        $kodeVerifikasi,
        $penandatanganNama,
        $penandatanganJabatan,
    ]);

    return $nomorSertifikat;
}

/**
 * Ambil statistik ringkas situs untuk tampilan publik / admin.
 *
 * @return array ['total_pengguna', 'total_kursus', 'total_sertifikat']
 */
function ambilStatistikSitus(): array {
    $pdo = buatKoneksi();

    $totalPengguna = (int)$pdo->query(
        "SELECT COUNT(*) FROM pengguna WHERE peran = 'peserta'"
    )->fetchColumn();

    $totalKursus = (int)$pdo->query(
        "SELECT COUNT(*) FROM kursus WHERE diterbitkan = 1"
    )->fetchColumn();

    $totalSertifikat = (int)$pdo->query(
        "SELECT COUNT(*) FROM sertifikat"
    )->fetchColumn();

    return [
        'total_pengguna'   => $totalPengguna,
        'total_kursus'     => $totalKursus,
        'total_sertifikat' => $totalSertifikat,
    ];
}
