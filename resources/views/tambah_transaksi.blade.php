    <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TambahTransaksi - Laundry</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/index" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Xi Laundry</span>
      </a><br>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name }}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="/index">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
      <a class="nav-link collapsed" href="/member">
          <i class="bi bi-person"></i><span>Member</span>
        </a>
       
      </li><!-- End Member Nav -->
      @if(auth()->user()->type=='Admin')
      <li class="nav-item">
        <a class="nav-link collapsed" href="/paket">
          <i class="bi bi-layout-text-window-reverse"></i><span>Paket</span>
        </a>
      </li><!-- End Paket Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/outlet">
          <i class="bi bi-cart"></i><span>Outlet</span>
        </a>
      </li><!-- End Outlet Nav -->
      @endif
      <li class="nav-item">
        <a class="nav-link" href="/tambahtransaksi">
          <i class="bi bi-currency-dollar"></i><span>Transaksi</span>
        </a>
      </li><!-- End Transaksi Nav -->
      @if(auth()->user()->type=='Admin')
      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/register">
          <i class="bi bi-person"></i>
        <span>Register</span>
       </a>
      </li><!-- End Register Page Nav -->
      @endif

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Transaksi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/index">Dashboard</a></li>
          <li class="breadcrumb-item active">Tambah Transaksi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  </div>
  <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <h4>Tambah Data Transaksi</h4>
                        </div>
                        <form action="{{route ('transaksi_tambah')}}" method="POST">
                          @csrf
                        <div class="card-body">
                      
                        
                          <div class="form-group">
                            <label>Pilih Member :</label>
                            <br>
                            <select class="form-control col-md-2" name="id_member">
                            <option value="" selected>--Pilih--</option>  
                            @foreach ($member as $data_member)
                            <option value="{{$data_member->id_member}}">{{$data_member->nama_member}}</option>            
                            @endforeach
                            </select>  
                            <label 
                            @error('id_member') 
                            class="text-danger"
                            @enderror>
                            @error('id_member')
                            {{$message}}
                            @enderror
                          </label>
                        </div>
                        
                        <div class="form-group">
                          <label>Pilih Paket :</label>
                          <br>
                          <select class="form-control col-md-2" name="id_paket">
                          <option value="" selected>--Pilih--</option>  
                          @foreach ($paket as $data_paket)
                          <option value="{{$data_paket->id_paket}}">{{$data_paket->jenis }}</option>            
                          @endforeach
                          </select>  
                          <label 
                          @error('id_paket') 
                          class="text-danger"
                          @enderror>
                          @error('id_paket')
                          {{$message}}
                          @enderror
                        </label>
                      </div>

                      <div class="form-group">
                        <label>Berat :</label>
                        <input type="number" class="form-control col-md-2" name="qty">
                        <label
                        @error('qty')
                        class="text-danger"
                        @enderror>
                        @error('qty')
                        {{$message}}
                        @enderror
                        </label>
                        </div>
                    

                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                            <label>Tanggal Transaksi :</label>
                            <input type="date" class="form-control col-md-6" name="tgl">
                            <label 
                            @error('tgl') 
                            class="text-danger"
                            @enderror>
                            @error('tgl')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label>Batas Waktu :</label>
                            <input type="date" class="form-control col-md-6" name="batas_waktu">
                            <label 
                            @error('batas_waktu') 
                            class="text-danger"
                            @enderror>
                            @error('batas_waktu')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>

                          <div class="form-group">
                            <label>Status :</label>
                            <br>
                            <select class="form-control col-md-2" name="status">
                            <option value="" selected>--Pilih--</option>
                            <option value="baru">Baru</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                            <option value="diambil">Diambil</option>
                            </select> 
                            <label 
                            @error('status') 
                            class="text-danger"
                            @enderror>
                            @error('status')
                            {{$message}}
                            @enderror
                          </label>
                          </div>

                          <div class="form-group">
                            <label>Status Bayar :</label>
                            <br>
                            <select class="form-control col-md-2" name="dibayar">
                            <option value="" selected>--Pilih--</option>
                            <option value="dibayar">Dibayar</option>
                            <option value="belum_bayar">Belum dibayar</option>
                            </select> 
                            <label 
                            @error('dibayar') 
                            class="text-danger"
                            @enderror>
                            @error('dibayar')
                            {{$message}}
                            @enderror
                          </label>
                          </div>

                          <button class="btn btn-primary" type="submit">Tambah</button>
                          <button class="btn btn-secondary" type="reset">Reset</button>
                        
                  </div>
                        </form>
            </div>
         </div>

    </div>
  <!-- ======= Footer ======= -->
  <!-- <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits"> -->
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer>End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>