@extends('admin.dashboardadmin')
    @section('content')
    <title>Pemesanan hotel - Kamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    @include('alert')

<div class="row">
  <div class="col-md-12">
    <div class="card border-0 shadow rounded">
      <div class="card-body">
        <table id="jstabel" class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Nama</th>
              <th scope="col">No Telpon</th>
              <th scope="col">Alamat</th>
              <th scope="col">Check In - check Out</th>
              <th scope="col">Ktp</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($penggunas as $user)
            <tr>
              <td>
                {{ $user->user->name }}
              </td>
              <td>
                {{ $user->no_telp }}
              </td>
              <td>
                {{Str::limit($user->alamat, 20)  }}
              </td>
              <td>
                {{ \Carbon\Carbon::parse($user->checkin_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($user->checkout_date)->format('d M Y') }}
              </td>
              <td class="text-center">
                <img src="{{ asset('storage/' . $user->ktp) }}" class="rounded" style="width:150px">
              </td>
              <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $user->id }}">
                  Detail
                </button>

                <div class="modal fade" id="modal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <img src="{{ asset('storage/' . $user->fotobukti) }}" class="rounded" style="width:300px">
                      </div>
                      <div class="modal-footer">
                        <form action="/terimapesanan" method="POST">
                          @method('PATCH')
                          @csrf
                          <input type="hidden" name="id_pengguna" value="{{ $user->id }}">
                          <button type="submit" class="btn btn-success">Terima</button>
                        </form>
                        <form action="/tolakpesanan" method="POST" id="tolakForm">
                            @method('PATCH')
                            @csrf
                            <input type="hidden" name="id_pengguna" value="{{ $user->id }}">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btnTolak">Tolak</button>
                        </form>

                        <script>
                            document.getElementById("btnTolak").addEventListener("click", function() {
                                Swal.fire({
                                    text: 'Apakah Anda yakin ingin menolak pesanan ini?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Ya, Tolak',
                                    cancelButtonText: 'Batal',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById("tolakForm").submit();
                                    }
                                });
                            });
                        </script>

                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            @empty
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  jQuery.noConflict();

  jQuery(document).ready(function($) {
    $('#jstabel').DataTable({
      "lengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      "pageLength": 5,

      "order": [],

      "ordering": false,

      "language": {
        "sProcessing": "Sedang memproses...",
        "sZeroRecords": "Tidak ditemukan Data",
        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
        "sInfoFiltered": "(tidak menampilkan data apapun)",
        "sInfo": "Menampilkan 1 hingga 1 dari 1 entri",
        "sInfoPostFix": "",
        "sSearch": "Cari :",
        "sUrl": "",
        "oPaginate": {
          "sFirst": "Pertama",
          "sPrevious": "&#8592;",
          "sNext": "&#8594;",
          "sLast": "Terakhir"
        }
      }
    });
  });
</script>
