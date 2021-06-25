<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item active">
        <a href="/" class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a>
    </li>
    @if(Auth::user()->level == "Developer")
    <li class="nav-item">
        <a href="#" class="nav-link text-white">
          <i class="nav-icon fas fa-circle"></i>
          <p>
            User            
          </p>
        </a>        
    </li>
    <li class="nav-item">
        <a href="{{ route('product.index') }}" class="nav-link text-white">
          <i class="nav-icon fas fa-circle"></i>
          <p>
            Produk           
          </p>
        </a>        
    </li>
    @else
    <li class="nav-item">
        <a href="#" class="nav-link text-white">
          <i class="nav-icon fas fa-circle"></i>
          <p>
            Laporan
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="/home" class="nav-link text-white">
              <i class="far fa-circle nav-icon"></i>
              <p>Pemesanan</p>
            </a>
          </li>
        </ul>
    </li>
    @endif
</ul>
