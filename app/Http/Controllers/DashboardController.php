<?php

namespace App\Http\Controllers;

use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __construct(
        protected LaporanPenjualanService $laporanService,
        protected MonitoringStokService $stokService
    ) {
        $this->laporanService = $laporanService;
        $this->stokService = $stokService;
    }

    public function index()
    {
        $ringkasan = $this->laporanService->ringkasanHariIni();
        $keuangan = $this->laporanService->ringkasanKeuangan();

        return view('dashboard', [
            'tanggalHariIni' => Carbon::now(),
            'ringkasan' => $ringkasan,
            'keuangan' => $keuangan,
            'transaksiTerbaru' => $this->laporanService->transaksiTerbaru(),
            'produkTerlaris' => $this->laporanService->produkTerlarisHariIni(),
            'produkStokRendah' => $this->stokService->produkStokRendah(),
            'produkStokHabis' => $this->stokService->produkStokHabis(),
        ]);
    }
}