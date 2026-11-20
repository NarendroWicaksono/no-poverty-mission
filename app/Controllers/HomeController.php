<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    public function index(string $baseUrl = '.'): void {
        $this->view('home/index', [
            'baseUrl' => $baseUrl,
            'judulHalaman' => 'Skill4Life - Kursus Keterampilan Kerja Gratis dan Bersertifikat',
        ]);
    }
}
