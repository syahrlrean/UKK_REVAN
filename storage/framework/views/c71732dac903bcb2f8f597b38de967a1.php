

<?php $__env->startSection('title', 'Profil Saya'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<style>
    :root {
        --bg-dark-yellow: #0c0a09;
        --card-bg-dark: #1c1917;
        --border-yellow-subtle: rgba(245, 158, 11, 0.15);
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
        overflow: hidden; /* Mencegah elemen keluar batas card */
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

    .profile-avatar {
        width: 80px;
        height: 80px;
        background-color: rgba(245, 158, 11, 0.15);
        color: var(--accent-yellow);
        font-size: 2.2rem;
        font-weight: 700;
        border: 2px solid var(--accent-yellow);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
</style>

<div class="container-fluid px-4 py-4" style="max-width: 900px;">

    
    <div class="pb-4 mb-4 border-bottom border-secondary border-opacity-25">
        <h1 class="fw-bold text-white mb-1" style="font-size: 1.8rem;">
            Profil Saya
        </h1>
        <p class="text-muted small mb-0">Kelola informasi akun dan kata sandi Anda.</p>
    </div>

    
    <?php if(session('success')): ?>
    <div class="alert alert-success bg-opacity-10 border-success text-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
    <div class="alert alert-danger bg-opacity-10 border-danger text-danger alert-dismissible fade show mb-4" role="alert">
        <ul class="mb-0 ps-3">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="card card-dark-yellow p-4 text-center h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="profile-avatar mb-3">
                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                </div>
                <h5 class="fw-bold text-white mb-1"><?php echo e($user->name); ?></h5>
                <p class="text-muted small mb-3 text-break"><?php echo e($user->email); ?></p>
                <div>
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                        <i class="bi bi-shield-lock-fill me-1"></i> <?php echo e(ucfirst($user->role ?? 'Admin')); ?>

                    </span>
                </div>
            </div>
        </div>

        
        <div class="col-md-8">
            <div class="card card-dark-yellow p-4">
                <h5 class="fw-bold text-white mb-4 pb-2 border-bottom border-secondary border-opacity-25">
                    <i class="bi bi-person-gear me-2" style="color: var(--accent-yellow);"></i> Pengaturan Akun
                </h5>

                <form action="<?php echo e(route('profile.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-3">
                        <label class="form-label text-subtle small fw-bold">NAMA LENGKAP</label>
                        <input type="text" name="name" class="form-control form-control-dark" value="<?php echo e(old('name', $user->name)); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-subtle small fw-bold">ALAMAT EMAIL</label>
                        <input type="email" name="email" class="form-control form-control-dark" value="<?php echo e(old('email', $user->email)); ?>" required>
                    </div>

                    <h6 class="fw-bold text-white mt-4 mb-3 pt-3 border-top border-secondary border-opacity-25">
                        <i class="bi bi-key-fill me-2" style="color: var(--accent-yellow);"></i> Ubah Password <span class="text-muted fw-normal fs-6">(Opsional)</span>
                    </h6>

                    <div class="mb-3">
                        <label class="form-label text-subtle small fw-bold">PASSWORD LAMA</label>
                        <input type="password" name="current_password" class="form-control form-control-dark" placeholder="Masukkan password saat ini">
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-subtle small fw-bold">PASSWORD BARU</label>
                            <input type="password" name="password" class="form-control form-control-dark" placeholder="Minimal 8 karakter">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-subtle small fw-bold">KONFIRMASI PASSWORD BARU</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-dark" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-yellow px-4 py-2 rounded-3">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS-main\resources\views/profile/index.blade.php ENDPATH**/ ?>