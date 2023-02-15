@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-11 row">
            <div class="col-8">
                @if ($pinjaman_aktif->count() != 0)
                    <div class="fs-3 mt-3 text-center">Pinjaman Aktif</div>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <table class="table col-7">
                            <tr class="text-center">
                                <th>Tagihan</th>
                                <th>Jatuh Tempo</th>
                                <th>Total Tagihan</th>
                                <th>Status</th>
                            </tr>
                            @foreach ($pinjaman_aktif as $angsuran)
                                @foreach ($angsuran->angsuran as $angsuran)
                                    <tr class="text-center">
                                        <td>Bulan {{ $angsuran->tagihan_angsuran }}</td>
                                        <td>{{ $angsuran->jatuh_tempo }}</td>
                                        <td>@currency(intval($angsuran->tagihan_angsuran))</td>
                                        <td>
                                            @if ($angsuran->status == 'Belum Bayar')
                                                <div class="btn btn-warning text-white"> <strong>Belum Bayar</strong> </div>
                                            @elseif ($angsuran->status == 'Sudah Bayar')
                                                <div class="btn btn-success text-white"> <strong>Lunas</strong> </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                    </div>
                @elseif($pinjaman_tunggu->count() == 1)
                    <div class="">Pinjaman Menunggu verifikasi</div>
                @else
                    <div class="text-center fs-3 mt-3">Belum Ada Pinjaman</div>
                @endif
            </div>




            <div class="col-4">
                <div class="ms-3 fs-3 mt-3">Riwayat Pinjaman</div>
                <hr>
                @if (auth()->user()->pinjaman->count() <= 0)
                    <div class="fs-5">
                        Belum Ada Riwayat Pinjaman
                    </div>                    
                @else
                <table class="table">
                    <tr>
                        <th>Nominal</th>
                        <th>ID Pinjaman</th>
                        <th>Status</th>
                    </tr>
                    @foreach (auth()->user()->pinjaman as $p)
                        <tr>
                            <td>@currency($p->nominal_pinjaman)</td>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->status_pinjaman }}</td>
                        </tr>
                    @endforeach
                </table>

                @endif
              
            </div>

        </main>

    </div>
@endsection
