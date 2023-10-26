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

  <div class="row">
    <div class="col-md-12">
      <div class="card border-0 shadow rounded">
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th scope="col">No Telpon</th>
                <th scope="col">Alamat</th>
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
                    {{ $user->alamat }}
                  </td>
                  <td class="text-center">
                    <img src="{{ asset('storage/' . $user->ktp) }}" class="rounded" style="width:150px">
                  </td>
                  <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $user->id }}">
                        Buka Modal
                    </button>

                    <div class="modal fade" id="modal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal {{ $user->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Isi modal di sini...</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="/terimapesanan" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        <input type="hidden" name="id_pengguna" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-success">Terima</button>
                                    </form>
                                    <form action="/tolakpesanan" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        <input type="hidden" name="id_pengguna" value="{{ $user->id }}">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tolak</button>
                                    </form>
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
  <div>

  </div>
@endsection
