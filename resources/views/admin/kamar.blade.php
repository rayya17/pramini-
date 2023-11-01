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

    {{-- tambah data kamar --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow rounded">
          <div class="card-body">
            <a class="btn btn-md btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah">TAMBAH</a>
            <table id="jstabel" class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Foto</th>
                  <th scope="col">Jenis Kamar</th>
                  <th scope="col">Deskripsi</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($kamars as $kamar)
                <tr>
                  <td>{{ $kamar->no_kamar }}</td>
                  <td class="text-center"><img src="{{ asset('storage/' . $kamar->foto) }}" class="rounded" style="width:150px"></td>
                  <td>{{ $kamar->jenis_kamar }}</td>
                  <td>{{Str::limit ($kamar->deskripsi, 10) }}</td>
                  <td>{{ 'RP ' . number_format($kamar->harga, 0, ',', '.') }}</td>
                  <td>
                    <div class="d-flex">
                      <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $kamar->id }}">
                        <i class="bi bi-pencil-square"></i>
                      </button>

                      {{-- tombol edit modal --}}
                      <div class="modal fade" id="edit{{ $kamar->id }}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Edit Data</h5>
                              <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('kamar.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                  <label for="no">No kamar</label>
                                  <input type="text" class="form-control" id="no_kamar" name="no_kamar" value="{{ $kamar->no_kamar }}">
                                  @error('no_kamar')
                                  <p class="text-danger">
                                    {{ $message }}
                                  </p>
                                  @enderror
                                </div>
                                <div class="form-group">
                                  <label for="jenis_kamar">Jenis Kamar</label>
                                  <input type="no" class="form-control" id="jenis_kamar" name="jenis_kamar" value="{{ $kamar->jenis_kamar }}">
                                  @error('jenis_kamar')
                                  <p class="text-danger">
                                    {{ $message }}
                                  </p>
                                  @enderror
                                </div>
                                <div class="form-group">
                                  <label for="deskripsi">Deskripsi</label>
                                  <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $kamar->deskripsi }}</textarea>
                                  @error('deskripsi')
                                  <p class="text-danger">
                                    {{ $message }}
                                  </p>
                                  @enderror
                                </div>
                                <div class="form-group">
                                  <label for="harga">Harga</label>
                                  <input type="number" class="form-control" id="harga" name="harga" value="{{ $kamar->harga }}">
                                  @error('harga')
                                  <p class="text-danger">
                                    {{ $message }}
                                  </p>
                                  @enderror
                                </div>
                                <div class="form-group">
                                  <label for="foto">Foto</label>
                                  <input type="file" class="form-control" id="foto" name="foto" value="{{ $kamar->foto }}">
                                  <img src="{{ asset('storage/' . $kamar->foto) }}" class="rounded mt-3" style="width:150px">
                                  @error('foto')
                                  <p class="text-danger">
                                    {{ $message }}
                                  </p>
                                  @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    </form>
                    {{-- edit modal end --}}
                    <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" id="delete-form-{{ $kamar->id }}">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-outline-danger" onclick="hapus({{ $kamar->id }})">
                        <i class="bi bi-trash-fill"></i>
                      </button>
                    </form>

                  </td>
                </tr>
                @empty
                <div class="alert alert-danger mt-2">
                  Tidak Ada Kamar
                </div>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    {{-- tambah modal --}}
    <div class="modal fade" tabindex="-1" id="tambah" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kamar</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="no">No</label>
                <input type="text" class="form-control" id="no" name="no_kamar">
                @error('no_kamar')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="inputfoto">Foto</label>
                <input type="file" class="form-control" id="inputfoto" name="foto">
                @error('foto')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="inputjenis_kamar">Jenis Kamar</label>
                <input type="text" class="form-control" id="inputjenis_kamar" name="jenis_kamar">
                @error('jenis_kamar')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="inputdeskripsi">Deskripsi</label>
                <textarea class="form-control" id="inputdeskripsi" name="deskripsi"></textarea>
                @error('deskripsi')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="inputharga">Harga</label>
                <input type="number" class="form-control" id="inputharga" name="harga">
                @error('harga')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- tutup modal tambah --}}
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
                    "sInfoFiltered": "(disaring dari MAX data keseluruhan)",
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
    <script>
      function hapus(id) {
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
            document.getElementById('delete-form-' + id).submit();
          }
        });
      }
    </script>