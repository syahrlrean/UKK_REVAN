<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSSYHRUL - Perusahaan & Penjualan</title>
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen font-sans p-6 md:p-10">

    <main class="max-w-6xl mx-auto space-y-8">
        
        <!-- HEADER HALAMAN & PROFIL PERUSAHAAN -->
        <div class="bg-gray-900 rounded-2xl p-6 border border-gray-800 shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-white">Tabel Perusahaan POSSYAHRUL</h1>
                <p class="text-sm text-gray-400 mt-1">Sistem Manajemen Stok & Rekapitulasi Data Penjualan iPhone</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button onclick="bukaModalTambah()" class="bg-amber-500 hover:bg-amber-600 active:scale-95 text-black font-semibold text-xs px-4 py-2.5 rounded-xl shadow-lg shadow-amber-500/10 transition-all cursor-pointer">
                    + Tambah Data Penjualan
                </button>
                <button onclick="exportKeExcel()" class="bg-gray-800 hover:bg-gray-700 text-gray-300 border border-gray-700 font-medium text-xs px-4 py-2.5 rounded-xl transition-all cursor-pointer">
                    Export Excel
                </button>
            </div>
        </div>

        <!-- TABEL DATA PENJUALAN -->
        <div class="bg-gray-900 rounded-2xl p-6 border border-gray-800 shadow-xl space-y-4">
            <div>
                <h2 class="text-xl font-bold text-white">Laporan Penjualan iPhone</h2>
                <p class="text-xs text-gray-400">Periode Transaksi Bulan Ini</p>
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-800">
                <table class="w-full text-left text-sm border-collapse" id="tabelPenjualan">
                    <thead>
                        <tr class="bg-gray-800/80 text-gray-400 text-[11px] uppercase tracking-wider border-b border-gray-800">
                            <th class="p-4">Model iPhone</th>
                            <th class="p-4">Kapasitas</th>
                            <th class="p-4">Harga Satuan</th>
                            <th class="p-4">Terjual</th>
                            <th class="p-4">Total Pendapatan</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 text-gray-200 text-xs" id="bodyTabel">
                        <!-- Data akan di-render otomatis oleh JavaScript -->
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-800/50 font-bold text-white border-t border-gray-800">
                            <td colspan="4" class="p-4 text-right text-gray-400 text-xs">Total Pendapatan Keseluruhan:</td>
                            <td colspan="2" class="p-4 text-amber-400 text-base font-extrabold" id="grandTotalText">Rp 0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </main>

    <!-- MODAL POP-UP (INPUT / EDIT DATA) -->
    <div id="modalForm" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-gray-900 border border-gray-800 rounded-2xl w-full max-w-md p-6 space-y-4 shadow-2xl">
            <div class="flex justify-between items-center border-b border-gray-800 pb-3">
                <h3 id="modalTitle" class="text-lg font-bold text-white">Form Penjualan</h3>
                <button onclick="tutupModal()" class="text-gray-400 hover:text-white text-lg font-bold cursor-pointer">&times;</button>
            </div>
            
            <form id="formPenjualan" onsubmit="simpanData(event)" class="space-y-4">
                <input type="hidden" id="editIndex" value="-1">
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Model iPhone</label>
                    <input type="text" id="inputModel" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-amber-500" placeholder="iPhone 15 Pro">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Kapasitas</label>
                    <input type="text" id="inputKapasitas" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-amber-500" placeholder="128 GB">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Harga Satuan (Rp)</label>
                        <input type="number" id="inputHarga" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-amber-500">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Jumlah Terjual</label>
                        <input type="number" id="inputTerjual" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-amber-500">
                    </div>
                </div>
                
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="tutupModal()" class="px-4 py-2 rounded-xl text-xs bg-gray-800 hover:bg-gray-700 text-gray-300 cursor-pointer">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs bg-amber-500 hover:bg-amber-600 text-black font-semibold cursor-pointer">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIKA TAMBAH, EDIT, HAPUS & EXPORT -->
    <script>
        // Data Awal Penjualan
        let dataPenjualan = [
            { model: "iPhone 15 Pro Max", kapasitas: "256 GB", harga: 24999000, terjual: 12 },
            { model: "iPhone 15 Pro", kapasitas: "128 GB", harga: 20999000, terjual: 18 },
            { model: "iPhone 15", kapasitas: "128 GB", harga: 16499000, terjual: 25 },
            { model: "iPhone 14", kapasitas: "128 GB", harga: 13999000, terjual: 15 },
            { model: "iPhone 13", kapasitas: "128 GB", harga: 10999000, terjual: 30 }
        ];

        // Format angka ke Rupiah
        function formatRupiah(angka) {
            return 'Rp ' + Number(angka).toLocaleString('id-ID');
        }

        // Render tabel & hitung total
        function renderTabel() {
            const bodyTabel = document.getElementById('bodyTabel');
            bodyTabel.innerHTML = '';
            let grandTotal = 0;

            dataPenjualan.forEach((item, index) => {
                let total = item.harga * item.terjual;
                grandTotal += total;

                let row = `
                    <tr class="hover:bg-gray-800/40 transition-all">
                        <td class="p-4 font-semibold text-white">${item.model}</td>
                        <td class="p-4 text-gray-400">${item.kapasitas}</td>
                        <td class="p-4">${formatRupiah(item.harga)}</td>
                        <td class="p-4">
                            <span class="bg-amber-500/10 text-amber-400 px-2.5 py-1 rounded-md border border-amber-500/20 font-medium text-[11px]">
                                ${item.terjual} unit
                            </span>
                        </td>
                        <td class="p-4 font-semibold text-amber-400">${formatRupiah(total)}</td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="bukaModalEdit(${index})" class="bg-blue-600/20 hover:bg-blue-600 active:scale-95 text-blue-400 hover:text-white px-3 py-1.5 rounded-lg border border-blue-500/30 transition-all text-[11px] font-medium cursor-pointer">
                                    Edit
                                </button>
                                <button onclick="hapusData(${index})" class="bg-red-600/20 hover:bg-red-600 active:scale-95 text-red-400 hover:text-white px-3 py-1.5 rounded-lg border border-red-500/30 transition-all text-[11px] font-medium cursor-pointer">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                bodyTabel.innerHTML += row;
            });

            document.getElementById('grandTotalText').innerText = formatRupiah(grandTotal);
        }

        // Buka Modal Tambah
        function bukaModalTambah() {
            document.getElementById('modalTitle').innerText = 'Tambah Data Penjualan';
            document.getElementById('editIndex').value = '-1';
            document.getElementById('formPenjualan').reset();
            document.getElementById('modalForm').classList.remove('hidden');
        }

        // Buka Modal Edit
        function bukaModalEdit(index) {
            let item = dataPenjualan[index];
            document.getElementById('modalTitle').innerText = 'Edit Data: ' + item.model;
            document.getElementById('editIndex').value = index;
            document.getElementById('inputModel').value = item.model;
            document.getElementById('inputKapasitas').value = item.kapasitas;
            document.getElementById('inputHarga').value = item.harga;
            document.getElementById('inputTerjual').value = item.terjual;
            document.getElementById('modalForm').classList.remove('hidden');
        }

        // Tutup Modal
        function tutupModal() {
            document.getElementById('modalForm').classList.add('hidden');
        }

        // Simpan Data (Tambah / Edit)
        function simpanData(e) {
            e.preventDefault();
            let index = parseInt(document.getElementById('editIndex').value);
            
            let dataBaru = {
                model: document.getElementById('inputModel').value,
                kapasitas: document.getElementById('inputKapasitas').value,
                harga: parseInt(document.getElementById('inputHarga').value),
                terjual: parseInt(document.getElementById('inputTerjual').value)
            };

            if (index === -1) {
                // Tambah Data Baru
                dataPenjualan.push(dataBaru);
            } else {
                // Update Data Lama
                dataPenjualan[index] = dataBaru;
            }

            tutupModal();
            renderTabel();
        }

        // Hapus Data
        function hapusData(index) {
            if (confirm('Apakah kamu yakin ingin menghapus data ini?')) {
                dataPenjualan.splice(index, 1);
                renderTabel();
            }
        }

        // Export ke Excel (CSV)
        function exportKeExcel() {
            let csv = ["Model iPhone,Kapasitas,Harga Satuan,Terjual,Total Pendapatan"];
            dataPenjualan.forEach(item => {
                let total = item.harga * item.terjual;
                csv.push(`"${item.model}","${item.kapasitas}","${item.harga}","${item.terjual}","${total}"`);
            });

            let csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
            let downloadLink = document.createElement("a");
            downloadLink.download = "Laporan_Penjualan_iPhone.csv";
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }

        // Jalankan render tabel saat halaman dibuka
        renderTabel();
    </script>

</body>
</html>