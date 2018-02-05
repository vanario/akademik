<aside class="main-sidebar" id="main-menu">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <div class="user-panel">
            <div class="image text-center">
                {{-- <img src="{{ asset('img/logo.png') }}" class="img-circle" alt="User Image"> --}}
            </div>
            {{-- <input type="hidden" value="{{ Auth::user()->type->division->name }}" id="division-name"> --}}

            <h4 class="text-center font-green">Sistem Akademik</h4>
        </div>

      <!-- search form (Optional) -->
     {{--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> --}}
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">Menu</li>
        
           @if (!Auth::check() || Auth::user()->level == '1')

            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span>Guru</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('data-guru') }}"><i class="fa fa-circle-o"></i>Data Guru</a></li>
                    <li><a href="{{ url('pengampu') }}"><i class="fa fa-circle-o"></i>Pengampu</a></li>
                    <li><a href="{{ url('wali-kelas') }}"><i class="fa fa-circle-o"></i>Wali Kelas</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span>Siswa</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('data-siswa') }}"><i class="fa fa-circle-o"></i>Data siswa</a></li>
                    <li><a href="{{ url('presensi') }}"><i class="fa fa-circle-o"></i>Presensi</a></li>
                    <li><a href="{{ url('ahlak') }}"><i class="fa fa-circle-o"></i>Ahlak Dan Kepribadian</a></li>
                    <li><a href="{{ url('ekstrak') }}"><i class="fa fa-circle-o"></i>Ekstrakurikuler</a></li>
                </ul>
            </li>

            <li><a href="{{ url('data-master') }}"><i class="fa fa-circle-o"></i> Data Mater</a></li> 
            <li><a href="{{ url('register/index') }}"><i class="fa fa-circle-o"></i> Register</a></li>
          @endif

          {{-- Wali kelas --}}
          @if (!Auth::check() || Auth::user()->wali_kelas == 'TRUE')
            <li><a href="{{ url('wali-nilai/index') }}"><i class="fa fa-circle-o"></i>Nilai Rekap</a></li>
            <li><a href="{{ url('wali-nilai/print') }}"><i class="fa fa-circle-o"></i>Print Nilai Rekap</a></li>
          @endif

          {{-- Guru --}}
          @if (!Auth::check() || Auth::user()->level == '3')
            <li><a href="{{ url('nilai') }}"><i class="fa fa-circle-o"></i>Nilai Mata Pelajaran</a>
              <li><a href="{{ url('nilai/pdfprint') }}"><i class="fa fa-circle-o"></i>Print Nilai Mata Pelajaran</a></li></li>
          @endif

          @if (!Auth::check() || Auth::user()->level == '4')
            <li><a href="{{ url('nilai-siswa/index') }}"><i class="fa fa-circle-o"></i>Nilai Mata Pelajaran</a></li>
          @endif     

       

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
