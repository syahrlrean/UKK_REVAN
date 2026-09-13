@extends('layouts.app')

@section('title', 'Kasir Transaksi')

@section('content')

    @include('layouts.navbar')

    <style>
        :root {
            --bg-dark-yellow: #0c0a09;
            --card-bg-dark: #1c1917;
            --border-yellow-subtle: rgba(245, 158, 11, 0.15);
            --accent-yellow: #f59e0b;
            --accent-yellow-hover: #d97706;
            --text-white: #fafaf9;
            --text-subtle: #a8a29e;
        }

        body {
            background-color: var(--bg-dark-yellow) !important;
            color: var(--text-white) !important;
            font-family: 'Plus Jakarta Sans', 'Inter', system-ui, -apple-system, sans-serif;
        }

        .card-dark-yellow {
            background: var(--card-bg-dark) !important;
            border: 1px solid var(--border-yellow-subtle);
            border-radius: 1rem;
        }

        .form-control-dark {
            background-color: rgba(12, 10, 9, 0.7) !important;
            border: 1px solid var(--border-yellow-subtle) !important;
            color: #ffffff !important;
            padding: 0.65rem 1rem;
            border-radius: 0.625rem;
        }

        .form-control-dark:focus {
            border-color: var(--accent-yellow) !important;
            box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.2) !important;
        }

        /* Product Card Styling */
        .product-card {
            background: var(--card-bg-dark);
            border: 1px solid var(--border-yellow-subtle);
            border-radius: 0.875rem;
            padding: 1rem;
            transition: all 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-card:hover {
            border-color: var(--accent-yellow);
            transform: translateY(-2px);
        }

        .product-img-box {
            width: 100%;
            height: 110px;
            background: rgba(12, 10, 9, 0.6);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 0.75rem;
        }

        .product-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-add-cart {
            background: rgba(245, 158, 11, 0.15);
            color: var(--accent-yellow);
            border: 1px solid var(--border-yellow-subtle);
            border-radius: 0.5rem;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .btn-add-cart:hover {
            background: var(--accent-yellow);
            color: #000;
            border-color: var(--accent-yellow);
        }

        /* Cart Section Styling */
        .cart-box {
            background: var(--card-bg-dark);
            border: 1px solid var(--border-yellow-subtle);
            border-radius: 1rem;
            position: sticky;
            top: 1.5rem;
        }

        .cart-item-row {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 0.75rem 0;
        }

        .btn-qty {
            background: rgba(255, 255, 255, 0.08);
            color: var(--text-white);
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-qty:hover {
            background: var(--accent-yellow);
            color: #000;
        }

        .total-display-box {
            background: rgba(12, 10, 9, 0.6);
            border: 1px solid var(--border-yellow-subtle);
            border-radius: 0.75rem;
            padding: 1rem;
        }

        .btn-checkout {
            background: var(--accent-yellow) !important;
            color: #000000 !important;
            font-weight: 700;
            border: none !important;
            padding: 0.85rem;
            border-radius: 0.75rem;
            width: 100%;
            transition: all 0.2s ease;
        }

        .btn-checkout:hover {
            background: var(--accent-yellow-hover) !important;
            color: #000000 !important;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .btn-checkout:disabled {
            background: rgba(255, 255, 255, 0.1) !important;
            color: var(--text-subtle) !important;
            cursor: not-allowed;
        }

        .btn-back-custom {
            background: rgba(12, 10, 9, 0.6);
            border: 1px solid var(--border-yellow-subtle);
            color: var(--text-subtle);
            border-radius: 0.75rem;
            padding: 0.5rem 1rem;
        }
    </style>

    <div class="container-fluid px-4 py-4">

        {{-- HEADER HALAMAN --}}
        <div
            class="d-flex justify-content-between align-items-center mb-4 pb-4 border-bottom border-secondary border-opacity-25">
            <div>
                <h1 class="fw-bold text-white mb-1" style="font-size: 1.8rem;">
                    <i class="bi bi-calculator me-2" style="color: var(--accent-yellow);"></i>Kasir Transaksi
                </h1>
                <p class="text-muted small mb-0">Pilih produk untuk ditambahkan ke keranjang belanja.</p>
            </div>
            <a href="{{ route('penjualan.index') }}" class="btn btn-back-custom d-inline-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
            </a>
        </div>

        <form action="{{ route('penjualan.store') }}" method="POST" id="formTransaksi">
            @csrf
            <div class="row g-4">

                {{-- KOLOM KIRI: DAFTAR PRODUK --}}
                <div class="col-lg-8">

                    {{-- SEARCH BAR --}}
                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text form-control-dark border-end-0 text-muted">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" id="inputSearch"
                                class="form-control form-control-dark border-start-0 ps-0"
                                placeholder="Cari nama produk...">
                        </div>
                    </div>

                    {{-- GRID PRODUK --}}
                    <div class="row g-3" id="productGrid">
                        @forelse($produks ?? $produk ?? [] as $item)
                            <div class="col-12 col-sm-6 col-md-4 product-item"
                                data-nama="{{ strtolower($item->nama ?? $item->nama_produk) }}">
                                <div class="product-card">
                                    <div>
                                        <div class="product-img-box">
                                            @if (!empty($item->foto))
                                                <img src="{{ asset('storage/' . $item->foto) }}"
                                                    alt="{{ $item->nama ?? $item->nama_produk }}">
                                            @else
                                                <i class="bi bi-box-seam fs-2 text-muted opacity-50"></i>
                                            @endif
                                        </div>
                                        <h6 class="fw-bold text-white mb-1 text-truncate"
                                            title="{{ $item->nama ?? $item->nama_produk }}">
                                            {{ $item->nama ?? $item->nama_produk }}
                                        </h6>
                                        <p class="text-muted small mb-2">Stok: <strong
                                                class="text-white">{{ $item->stok }}</strong></p>
                                    </div>

                                    <div
                                        class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top border-secondary border-opacity-25">
                                        <span class="fw-bold font-monospace" style="color: var(--accent-yellow);">
                                            Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                                        </span>
                                        <button type="button" class="btn btn-add-cart"
                                            onclick="addToCart({{ $item->id }}, '{{ addslashes($item->nama ?? $item->nama_produk) }}', {{ $item->harga_jual }}, {{ $item->stok }})">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                                Tidak ada produk yang tersedia.
                            </div>
                        @endforelse
                    </div>

                </div>

                {{-- KOLOM KANAN: KERANJANG BELANJA --}}
                <div class="col-lg-4">
                    <div class="cart-box p-4">
                        <div
                            class="d-flex justify-content-between align-items-center pb-3 border-bottom border-secondary border-opacity-25 mb-3">
                            <h5 class="fw-bold text-white mb-0 d-flex align-items-center gap-2">
                                <i class="bi bi-cart3" style="color: var(--accent-yellow);"></i> Keranjang Belanja
                            </h5>
                            <button type="button" class="btn btn-link text-danger text-decoration-none p-0 small"
                                onclick="clearCart()">
                                <i class="bi bi-trash me-1"></i>Kosongkan
                            </button>
                        </div>

                        {{-- LIST ITEM KERANJANG --}}
                        <div id="cartList" class="mb-4" style="max-height: 280px; overflow-y: auto;">
                            <div class="text-center py-4 text-muted small" id="cartEmptyState">
                                Keranjang masih kosong.<br>Klik produk di sebelah kiri.
                            </div>
                        </div>

                        {{-- METODE PEMBAYARAN --}}
                        <div class="mb-4">
                            <label class="form-label-custom small text-muted mb-2 fw-semibold">Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-select form-control-dark">
                                <option value="CASH">CASH (Tunai)</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>

                        {{-- TOTAL HARGA --}}
                        <div class="total-display-box mb-4">
                            <span class="text-muted small d-block mb-1">Total Pembayaran</span>
                            <div class="fs-2 fw-bold font-monospace" style="color: var(--accent-yellow);" id="totalDisplay">
                                Rp 0
                            </div>
                        </div>

                        {{-- SUBMIT BUTTON --}}
                        <button type="submit"
                            class="btn btn-checkout d-flex align-items-center justify-content-center gap-2" id="btnSubmit"
                            disabled>
                            <i class="bi bi-check-circle-fill"></i> Selesaikan Transaksi
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>

    {{-- SCRIPT JAVASCRIPT UNTUK HITUNGAN POS & SERACH --}}
    <script>
        let cart = [];

        function addToCart(id, nama, harga, maxStok) {
            let item = cart.find(i => i.id === id);
            if (item) {
                if (item.qty < maxStok) {
                    item.qty++;
                } else {
                    alert('Stok produk telah mencapai batas maksimum!');
                }
            } else {
                cart.push({
                    id,
                    nama,
                    harga,
                    qty: 1,
                    maxStok
                });
            }
            renderCart();
        }

        function updateQty(id, change) {
            let item = cart.find(i => i.id === id);
            if (item) {
                item.qty += change;
                if (item.qty <= 0) {
                    cart = cart.filter(i => i.id !== id);
                } else if (item.qty > item.maxStok) {
                    item.qty = item.maxStok;
                    alert('Stok produk telah mencapai batas maksimum!');
                }
            }
            renderCart();
        }

        function clearCart() {
            cart = [];
            renderCart();
        }

        function renderCart() {
            const cartList = document.getElementById('cartList');
            const totalDisplay = document.getElementById('totalDisplay');
            const btnSubmit = document.getElementById('btnSubmit');

            if (cart.length === 0) {
                cartList.innerHTML = `
                <div class="text-center py-4 text-muted small" id="cartEmptyState">
                    Keranjang masih kosong.<br>Klik produk di sebelah kiri.
                </div>`;
                totalDisplay.innerText = 'Rp 0';
                btnSubmit.disabled = true;
                return;
            }

            let html = '';
            let total = 0;

            cart.forEach((item, index) => {
                let subtotal = item.harga * item.qty;
                total += subtotal;

                html += `
                <div class="cart-item-row">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <span class="fw-semibold text-white small">${item.nama}</span>
                        <span class="font-monospace small text-white">Rp ${subtotal.toLocaleString('id-ID')}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted x-small">Rp ${item.harga.toLocaleString('id-ID')} x ${item.qty}</span>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn-qty" onclick="updateQty(${item.id}, -1)">-</button>
                            <span class="small text-white fw-bold">${item.qty}</span>
                            <button type="button" class="btn-qty" onclick="updateQty(${item.id}, 1)">+</button>
                        </div>
                    </div>
                    <input type="hidden" name="items[${index}][produk_id]" value="${item.id}">
                    <input type="hidden" name="items[${index}][qty]" value="${item.qty}">
                    <input type="hidden" name="items[${index}][subtotal]" value="${subtotal}">
                </div>
            `;
            });

            cartList.innerHTML = html;
            totalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
            btnSubmit.disabled = false;
        }

        // Filter Pencarian Realtime
        document.getElementById('inputSearch').addEventListener('input', function(e) {
            const keyword = e.target.value.toLowerCase();
            const items = document.querySelectorAll('.product-item');

            items.forEach(item => {
                const nama = item.getAttribute('data-nama');
                if (nama.includes(keyword)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>

@endsection
