<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Custom fonts for this template-->
  <link href="{{ asset('startbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('startbootstrap/css/sb-admin-2.min.css') }}" rel="stylesheet">
  @yield('script')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link href="{{ asset('startbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  @include('alert')
</head>

<body id="page-top">
  <!-- modal tambah pembayaran -->
  <form action="{{ route('pembayaranadmin.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="myModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Metode Pembayaran</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-capitalize">
            <div class="mb-3">
              <label for="kelas" class="form-label fw-bold">metode pembayaran</label>
              <select name="metodepembayaran" id="selectMetode" class="form-control">
                <option value="" class="dropdown-menu" disabled selected>Pilih Metode Pembayaran
                </option>
                <option value="bank" data-target="bankInput">Bank</option>
              </select>
            </div>
            <div class="" value="bank" id="bankInput" style="display: none;">
              <div class="mb-3">
                <label for="kelas" class="form-label fw-bold">tujuan</label>
                <input type="text" name="tujuan" id="tujuan-bank" class="form-control" value="{{ old('tujuan') }}">
                @if ($errors->has('keterangan_bank'))
                  <span class="text-tujuan">{{ $errors->first('tujuan') }}</span>
                @endif
              </div>
              <div class="mb-3">
                <label for="kelas" class="form-label fw-bold">Nomor Rekening</label>
                <input type="number" name="keterangan" id="keterangan" class="form-control"
                  value="{{ old('keterangan') }}">
                @if ($errors->has('keterangan'))
                  <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- end modal -->

  <!-- Modal Edit Metode Pembayaran -->

  <!-- Page Wrapper -->
  <div id="wrapper">
    @yield('sidebar')
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboardAdmin">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="{{ route('kamar.index') }}">Kamar</a>
            <a class="collapse-item" href="{{ route('kepengguna') }}">Pengguna</a>
          </div>
        </div>
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('transaksiAdmin') }}">
          <i class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26"
              fill="none">
              <path
                d="M18.75 5.51367H6.25C4.52411 5.51367 3.125 6.91278 3.125 8.63867V16.972C3.125 18.6979 4.52411 20.097 6.25 20.097H18.75C20.4759 20.097 21.875 18.6979 21.875 16.972V8.63867C21.875 6.91278 20.4759 5.51367 18.75 5.51367Z"
                stroke="white" stroke-width="1.23" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M3.125 10.7207H21.875" stroke="white" stroke-width="1.23" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M7.29224 15.9297H7.30224" stroke="white" stroke-width="1.23" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M11.4578 15.9297H13.5411" stroke="white" stroke-width="1.23" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </i>
          <span class="item-name">Pembayaran</span>
        </a>
      </li>

      <!-- <li class="nav-item active">
                <a class="nav-link" href="{{ route('transaksiAdmin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pembayaran</span></a>
            </li> -->


      <li class="nav-item">
        <a class="nav-link" href="/logout"> <!-- Ganti "logout.php" dengan URL logout Anda -->
          <i class="fas fa-sign-out-alt"></i> <!-- Menggunakan ikon "sign-out" dari Font Awesome -->
          <span>Logout</span>
        </a>
      </li>


      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Login Screens:</h6>
          <a class="collapse-item" href="login.html">Login</a>
          <a class="collapse-item" href="register.html">Register</a>
          <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
          <div class="collapse-divider"></div>
          <h6 class="collapse-header">Other Pages:</h6>
          <a class="collapse-item" href="404.html">404 Page</a>
          <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
      </div>
      </li>

      <!-- Nav Item - Tables -->


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      @yield('navbar')
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                      aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to
                      download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                  Alerts</a>
              </div>
            </li>



            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="{{ asset('startbootstrap/img-profile rounded-circle') }}"
                  src="{{ asset('startbootstrap/img/undraw_profile.svg') }}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
          </div>


          <!-- Content Row -->
          <div class="row">
            <div class="content-inner mt-3 py-0">
              <div class="card border-0 shadow rounded">
                <div class="card-body">
                  <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#myModal">Tambah Transaksi</button>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">metode pembayaran</th>
                        <th scope="col">tujuan</th>
                        <th scope="col">keterangan</th>
                        <th scope="col">aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $no = 1;
                      @endphp
                      @foreach ($adminmp as $a)
                        <tr>
                          <th scope="row">{{ $no++ }}</th>
                          <td>{{ $a->metodepembayaran }}</td>
                          <td>{{ $a->tujuan }}</td>
                          <td>{{ $a->keterangan }}</td>
                          <td>
                            <div class="d-flex">
                              <!-- Tombol Edit -->
                              <button type="button" class="btn btn-outline-warning edit-btn" data-toggle="modal"
                                data-target="#editModal{{ $a->id }}">
                                <i class="bi bi-pencil-square"></i>
                              </button>

                              <!-- Modal Edit -->
                              <div class="modal fade" id="editModal{{ $a->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="editModalLabel{{ $a->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="editModalLabel{{ $a->id }}">Edit Transaksi</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="{{ route('transaksiadminupdate.update' ,$a->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                      <div class="modal-body">
                                        <div class="mb-3">
                                          <label class="form-label">Metode Pembayaran</label>
                                          <input type="text" class="form-control" name="metodepembayaran" value="{{ $a->metodepembayaran }}">
                                        </div>
                                        <div class="mb-3">
                                          <label class="form-label">Tujuan</label>
                                          <input type="text" class="form-control" name="tujuan" value="{{ $a->tujuan }}">
                                        </div>
                                        <div class="mb-3">
                                          <label class="form-label">Keterangan</label>
                                          <input type="number" class="form-control" name="keterangan"value="{{ $a->keterangan }}">
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                          data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan </button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>

                              <form action="{{ route('adestroy', $a->id) }}" method="post"
                                id="delete-form{{ $a->id }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger delete-btn ms-1"
                                  onclick="hapus(event)" data-id="{{ $a->id }}"
                                  data-nama="{{ $a->id }}"><i class="bi bi-trash-fill"></i></button>
                              </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <script>
            function hapus(event) {
              Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Data akan terhapus selamanya!',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                  document.getElementById('delete-form' + id).submit();
                }
              });
            }
          </script>

          @yield('content')
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Website 2023</span>
                    </div>
                </div>
            </footer> -->
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const selectMetode = document.getElementById('selectMetode');
        const bankInput = document.getElementById('bankInput');

        selectMetode.addEventListener('change', function() {
          if (selectMetode.value === 'bank') {
            bankInput.style.display = 'block';
          } else {
            bankInput.style.display = 'none';
          }
        });
      });
    </script>


</body>

</html>
