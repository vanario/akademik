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
        
        
            <li><a href="{{ url('/') }}"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Presensi</a></li>
            <li><a href="{{ url('data-master') }}"><i class="fa fa-circle-o"></i> Data Mater</a></li>      
       

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
