<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ $profile->avatar }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ $profile->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        @if(Auth::user()->level==1)
          <li @if($modul=='manager') class="active" @endif>
            <a href="{{ route('managers') }}"><i class="fa fa-user"></i> Manajer</a>
          </li>
          <li @if($modul=='cashier') class="active" @endif>
            <a href="{{ route('cashiers') }}"><i class="fa fa-group"></i> Kasir</a>
          </li>
          <li @if($modul=='category') class="active" @endif>
            <a href="{{ route('categories') }}"><i class="fa fa-cubes"></i> Kategori</a>
          </li>
          <li @if($modul=='product') class="active" @endif>
            <a href="{{ route('products', 'all') }}"><i class="fa fa-cube"></i> Produk</a>
          </li>
          <?php $moduls2 = ['products_recycle', 'categories_recycle']; ?>
          <li class="treeview @if(in_array($modul, $moduls2)) active @endif">
            <a href="#">
              <i class="fa fa-trash"></i> <span>Recycle Bin</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li @if($modul=='categories_recycle') class="active" @endif><a href="{{ route('categories.recycle') }}"><i class="fa fa-trash"></i> Kategori Dihapus</a></li>
              <li @if($modul=='products_recycle') class="active" @endif><a href="{{ route('products.recycle') }}"><i class="fa fa-trash"></i> Produk Dihapus</a></li>
            </ul>
          </li>
          <li @if($modul=='backup') class="active" @endif>
            <a href="{{ route('backup') }}"><i class="fa fa-database"></i> Backup</a>
          </li>
        @elseif(Auth::user()->level==2)
            <li @if($modul=='home') class="active" @endif><a href="{{ route('home') }}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
          <?php $moduls = ['products_report',]; ?>
          <li class="treeview @if(in_array($modul, $moduls)) active @endif">
            <a href="#">
              <i class="fa fa-print"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li @if($modul=='products_report') class="active" @endif><a href="{{ route('report.products', 'today') }}"><i class="fa fa-print"></i> Produk Terjual</a></li>
            </ul>
          </li>
          <?php $moduls2 = ['products_recycle', 'categories_recycle']; ?>
          <li class="treeview @if(in_array($modul, $moduls2)) active @endif">
            <a href="#">
              <i class="fa fa-trash"></i> <span>Recycle Bin</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li @if($modul=='categories_recycle') class="active" @endif><a href="{{ route('categories.recycle') }}"><i class="fa fa-trash"></i> Kategori Dihapus</a></li>
              <li @if($modul=='products_recycle') class="active" @endif><a href="{{ route('products.recycle') }}"><i class="fa fa-trash"></i> Produk Dihapus</a></li>
            </ul>
          </li>
        @else
          <li @if($modul=='transaction') class="active" @endif><a href="{{ route('transactions') }}"><i class="fa fa-sellsy"></i> Penjualan</a></li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>