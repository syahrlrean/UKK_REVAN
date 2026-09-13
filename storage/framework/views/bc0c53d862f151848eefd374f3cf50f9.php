<?php $__env->startSection('title', 'Tambah Produk Baru'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
    }

    .card-dark-yellow {
        background: var(--card-bg-dark) !important;
        border: 1px solid var(--border-yellow-subtle);
        border-radius: 1.25rem;
    }

    /* Form Styling */
    .form-label-custom {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-subtle);
        margin-bottom: 0.5rem;
    }

    .form-control-dark {
        background-color: rgba(12, 10, 9, 0.7) !important;
        border: 1px solid var(--border-yellow-subtle) !important;
        color: #ffffff !important;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        transition: all 0.2s ease;
    }

    .form-control-dark:focus {
        border-color: var(--accent-yellow) !important;
        box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.15) !important;
    }

    /* FIX DROPDOWN & ICON PANAH */
    select.form-control-dark {
        color: #ffffff !important;
        background-color: rgba(12, 10, 9, 0.7) !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23f59e0b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
    }

    /* FIX WARNA TEKS OPTION DROPDOWN */
    select.form-control-dark option {
        background-color: #1c1917 !important;
        color: #ffffff !important;
        padding: 10px;
    }

    /* Preview Foto Box */
    .preview-box {
        width: 100%;
        height: 250px;
        border: 2px dashed var(--border-yellow-subtle);
        border-radius: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-subtle);
        overflow: hidden;
        background: rgba(12, 10, 9, 0.4);
        transition: all 0.3s ease;
    }

    .preview-box:hover {
        border-color: var(--accent-yellow);
    }

    .preview-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* Button Styling */
    .btn-yellow {
        background: var(--accent-yellow) !important;
        color: #000000 !important;
        font-weight: 700;
        border: none !important;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
    }

    .btn-yellow:hover {
        background: var(--accent-yellow-hover) !important;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-cancel-custom {
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-subtle);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        text-decoration: none;
    }

    .btn-cancel-custom:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
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

    
    <div class="d-flex justify-content-between align-items-center mb-4 pb-4 border-bottom border-secondary border-opacity-25">
        <div>
            <h1 class="fw-bold text-white mb-1" style="font-size: 1.8rem;">Tambah Produk Baru</h1>
            <p class="text-muted small mb-0">Isi formulir berikut untuk menambahkan stok barang ke dalam sistem.</p>
        </div>
        <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-back-custom d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    
    <div class="card card-dark-yellow p-4 p-lg-5">
        <form action="<?php echo e(route('produk.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row g-5">
                
                
                <div class="col-lg-7">
                    
                    <div class="mb-4">
                        <label class="form-label-custom">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control form-control-dark <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Contoh: Kopi Susu Aren" value="<?php echo e(old('nama')); ?>" required>
                        <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="mb-4">
                        <label class="form-label-custom">Kategori Produk <span class="text-danger">*</span></label>
                        <select name="kategori_id" class="form-select form-control-dark <?php $__errorArgs = ['kategori_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="" disabled selected class="text-muted">-- Pilih Kategori --</option>
                            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kategori->id); ?>" <?php echo e(old('kategori_id') == $kategori->id ? 'selected' : ''); ?> style="background-color: #1c1917; color: #ffffff;">
                                    <?php echo e($kategori->nama ?? $kategori->nama_kategori ?? $kategori->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['kategori_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label-custom">Harga Beli (Rp)</label>
                            <input type="number" name="harga_beli" class="form-control form-control-dark" placeholder="0" value="<?php echo e(old('harga_beli')); ?>">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label-custom">Harga Jual (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga_jual" class="form-control form-control-dark <?php $__errorArgs = ['harga_jual'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="0" value="<?php echo e(old('harga_jual')); ?>" required>
                            <?php $__errorArgs = ['harga_jual'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div class="mb-4">
                        <label class="form-label-custom">Jumlah Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stok" class="form-control form-control-dark <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="0" value="<?php echo e(old('stok', 0)); ?>" required>
                        <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="col-lg-5">
                    <label class="form-label-custom">Foto Produk</label>
                    <div class="preview-box mb-3" id="imagePreviewContainer">
                        <i class="bi bi-cloud-arrow-up fs-1 mb-2"></i>
                        <span class="small">Preview Foto Produk</span>
                    </div>
                    <input type="file" name="foto" id="fotoInput" class="form-control form-control-dark <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
                    <p class="text-muted small mt-2"><i class="bi bi-info-circle me-1"></i> Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                    <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="col-12 d-flex justify-content-end gap-3 mt-4 pt-4 border-top border-secondary border-opacity-25">
                    <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-cancel-custom">Batal</a>
                    <button type="submit" class="btn btn-yellow d-inline-flex align-items-center gap-2">
                        <i class="bi bi-floppy-fill"></i> Simpan Produk
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    document.getElementById('fotoInput').onchange = evt => {
        const [file] = document.getElementById('fotoInput').files
        if (file) {
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = `<img src="${URL.createObjectURL(file)}" alt="Preview">`;
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS-main\resources\views/produk/create.blade.php ENDPATH**/ ?>