@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center mt-3">
        <main class="col-11">
            <table class="table col-6">
                <tr class="text-center table-secondary">
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>TAHUN</th>
                    <th>BESAR SHU</th>
                </tr>
                @foreach ($penerima as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->created_at }}</td>
                        <td>{{ $p->nominal }}</td>
                    </tr>
                
                @endforeach
            </table>
        </main>
    </div>
@endsection
