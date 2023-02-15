<table class="table col-7 mt-3">
    @foreach ($data as $user)
        <h3>Nama : {{ $user->user->name }}</h3>
        <h3>ID Pinjaman : {{ $user->id }}</h3>
    @endforeach
    <hr>
    <tr class="text-center">
        <th>Jatuh Tempo</th>
        <th>Tagihan Ke</th>
        <th>Tanggal Pelunasan</th>
        <th>Total Tagihan</th>
        <th>Status</th>
    </tr>
    @foreach ($data as $data)
        @foreach ($data->angsuran as $angsuran)
            <tr class="text-center">
                <td>{{ $angsuran->jatuh_tempo }}</td>
                <td>{{ $angsuran->bulan_angsuran }}</td>
                <td>
                    @if ($angsuran->updated_at == $angsuran->created_at)
                   -
                   @else
                   {{ $angsuran->updated_at }}
                    @endif
                </td>
                <td>@currency(intval(intval($data->nominal_pinjaman) / intval($data->lama_pinjaman)))</td>
                <td>
                    @if ($angsuran->status == 'Belum Bayar')
                        <div class="btn btn-warning text-white"> <strong>Belum Bayar</strong> </div>
                        @if (intval($angsuran->bulan_angsuran)==$ke)
                            <small class="text-danger d-block">*Pembayaran ini</small>
                        @endif
                    @elseif ($angsuran->status == 'Sudah Bayar')
                        <div class="btn btn-success text-white"> <strong>Lunas</strong> </div>
                    @endif
                </td>
            </tr>
        @endforeach
    @endforeach
</table>
