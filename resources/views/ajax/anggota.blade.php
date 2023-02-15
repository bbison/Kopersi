<table class="table col-7">
    <tr class="text-center">
        <th>NO</th>
        <th>NAMA ANGGOTA</th>
        <th>TANGGAL MASUK</th>
        <th>SIMPANAN WAJIB</th>
        <th>SIMPANAN POKOK</th>
        <th>SIMPANAN SUKARELA</th>
        <th>ACTION</th>
    </tr>
    @foreach ($anggotas as $anggota)
    <tr class="text-center">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $anggota->name }}</td>
        <td>{{ $anggota->created_at }}</td>
        <td>{{ $anggota->simpanan_wajib }}</td>
        <td>{{ $anggota->simpanan_pokok }}</td>
        <td>{{ $anggota->simpanan_sukarela }}</td>
        <td><div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Action
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/anggota/{{ Crypt::encryptString($anggota->id) }}">Lihat Detail</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div></td>
    </tr>
        
    @endforeach
</table>