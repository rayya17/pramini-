<!DOCTYPE html>
<html lang="en">

<head>
    <style>

    </style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pemesanan Hotel</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('startbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('startbootstrap/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@include('alert')


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @yield('sidebar')
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-6">Pemesanan Hotel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                        <a class="nav-link "aria-current="page" href="{{ route('dashboardUser') }}">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="30"
                                    viewBox="0 0 27 23" fill="none">
                                    <path
                                        d="M26.1895 6.67998L24.377 1.24248C24.3139 1.05491 24.1912 0.893125 24.0276 0.781849C23.8639 0.670572 23.6684 0.615917 23.4707 0.626232H3.53323C3.33561 0.615917 3.14004 0.670572 2.9764 0.781849C2.81276 0.893125 2.69004 1.05491 2.62698 1.24248L0.81448 6.67998C0.801423 6.77621 0.801423 6.87376 0.81448 6.96998V12.4075C0.81448 12.6478 0.909959 12.8783 1.07991 13.0483C1.24987 13.2183 1.48038 13.3137 1.72073 13.3137H2.62698V22.3762H4.43948V13.3137H9.87698V22.3762H24.377V13.3137H25.2832C25.5236 13.3137 25.7541 13.2183 25.924 13.0483C26.094 12.8783 26.1895 12.6478 26.1895 12.4075V6.96998C26.2025 6.87376 26.2025 6.77621 26.1895 6.67998ZM22.5645 20.5637H11.6895V13.3137H22.5645V20.5637ZM24.377 11.5012H20.752V7.87623H18.9395V11.5012H14.4082V7.87623H12.5957V11.5012H8.06448V7.87623H6.25198V11.5012H2.62698V7.11498L4.18573 2.43873H22.8182L24.377 7.11498V11.5012Z"
                                        fill="#ffffff" />
                                </svg>
                            </i>
                            <span class="item-name">Dashboard</span>
                        </a>
                    </li>

  
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('riwayatuser')}}">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="30"
                                    viewBox="0 0 33 30" fill="none">
                                    <path
                                        d="M18.8974 0.747714C10.8752 0.526047 4.30301 7.00188 4.30301 14.9977H1.48186C0.772628 14.9977 0.425894 15.8527 0.930234 16.3435L5.32745 20.7769C5.64266 21.0935 6.13124 21.0935 6.44646 20.7769L10.8437 16.3435C11.3323 15.8527 10.9855 14.9977 10.2763 14.9977H7.45514C7.45514 8.82271 12.467 3.83521 18.6452 3.91438C24.5081 3.99355 29.4412 8.94938 29.52 14.8394C29.5988 21.0302 24.6342 26.081 18.4876 26.081C15.9501 26.081 13.6018 25.2102 11.742 23.7377C11.1116 23.2469 10.229 23.2944 9.66162 23.8644C8.99968 24.5294 9.04696 25.6535 9.78771 26.2235C12.1833 28.1235 15.1936 29.2477 18.4876 29.2477C26.4467 29.2477 32.8928 22.6452 32.6721 14.586C32.4673 7.16021 26.2891 0.953547 18.8974 0.747714ZM18.0936 8.66438C17.4474 8.66438 16.9115 9.20271 16.9115 9.85188V15.6785C16.9115 16.2327 17.211 16.7552 17.6838 17.0402L22.6011 19.9694C23.1685 20.3019 23.8935 20.1119 24.2244 19.5577C24.5554 18.9877 24.3663 18.2594 23.8147 17.9269L19.2756 15.2194V9.83605C19.2756 9.20271 18.7397 8.66438 18.0936 8.66438Z"
                                        fill="#ffffff" />
                                </svg>
                            </i>
                            <span class="item-name">Riwayat</span>
                        </a>
                    </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


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
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search  -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <form action="{{ route('searching', ['daftar' => 'query']) }}" method="GET">
                            <input type="text" class="form-control" name="query"
                                value="{{ request('query') }}" placeholder="Cari...">
                            </form>
                        </li>

                      

                             <div class="topbar-divider d-none d-sm-block"></div>
                            <!-- Start Profile-->
                            <li class="nav-item dropdown">
                                <a class="nav-link py-0 d-flex align-items-center" href="#" id="userDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                    <div class="caption ms-3 d-none d-md-block ">
                                        <h6 class="mb-0 caption-title">{{ Auth::user()->name }}</h6>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <form action="{{ route('logout') }}" method="GET">
                                        @csrf
                                        <li><button type="submit" class="dropdown-item">logout</button></li>
                                    </form>
                                </ul>
                            </li>
                    </ul>

                </nav>
                @yield('content')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">
    <div class="mt-4">
        <h3 class="card-title">Detail</h3>
    </div>
    <div class="row">
        <div class="col-lg-6 mt-4">
            <div class="card">
                <div class="profile-img21 d-flex justify-content-center align-items-center">
                    <!-- tempat foto -->
                    <img src="{{ asset('Storage/' . $kamar->foto) }}"
                    class="img-fluid avatar-170 position-bottom" alt="profile-image">
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card" style="max-height: 200px; overflow-y: scroll;">
                    <div class="card-header">
                        <h5 class="card-title">Komentar</h5>
                    </div>
                    <div class="card-body">
                        @if ($ulasan->isEmpty())
                            <p>Belum ada ulasan .</p>
                        @else
                            @foreach ($ulasan as $u)
                                <div class="media mb-0">
                                    <div class="media-body">
                                        <h5 class="mb-0">{{ $u->user->name }}</h5>
                                        <p class="mt-1">{{ $u->komentar }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 mt-4">
            <div class="card">
                <div class="card-body">
                    <!-- Isi card deskripsi di sini -->
                    <form method="POST" action="/booking" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $kamar->id }}" name="id_kamar">
                        <h4 class="card-title">{{$kamar->jenis_kamar}}</h4>
                        <p>{{$kamar->deskripsi}}</p>
                        <p>Rp. {{ number_format($kamar->harga, 0, ',', '.')}} </p>
                    <d class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Masuk</label>
                                <input type="date" name="checkin_date" class="form-control" min="{{ date('Y-m-d') }}">
                                @if ($errors->has('checkin_date'))
                                    <span class="text-danger">{{ $errors->first('checkin_date') }}</span>
                                 @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Keluar</label>
                                <input type="date" name="checkout_date" class="form-control" min="{{ date('Y-m-d') }}">
                                @if ($errors->has('checkout_date'))
                                    <span class="text-danger">{{ $errors->first('checkout_date') }}</span>
                                 @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="number" name="no_telp" class="form-control">
                                @if ($errors->has('no_telp'))
                                    <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                                 @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>KTP</label>
                                <input type="file" name="ktp" class="form-control">
                                @if ($errors->has('ktp'))
                                    <span class="text-danger">{{ $errors->first('ktp') }}</span>
                                 @endif
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="input">Alamat</label>
                          <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat Anda"></textarea>
                          @if ($errors->has('alamat'))
                                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                 @endif
                        </div>

                        <div class="form-group">
                            <label for="input">Pilih jenis bank</label>
                            <select name="transaksiadmin_id" class="form-control" id="transaksiadmin_id">
                            @foreach ($transaksi as $data)
                                <option value="{{ $data->id }}" {{ $data->id === old('tujuan
                                    ') ? 'selected' : '' }}>
                                    {{ $data->tujuan }}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('transaksiadmin_id'))
                                        <span class="text-danger">{{ $errors->first('transaksiadmin_id') }}</span>
                                     @endif
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                            @foreach ($transaksi as $data)
                            <div class="col-md-6 bank-input" id="bank-input-{{ $data->id }}" style="display: none;">
                                <div class="form-group">
                                    <label for="input">No rekening {{ $data->keterangan }}</label>
                                    <input type="hidden" name="keterangan{{ $data->id }}" class="form-control">
                                </div>
                            </div>
                        @endforeach
                            </div>
                                </div>

                        <div class="form-group">
                            <label class="text-bold">Masukkan Bukti Pembayaran Anda</label>
                            <input type="file" name="fotobukti" class="form-control" id="foto">
                            @if ($errors->has('fotobukti'))
                                    <span class="text-danger">{{ $errors->first('fotobukti') }}</span>
                                 @endif
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Booking</button>
                        </form>
                </div>
            </div>
        </div>
      
    </div>
</div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Website Pemesanan Hotel 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#transaksiadmin_id').on('change', function() {
            var selectedBankId = $(this).val();

            // Hide all bank input fields
            $('.bank-input').hide();

            // Show the selected bank's input field
            $('#bank-input-' + selectedBankId).show();
        });
    });
</script>


</body>

</html>
