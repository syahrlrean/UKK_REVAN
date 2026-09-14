<?php $__env->startSection('title', 'Daftar Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<style>
    :root {
        --bg-dark-yellow: #0c0a09;
        --card-bg-dark: #1c1917;
        --border-yellow-subtle: rgba(245, 158, 11, 0.15);
        --border-yellow-glow: rgba(245, 158, 11, 0.35);
        --accent-yellow: #f59e0b;
        --accent-yellow-hover: #d97706;
        --accent-yellow-light: #fef08a;
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

    .table-dark-yellow {
        color: var(--text-white) !important;
        margin-bottom: 0;
        --bs-table-bg: transparent !important;
    }

    .table-dark-yellow th {
        background-color: rgba(12, 10, 9, 0.6) !important;
        color: var(--text-subtle) !important;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        border-bottom: 1px solid var(--border-yellow-subtle) !important;
        padding: 1rem 1.25rem;
    }

    .table-dark-yellow td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.04) !important;
        padding: 1rem 1.25rem;
        vertical-align: middle;
    }

    .table-dark-yellow tbody tr:hover td {
        background-color: rgba(245, 158, 11, 0.04) !important;
    }

    .btn-yellow {
        background: var(--accent-yellow) !important;
        color: #000000 !important;
        font-weight: 700;
        border: none !important;
        transition: all 0.2s ease;
    }

    .btn-yellow:hover {
        background: var(--accent-yellow-hover) !important;
        color: #000000 !important;
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

    .badge-stok {
        background: rgba(16, 185, 129, 0.15);
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.3);
        font-weight: 600;
        padding: 0.35em 0.8em;
    }

    .badge-stok-low {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
        font-weight: 600;
        padding: 0.35em 0.8em;
    }

    .btn-action-detail {
        background: rgba(59, 130, 246, 0.1);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.25);
    }
    .btn-action-detail:hover {
        background: rgba(59, 130, 246, 0.25);
        color: #93c5fd;
    }

    .btn-action-edit {
        background: rgba(245, 158, 11, 0.1);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }
    .btn-action-edit:hover {
        background: rgba(245, 158, 11, 0.25);
        color: #fef08a;
    }

    .btn-action-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.25);
    }
    .btn-action-delete:hover {
        background: rgba(239, 68, 68, 0.25);
        color: #fca5a5;
    }
</style>

<div class="container-fluid px-4 py-4">

    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center pb-4 mb-4 border-bottom border-secondary border-opacity-25">
        <div>
            <h1 class="fw-bold text-white mb-1" style="font-size: 1.8rem;">
                Daftar Produk
            </h1>
            <p class="text-muted small mb-0">Kelola informasi stok, harga beli, dan harga jual barang.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <?php if(Route::has('produk.create')): ?>
            <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-yellow px-3 py-2 rounded-3 d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i> Tambah Produk
            </a>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="row mb-4">
        <div class="col-12 col-md-6 col-lg-4">
            <form action="<?php echo e(route('produk.index')); ?>" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-dark" placeholder="Cari nama produk..." value="<?php echo e(request('search')); ?>">
                <button type="submit" class="btn btn-yellow px-3 d-flex align-items-center gap-1">
                    <i class="bi bi-search"></i> Cari
                </button>
            </form>
        </div>
    </div>

    
    <div class="card card-dark-yellow overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark-yellow align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>USER</th>
                        <th class="text-center">FOTO</th>
                        <th>NAMA PRODUK</th>
                        <th>HARGA BELI</th>
                        <th>HARGA JUAL</th>
                        <th class="text-center">STOK</th>
                        <th class="text-end pe-4">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center text-muted fw-semibold">
                            <?php echo e(method_exists($produk, 'firstItem') ? $produk->firstItem() + $index : $index + 1); ?>

                        </td>
                        <td class="small text-muted">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-person-circle fs-6" style="color: var(--accent-yellow);"></i>
                                <span><?php echo e(optional($item->user)->name ?? 'Admin'); ?></span>
                            </div>
                        </td>
                        <td class="text-center">
                            <?php if(!empty($item->foto)): ?>
                                <img src="<?php echo e(asset('storage/' . $item->foto)); ?>" class="rounded-3 border border-secondary border-opacity-25" style="width: 42px; height: 42px; object-fit: cover;">
                            <?php else: ?>
                                <div class="rounded-3 d-inline-flex align-items-center justify-content-center text-muted border border-secondary border-opacity-25" style="width: 42px; height: 42px; background: rgba(255,255,255,0.03);">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="fw-semibold text-white"><?php echo e($item->nama ?? $item->nama_produk); ?></td>
                        <td class="text-muted font-monospace">Rp <?php echo e(number_format($item->harga_beli ?? 0, 0, ',', '.')); ?></td>
                        <td class="fw-bold font-monospace" style="color: var(--accent-yellow);">
                            Rp <?php echo e(number_format($item->harga_jual ?? 0, 0, ',', '.')); ?>

                        </td>
                        <td class="text-center">
                            <?php if(($item->stok ?? 0) > 10): ?>
                                <span class="badge badge-stok rounded-pill"><?php echo e($item->stok); ?></span>
                            <?php else: ?>
                                <span class="badge badge-stok-low rounded-pill"><?php echo e($item->stok); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <?php if(Route::has('produk.show')): ?>
                                <a href="<?php echo e(route('produk.show', $item->id)); ?>" class="btn btn-sm btn-action-detail rounded-2 px-2.5 py-1 d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <?php endif; ?>

                                <?php if(Route::has('produk.edit')): ?>
                                <a href="<?php echo e(route('produk.edit', $item->id)); ?>" class="btn btn-sm btn-action-edit rounded-2 px-2.5 py-1 d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <?php endif; ?>

                                <?php if(Route::has('produk.destroy')): ?>
                                <form action="<?php echo e(route('produk.destroy', $item->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-action-delete rounded-2 px-2.5 py-1 d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-1 d-block mb-2 opacity-50"></i>
                            Belum ada data produk.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(method_exists($produk, 'hasPages') && $produk->hasPages()): ?>
        <div class="card-footer bg-transparent border-0 d-flex justify-content-center py-3">
            <?php echo e($produk->links()); ?>

        </div>
        <?php endif; ?>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\UKK_REVAN\resources\views/produk/index.blade.php ENDPATH**/ ?>