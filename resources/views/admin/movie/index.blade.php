@extends('templates.app')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show alert-top-right" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container mt-5">
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.movies.export') }}" class="btn btn-secondary me-2">Export (.xlsx)</a>
            <a href="{{ route('admin.movies.create') }}" class="btn btn-success">
                Tambah Data
            </a>
        </div>
        <h5>Data Film</h5>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Poster</th>
                <th>Judul Film</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            @foreach ($movies as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        {{-- Memunculkan gambar yang diupload --}}
                        <img src="{{ asset('storage/' . $item['poster']) }}" alt="Poster Film" width="120">
                    </td>
                    <td>{{ $item['title'] }}</td>
                    <td>
                        @if ($item['actived'] == 1)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="d-flex justify-content-center gap-2">
                        {{-- onclick() : menjalankan fungsi javascript ketika komponen di klik --}}
                        <button class="btn btn-secondary" onclick="showModal({{ $item }})">Detail</button>
                        <a href="{{ route('admin.movies.edit', $item['id']) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.movies.delete', $item['id']) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        {{-- Jika actived true, munculkan opsi untuk non-aktif film --}}
                        @if ($item['actived'] == 1)
                            <a href="{{ route('admin.movies.inactive', $item['id']) }}"
                                class="btn btn-warning">Non-Aktif</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        {{-- Modal --}}
        <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Film</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalDetailBody">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function showModal(item) {
            // console.log(item);
            // Menghubungkan fungsi php asset, digabungkan dengan data yang diambil js ( item )
            let image = "{{ asset('storage/') }}" + "/" + item.poster;
            // backtip (``) : membuat string yang bisa di enter
            let content = `
                <div class="d-block mx-auto my-3 text-center">
                    <img src="${image}" alt="Poster Film" width="180">
                </div>
                <ul>
                    <li>Judul Film : ${item.title}</li>
                    <li>Durasi : ${item.duration}</li>
                    <li>Genre : ${item.genre}</li>
                    <li>Sutradara : ${item.director}</li>
                    <li>Rating Usia : <span class="badge badge-danger">${item.age_rating}+<span></li>
                    <li>Sinopsis : <br>${item.description}</li>
                </ul>
            `;
            // memanggil variable pada tanda `` pakai $()
            // memanggil element HTML yang akan disimpan konten diatas -> document.querySelector
            // innerHTML -> menyimpan konten HTML ke dalam element
            document.querySelector('#modalDetailBody').innerHTML = content;
            // menampilkan modal
            new bootstrap.Modal(document.querySelector('#modalDetail')).show();
        }
    </script>
@endpush
