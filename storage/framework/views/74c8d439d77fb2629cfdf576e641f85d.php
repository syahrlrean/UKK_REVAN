<style>
    :root {
        --sidebar-width: 260px;
        --bg-dark-yellow: #0c0a09; /* Dark background */
        --sidebar-bg: #1c1917; /* Slate dark warm */
        --sidebar-border: rgba(245, 158, 11, 0.15); /* Amber border */
        --accent-yellow: #f59e0b; /* Bright Amber/Yellow */
        --accent-yellow-hover: #d97706;
        --text-subtle: #a8a29e;
    }

    body {
        padding-left: var(--sidebar-width);
        background-color: var(--bg-dark-yellow) !important;
    }

    @media (max-width: 991.98px) {
        body {
            padding-left: 0;
        }
    }

    /* --- SIDEBAR CONTAINER --- */
    .sidebar-custom {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        background: var(--sidebar-bg);
        border-right: 1px solid var(--sidebar-border);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1.5rem 1rem;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* --- BRAND / LOGO --- */
    .sidebar-brand {
        color: #ffffff !important;
        font-weight: 800;
        font-size: 1.25rem;
        letter-spacing: -0.02em;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        padding: 0 0.5rem;
        margin-bottom: 2rem;
    }

    .brand-icon-yellow {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000000;
        font-size: 1.25rem;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    /* --- NAVIGATION LINKS --- */
    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-link {
        color: var(--text-subtle) !important;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.75rem 1rem !important;
        border-radius: 0.625rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.85rem;
        text-decoration: none;
    }

    .sidebar-link i {
        font-size: 1.15rem;
        transition: color 0.2s ease;
    }

    .sidebar-link:hover {
        color: #fef08a !important; /* Soft yellow text */
        background: rgba(245, 158, 11, 0.1);
        transform: translateX(3px);
    }

    .sidebar-link.active {
        color: #000000 !important;
        background: var(--accent-yellow);
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
    }

    .sidebar-link.active i {
        color: #000000 !important;
    }

    /* --- USER FOOTER / DROPDOWN --- */
    .sidebar-user-card {
        background: rgba(12, 10, 9, 0.6);
        border: 1px solid var(--sidebar-border);
        border-radius: 0.875rem;
        padding: 0.6rem 0.75rem;
        transition: all 0.2s ease;
    }

    .sidebar-user-card:hover {
        border-color: rgba(245, 158, 11, 0.4);
        background: rgba(12, 10, 9, 0.9);
    }

    .avatar-circle-yellow {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--accent-yellow);
        color: #000000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        font-weight: 800;
    }

    .dropdown-menu-dark-yellow {
        background-color: #1c1917 !important;
        border: 1px solid var(--sidebar-border) !important;
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.8);
        width: 100%;
        margin-bottom: 0.5rem !important;
    }

    .dropdown-menu-dark-yellow .dropdown-item {
        color: var(--text-subtle) !important;
        font-weight: 500;
        font-size: 0.875rem;
        padding: 0.6rem 1rem;
        border-radius: 0.5rem;
    }

    .dropdown-menu-dark-yellow .dropdown-item:hover {
        background-color: rgba(245, 158, 11, 0.15) !important;
        color: #fde047 !important;
    }

    /* RESPONSIVE TOGGLER (MOBILE ONLY) */
    .mobile-header {
        display: none;
        background: var(--sidebar-bg);
        border-bottom: 1px solid var(--sidebar-border);
        padding: 0.8rem 1.25rem;
    }

    @media (max-width: 991.98px) {
        .mobile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .sidebar-custom {
            transform: translateX(-100%);
        }

        .sidebar-custom.show {
            transform: translateX(0);
        }
    }
</style>


<div class="mobile-header">
    <a class="sidebar-brand mb-0" href="<?php echo e(url('/perusahaan')); ?>">
        <div class="brand-icon-yellow">
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <span>POS<span style="color: var(--accent-yellow);">SYHRUL</span></span>
    </a>
    <button class="btn text-white p-0 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile">
        <i class="bi bi-list fs-1" style="color: var(--accent-yellow);"></i>
    </button>
</div>


<aside class="sidebar-custom" id="sidebarMenu">
    <div>
        
        <a class="sidebar-brand" href="<?php echo e(url('/perusahaan')); ?>">
            <div class="brand-icon-yellow">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <span>POS<span style="color: var(--accent-yellow);">SYHRUL</span></span>
        </a>

        
        <ul class="sidebar-nav">
            <li>
                <a class="sidebar-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>" href="<?php echo e(url('/dashboard')); ?>">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a class="sidebar-link <?php echo e(request()->is('admin/users*') ? 'active' : ''); ?>" href="<?php echo e(Route::has('admin.users') ? route('admin.users') : url('/admin/users')); ?>">
                    <i class="bi bi-people-fill"></i>
                    <span>Users</span>
                </a>
            </li>

            
            <li>
                <a class="sidebar-link <?php echo e(request()->is('kategori*') ? 'active' : ''); ?>" href="<?php echo e(Route::has('kategori.index') ? route('kategori.index') : url('/kategori')); ?>">
                    <i class="bi bi-tags-fill"></i>
                    <span>Kategori</span>
                </a>
            </li>

            <li>
                <a class="sidebar-link <?php echo e(request()->is('produk*') ? 'active' : ''); ?>" href="<?php echo e(url('/produk')); ?>">
                    <i class="bi bi-box-fill"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li>
                <a class="sidebar-link <?php echo e(request()->is('penjualan*') ? 'active' : ''); ?>" href="<?php echo e(url('/penjualan')); ?>">
                    <i class="bi bi-file-earmark-bar-graph-fill"></i>
                    <span>Penjualan</span>
                </a>
            </li>

            
            <li>
                <a class="sidebar-link <?php echo e(request()->is('profil*') || request()->is('profile*') ? 'active' : ''); ?>" href="<?php echo e(Route::has('profile.index') ? route('profile.index') : (Route::has('profile.edit') ? route('profile.edit') : url('/profil'))); ?>">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
        </ul>
    </div>

    
    <div class="dropup">
        <button class="btn sidebar-user-card w-100 d-flex align-items-center justify-content-between text-start border-0" 
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="d-flex align-items-center gap-2 overflow-hidden">
                <div class="avatar-circle-yellow flex-shrink-0">
                    <?php echo e(strtoupper(substr(Auth::user()->name ?? 'K', 0, 1))); ?>

                </div>
                <div class="text-truncate">
                    <div class="fw-bold text-white fs-7 text-truncate"><?php echo e(Auth::user()->name ?? 'Kuda'); ?></div>
                    <div class="text-muted" style="font-size: 0.75rem;">Account</div>
                </div>
            </div>
            <i class="bi bi-three-dots-vertical text-muted"></i>
        </button>

        <ul class="dropdown-menu dropdown-menu-dark-yellow p-2">
            <li>
                <a class="dropdown-item d-flex align-items-center gap-2" href="<?php echo e(Route::has('profile.edit') ? route('profile.edit') : (Route::has('profile.index') ? route('profile.index') : url('/profil'))); ?>">
                    <i class="bi bi-person"></i> Profil
                </a>
            </li>
            <li>
                <hr class="dropdown-divider border-secondary opacity-25">
            </li>
            <li>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2 w-100 border-0 bg-transparent text-start">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside><?php /**PATH C:\laragon\www\UKK_REVAN\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>