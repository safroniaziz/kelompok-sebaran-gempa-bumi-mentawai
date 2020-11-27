<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('admin.dashboard') }}">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('admin.data_gempa') }}">
  <a href="{{ route('admin.data_gempa') }}">
      <i class="fa fa-dashboard"></i> <span>Data Gempa Bumi</span>
  </a>
</li>

<li class="{{ set_active('admin.proses_clustering.proses_clustering') }}">
  <a href="{{ route('admin.proses_clustering.proses_clustering') }}">
      <i class="fa fa-dashboard"></i> <span>Proses Clustering</span>
  </a>
</li>

<li class="treeview {{ set_active(['admin.data_clustering.pusat_cluster','admin.data_clustering.data_iterasi','admin.data_clustering.nilai_cost']) }}">
  <a href="#">
      <i class="fa fa-pencil-square-o"></i> <span>Data Clustering</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
      </span>
  </a>
  <ul class="treeview-menu " style="padding-left:25px;">
      <li class="{{ set_active('admin.data_clustering.pusat_cluster') }}"><a href="{{ route('admin.data_clustering.pusat_cluster') }}"><i class="fa fa-address-card"></i>Pusat Cluster</a></li>
      <li class="{{ set_active('admin.data_clustering.data_iterasi') }}"><a href="{{ route('admin.data_clustering.data_iterasi') }}"><i class="fa fa-pencil-square-o"></i>Data Iterasi</a></li>
      <li class="{{ set_active('admin.data_clustering.nilai_cost') }}"><a href="{{ route('admin.data_clustering.nilai_cost') }}"><i class="fa fa-pencil-square-o"></i>Nilai Cost</a></li>
  </ul>
</li>

<li class="treeview {{ set_active(['admin.tampilan_data.table','admin.tampilan_data.grafik','admin.tampilan_data.peta']) }}">
  <a href="#">
      <i class="fa fa-pencil-square-o"></i> <span>Data Hasil Clustering</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
      </span>
  </a>
  <ul class="treeview-menu " style="padding-left:25px;">
      <li class="{{ set_active('admin.tampilan_data.table') }}"><a href="{{ route('admin.tampilan_data.table') }}"><i class="fa fa-address-card"></i>Tampilan Tabel</a></li>
      <li class="{{ set_active('admin.tampilan_data.grafik') }}"><a href="{{ route('admin.tampilan_data.grafik') }}"><i class="fa fa-pencil-square-o"></i>Tampilan Grafik</a></li>
      <li class="{{ set_active('admin.tampilan_data.peta') }}"><a href="{{ route('admin.tampilan_data.peta') }}"><i class="fa fa-pencil-square-o"></i>Tampilan Peta</a></li>
  </ul>
</li>

<li>
  <a href="{{ route('logout') }}"
      onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
      <i class="fa fa-power-off text-danger"></i>&nbsp;{{ __('Logout') }}
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
</li>