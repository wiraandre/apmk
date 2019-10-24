<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link
            rel="stylesheet"
            href="/assets/bootsrap/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous"
        />

        <link
            rel="stylesheet"
            href="/dashboard.css"
            
        />
        <title>APMK | @yield('title')</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
          <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Balitbangda Kab. Pesawaran</a>
          <div class="collapse navbar-collapse" id="menu-collapse" style="padding-right: 20px;">
            <ul class="navbar-nav  ml-auto mt-2 mt-lg-0">

              <li class="nav-item">
                <a href="#" class="nav-link">Selamat datang  
                  @if(Auth::user()->id_user_level==1) 
                    {{ Auth::user()->name }} (admin)
                  @else
                    {{ Auth::user()->name }} (pegawai)
                  @endif
                
                </a>
              </li>
              <li class="nav-item">
                  <a href="/logout" class="btn btn-sm btn-outline-secondary">Logout</a>
              </li>
              <li class="nav-item"><a href="#"></a></li>
            </ul>
          </div>
        </nav>
    
        <div class="container-fluid">
          <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
              <div class="sidebar-sticky">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link @yield('menu_dasbor')" href="/">
                      <span data-feather="home"></span>
                       Dashboard 
                    </a>
                  </li>
                  @if(Auth::user()->id_user_level==1)
                  <li class="nav-item">
                    <a class="nav-link @yield('menu_progja')"  href="/progja">
                      Program Kerja

                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @yield('menu_tahun_anggaran')" href="/tahun_anggaran">
<!--                       <span data-feather="shopping-cart"></span> -->
                      Tahun Anggaran
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @yield('menu_pegawai')" href="/pegawai">
                      <!-- <span data-feather="users"></span> -->
                      Pegawai
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @yield('menu_anggota')" href="/anggota">
                      <!-- <span data-feather="bar-chart-2"></span> -->
                      Anggota
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @yield('menu_laporan')" href="/laporan">
                      <!-- <span data-feather="layers"></span> -->
                      Laporan
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @yield('menu_dokumentasi')" href="/dokumentasi">
                      <!-- <span data-feather="layers"></span> -->
                      Dokumentasi
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @yield('menu_users')" href="/users">
                      <!-- <span data-feather="layers"></span> -->
                      Users
                    </a>
                  </li>
                  @endif
                </ul>
                

              </div>
            </nav>
    
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">@yield('data_name')</h1>
                <div class="btn-toolbar mb-2 mb-md-0">@yield('data_menu')
                  
                </div>
              
              </div>


                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('danger'))
                <div class="alert alert-danger">{{ session('danger') }}</div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
                @yield('data_content')

              </div>
            </main>
          </div>
        </div>

        
        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script>
          feather.replace()
        </script>
    
       
      </body>
    <script
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"
    ></script>
    
</html>
