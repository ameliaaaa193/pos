<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon"><i class="bi bi-cart3"></i></div>
        <div>
            <div class="sidebar-brand-title">POS</div>
            <div class="sidebar-brand-subtitle">Point of Sales</div>
        </div>
    </div>

    <ul class="sidebar-menu">
        <li><a class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Dashboard</a></li>
        {{-- Menu Users hanya untuk admin(role_id = 1) --}}
        @if(auth()->user()->role_id === 1)
        <li><a class="sidebar-link {{ Request::is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}"><i class="bi bi-people"></i> Users</a></li>
        @endif
        {{-- Menu Jenis hanya untuk admin(role_id = 1) --}}
        @if(auth()->user()->role_id === 1)
        <li><a class="sidebar-link {{ Request::is('jenis') ? 'active' : '' }}" href="{{ route('jenis.index') }}"><i class="bi bi-tags"></i> Jenis</a></li>
        @endif
        <li><a class="sidebar-link {{ Request::is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}"><i class="bi bi-box-seam"></i> Produk</a></li>
        <li><a class="sidebar-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}"><i class="bi bi-cart-check"></i> Penjualan</a></li>
    </ul>

    <div class="sidebar-footer">
        <div class="sidebar-footer-icon"><i class="bi bi-graph-up"></i></div>
        <p>Kelola transaksi, produk, dan laporan penjualan dengan mudah dan efisien.</p>
    </div>
</aside>

<style>
    .sidebar { width: 260px; flex-shrink: 0; background: #fff; border-right: 1px solid #f1e3e8; display: flex; flex-direction: column; padding: 1.5rem 1rem; }
    .sidebar-brand { display: flex; align-items: center; gap: 0.75rem; padding: 0 0.5rem 1.25rem; margin-bottom: 1rem; border-bottom: 1px solid #f1e3e8; }
    .sidebar-brand-icon { width: 40px; height: 40px; border-radius: 0.75rem; background: #db2763; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .sidebar-brand-title { font-weight: 700; color: #db2763; font-size: 1.1rem; line-height: 1.2; }
    .sidebar-brand-subtitle { font-size: 0.75rem; color: #9ca3af; }
    .sidebar-menu { list-style: none; padding: 0; margin: 0; flex: 1; }
    .sidebar-menu li { margin-bottom: 0.25rem; }
    .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 0.75rem; border-radius: 0.6rem; border: 1px solid #e5e7eb; color: #4b5563; text-decoration: none; font-weight: 500; font-size: 0.95rem; transition: all 0.15s ease-in-out; }
    .sidebar-link:hover { background: #fdecf1; color: #db2763; border-color: #fbcfe0; }
    .sidebar-link.active { background: #db2763; color: #fff; border-color: #db2763; }
    .sidebar-footer { margin-top: 1.5rem; background: #fdecf1; border-radius: 1rem; padding: 1.25rem 1rem; text-align: center; }
    .sidebar-footer-icon { width: 44px; height: 44px; border-radius: 50%; background: #db2763; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 0.75rem; }
    .sidebar-footer p { font-size: 0.8rem; color: #6b7280; margin: 0; line-height: 1.4; }
    @media (max-width: 768px) { .sidebar { width: 100%; border-right: none; border-bottom: 1px solid #f1e3e8; } }
</style>