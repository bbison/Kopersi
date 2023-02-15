@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-11">
            <div class="ms-3 btn btn-success mt-3">Total Simpanan Pokok @currency(auth()->user()->simpanan_pokok) </div>
            <div class="ms-3 btn btn-success mt-3">Total Simpanan Wajib @currency(auth()->user()->simpanan_wajib) </div>
            <div class="ms-3 btn btn-success mt-3">Total Simpanan suka Rela @currency(auth()->user()->simpanan_sukarela) </div>
            <div class="d-flex justify-content-center mt-3">
                <div class="row col-12">
                    <div class="col-6">
                        <div class="h3 text-center">Simpanan Wajib</div>
                        <table class="table col-6">
                            <tr class="text-center table-secondary">
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Simpanan Wajib</th>
                            </tr>
                            @foreach (auth()->user()->simpananWajib as $item)
                            <tr class="text-center">
                                <td>{{ $item->created_at }}</td>
                                <td></td>
                                <td>@currency($item->simpanan_wajib)</td>
                            </tr>
                            @endforeach
                            <tr class="text-center table-secondary">
                                <th>Total</th>
                                <th></th>
                                <th>@currency(auth()->user()->simpanan_wajib )</th>
                            </tr>
                           
                        </table>
                    </div>
                    <div class="col-6">
                        <div class="h3 text-center">Simpanan Suka Rela</div>
                        <table class="table col-6">
                            <tr class="text-center table-secondary">
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Simpanan Wajib</th>
                            </tr>
                            @foreach (auth()->user()->simpanan as $item)
                            <tr class="text-center">
                                <td>{{ $item->created_at }}</td>
                                <td></td>
                                <td>@currency($item->simpanan_suka_rela)</td>
                            </tr>
                            @endforeach
                            <tr class="text-center table-secondary">
                                <th>Total</th>
                                <th></th>
                                <th>@currency(auth()->user()->simpanan_sukarela )</th>
                            </tr>
                        </table>
                    </div>

                    <div class="col-6">
                        <div class="h3 text-center">Sisa Hasil Usaha</div>
                        <table class="table col-6">
                            <tr class="text-center table-secondary">
                                <th>Tahun</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                            </tr>
                            @foreach (auth()->user()->pembagian_shu as $item)
                            <tr class="text-center">
                                <td>{{ $item->created_at }}</td>
                                <td></td>
                                <td>@currency($item->nominal)</td>
                            </tr>
                            @endforeach
                            <tr class="text-center table-secondary">
                                <th>Total</th>
                                <th></th>
                                <th>@currency(auth()->user()->simpanan_sukarela )</th>
                            </tr>
                        </table>
                    </div>

                </div>

            </div>
        </main>

    </div>
@endsection
