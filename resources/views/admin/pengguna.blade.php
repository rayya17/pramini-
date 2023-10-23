@extends('admin.dashboardadmin')
@section('content')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  @include('alert')


  {{-- tambah data pengguna --}}
  <div class="row">
    <div class="col-md-12">
      <div class="card border-0 shadow rounded">
        <div class="card-body">
          <a class="btn btn-md btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambah">TAMBAH</a>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th scope="col">No Telpon</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Ktp</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($penggunas as $pengguna)
                <tr>
                  <td>{{ $pengguna->nama }}</td>
                  <td>{{ $pengguna->no_telp }}</td>
                  <td>{{ $pengguna->alamat }} </td>
                  <td>{{ $pengguna->no_ktp }}</td>
                    {{-- tombol edit modal --}}
                    <div class="modal fade" id="edit{{ $pengguna->id }}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('pengguna.update', $pengguna->id) }}"
                              method="POST"enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                  value="{{ $pengguna->nama }}">
                                @error('nama')
                                  <p class="text-danger">
                                    {{ $message }}
                                  </p>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="no_telp">No Telpon</label>
                                <input type="number" class="form-control" id="no_telp" name="no_telp"
                                  value="{{ $pengguna->no_telp }}">
                                @error('no_telp')
                                  <p class="text-danger">
                                    {{ $message }}
                                  </p>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="alamat">alamat</label>
                                <input type="number" class="form-control" id="alamat" name="alamat"
                                value="{{ $pengguna->alamat }}">
                                <textarea name="alamat" input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value=""placeholder="Masukkan Nama Alamat">{{ old('alamat, $customer->alamat') }}</textarea>
                                @error('alamat')
                                  <p class="text-danger">
                                    {{ $message }}
                                  </p>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="no_ktp">No Ktp</label>
                                <input type="number" class="form-control" id="no_ktp" name="no_ktp"
                                  value="{{ $pengguna->no_ktp }}">
                                @error('no_ktp')
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
                    </form>
                    {{-- edit modal end --}}

                    <div class="d-flex gap-3">
                      <button class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#edit{{ $pengguna->id }}">edit</button>
                      <form action="{{ route('pengguna.destroy', $pengguna->id) }}" method="POST"
                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">hapus</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <div class="alert alert-danger mt-2">
                  Tidak Ada Pengguna
                </div>
              @endforelse
            </tbody>
          </table>
          {{-- tambah modal --}}
          <div class="modal fade" tabindex="-1" id="tambah" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('pengguna.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" name="nama">
                      @error('nama')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror
                    <div class="form-group">
                      <label for="no_telp">No Telpon</label>
                      <input type="number" class="form-control" id="no_ktp" name="no_telp">
                      @error('no_telp')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <input type="text" class="form-control" id="alamat" name="jumlah">
                      <textarea name="alamat" input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value=""placeholder="Masukkan Nama Alamat">{{ old('alamat, $customer->alamat') }}</textarea>
                      @error('alamat')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="no_ktp">No Ktp</label>
                      <input type="number" class="form-control" id="no_ktp" name="no_ktp">
                      @error('no_ktp')
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
