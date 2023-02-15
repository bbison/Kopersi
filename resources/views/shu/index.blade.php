@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-11">
            <div class="d-flex justify-content-center mt-3">

                <div class="col-8">
                    <div class="h3 text-center">Sisa Hasil Usaha</div>
                    <button type="button" class="btn btn-success text-white col-2 mb-3" data-bs-toggle="modal"
                        data-bs-target="#tambah">Tambah
                        SHU
                    </button>
                    <!-- Modal tambah shu -->
                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form action="{{ route('shu.tambah') }}" method="post">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah SHU</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">BESAR SHU</label>
                                            <input type="text" name="besarshu" placeholder="Contoh: 5000000"
                                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (session('pesan'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        {{ session('pesan') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                    <table class="table col-6">
                        <tr class="text-center table-secondary">
                            <th>NO</th>
                            <th>ID SHU</th>
                            <th>TAHUN</th>
                            <th>BESAR SHU</th>
                            <th>ACION</th>
                        </tr>
                        @foreach ($shu as $shu)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $shu->id }}</td>
                                <td>{{ $shu->created_at }}</td>
                                <td>@currency($shu->besar_shu)</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            </li>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $shu->id }}">Edit</button>
                                            </li>
                                            <li>
                                                <form action="/shu/{{ $shu->id }}" method="post" class="">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">Hapus</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('shu.bagi') }}" method="post" class="">
                                                    @csrf
                                                    <input type="hidden" value="{{ $shu->id }}" name="id_shu">
                                                    <button class="dropdown-item" type="submit">Bagi SHU</button>
                                                </form>
                                            </li>
                                            <li><a class="dropdown-item" href="/shu-penerima/{{ $shu->id }}">Penerima SHU</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal edit shu -->
                            <div class="modal fade" id="edit{{ $shu->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="{{ route('shu.edit') }}" method="post">
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT SHU</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">BESAR SHU</label>
                                                    <input type="text" name="besarshu" placeholder="Contoh: 5000000"
                                                        class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" value="{{ $shu->besar_shu }}">
                                                </div>
                                                <input type="hidden" value="{{ $shu->id }}" name="idshu"
                                                    id="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach

                    </table>
                </div>

            </div>
        </main>

    </div>
@endsection
