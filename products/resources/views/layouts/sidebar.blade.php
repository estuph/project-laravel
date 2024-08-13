<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ url('/') }}">MyApp</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}">MA</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        @if(auth()->user()->role == 'admin')
            <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Admin Menu</li>
            <li><a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-box"></i> <span>Products</span></a></li>
            <li><a class="nav-link" href="{{ route('variants.index') }}"><i class="fas fa-tags"></i> <span>Variants</span></a></li>
            <li><a class="nav-link" href="{{ route('suppliers.index') }}"><i class="fas fa-truck"></i> <span>Suppliers</span></a></li>
            <li><a class="nav-link" href="{{ route('pengeluarans.index') }}"><i class="fas fa-wallet"></i> <span>Pengeluaran</span></a></li>
            <li><a class="nav-link" href="{{ route('pembelians.index') }}"><i class="fas fa-shopping-cart"></i> <span>Pembelian</span></a></li>
            <li><a class="nav-link" href="{{route('penjualans.index')}}"><i class="fas fa-cash-register"></i> <span>Penjualan</span></a></li>
            <li class="menu-header">System</li>
            <li><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Users</span></a></li>
            <li class="menu-header">Laporan</li>
            <li><a class="nav-link" href="{{ route('laporan.index') }}"><i class="fas fa-chart-line"></i> <span>Generate Laporan</span></a></li>
        @elseif(auth()->user()->role == 'kasir')
            <li><a class="nav-link" href="{{ route('kasir.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Penjualan & Pembelian</li>
            <li><a class="nav-link" href="{{ route('penjualans.index') }}"><i class="fas fa-cash-register"></i> <span>Penjualan</span></a></li>
            <li><a class="nav-link" href="{{ route('pembelians.index') }}"><i class="fas fa-shopping-cart"></i> <span>Pembelian</span></a></li>
        @endif
    </ul>
</aside>
