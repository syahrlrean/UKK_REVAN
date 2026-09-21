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
        ]);

        DB::beginTransaction();

        try {
            // Ambil harga dari database agar transaksi tidak bergantung pada input harga dari browser.
            $items = [];
            $totalPembayaran = 0;
            foreach ($request->items as $item) {
                $produk = Produk::lockForUpdate()->findOrFail($item['produk_id']);

                if ($produk->stok < $item['qty']) {
                    throw new \RuntimeException("Stok produk {$produk->nama} tidak mencukupi.");
                }

                $harga = (int) $produk->harga_jual;
                $subtotal = $harga * (int) $item['qty'];
                $totalPembayaran += $subtotal;
                $items[] = compact('produk', 'item', 'harga', 'subtotal');
            }

            $penjualan = Penjualan::create([
                'user_id'           => Auth::id() ?? 1,
                'total_pembayaran'  => $totalPembayaran,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status'            => 'COMPLETED',
            ]);

            foreach ($items as $data) {
                ItemPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id'    => $data['produk']->id,
                    'kuantitas'    => $data['item']['qty'],
                    'harga_satuan' => $data['harga'],
                    'subtotal'     => $data['subtotal'],
                ]);

                $data['produk']->decrement('stok', $data['item']['qty']);
            }

            DB::commit();

            return redirect()->route('penjualan.show', $penjualan->id)
                             ->with('success', 'Transaksi berhasil disimpan!')
                             ->with('auto_print', strtoupper($request->metode_pembayaran) === 'CASH');

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