<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\ItemPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('user')->latest()->paginate(10);
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $produks = Produk::where('stok', '>', 0)->get();
        return view('penjualan.create', compact('produks'));
    }

    // --- METHOD UNTUK MENYIMPAN TRANSAKSI KASIR ---
    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string',
            'items'             => 'required|array|min:1',
            'items.*.produk_id' => 'required|exists:produk,id',
            'items.*.qty'       => 'required|integer|min:1',
            'items.*.harga'     => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            // 1. Hitung Total Pembayaran
            $totalPembayaran = 0;
            foreach ($request->items as $item) {
                $totalPembayaran += $item['harga'] * $item['qty'];
            }

            // 2. Simpan Data Penjualan Utama
            $penjualan = Penjualan::create([
                'user_id'           => Auth::id() ?? 1,
                'total_pembayaran'  => $totalPembayaran,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status'            => 'COMPLETED',
            ]);

            // 3. Simpan Detail Item & Potong Stok Produk
            foreach ($request->items as $item) {
                // Simpan ke ItemPenjualan (Sesuaikan nama kolom jika ada perbedaan)
                ItemPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id'    => $item['produk_id'],
                    'jumlah'       => $item['qty'],
                    'harga_satuan' => $item['harga'],
                    'subtotal'     => $item['harga'] * $item['qty'],
                ]);

                // Potong Stok Produk
                $produk = Produk::findOrFail($item['produk_id']);
                $produk->decrement('stok', $item['qty']);
            }

            DB::commit();

            return redirect()->route('penjualan.show', $penjualan->id)
                             ->with('success', 'Transaksi berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $penjualan = Penjualan::with(['user', 'itemPenjualan.produk'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }
}