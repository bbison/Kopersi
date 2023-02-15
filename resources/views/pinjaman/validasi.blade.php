@extends('layouts.sidebar')
@section('body')
<div class="d-flex justify-content-center">
    <main class="col-11">
        <div class="text-center fs-3 mt-2 mb-3"> PINJAMAN</div>
        <div class="col-4 m-2">
            <input type="text" class="form-control" onkeyup="filter(this.value)" name="" id="" placeholder="cari Nama, ID PINJAMAN, atau Status Pinjaman">
        </div>
        <div id="hasil">
            
            <table class="table col-7">
                <tr class="text-center">
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>ID PINJAMAN</th>
                    <th>TOTAL PINJAMAN</th>
                    <th>LAMA PINJAMAN</th>
                    <th>BUNGA</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
                @foreach ($pinjaman as $p)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->id }}</td>
                    <td>@currency($p->nominal_pinjaman)</td>
                    <td>{{ $p->lama_pinjaman }} Bulan</td>
                    <td>{{ $p->bunga }} %</td>
                    <td> @if ($p->status_pinjaman == 'Menunggu Verifikasi')
                        <button class="btn btn-warning text-white">{{ $p->status_pinjaman }}</button> 
                    @elseif($p->status_pinjaman == 'Aktif')
                    <button class="btn btn-danger text-white">{{ $p->status_pinjaman }}</button> 
                    @elseif($p->status_pinjaman == 'Selesai')
                    <button class="btn btn-primary text-white">{{ $p->status_pinjaman }}</button> 
                    @endif
                        {{-- <button class="btn btn-warning text-white">Aktif</button>  --}}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="/validasi-pinjaman/{{ $p->id }}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Validasi</button>
                                    </form>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">Lihat Detail</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                    
                @endforeach
              
            </table>
        </div>
       </main>
</div>
<script>
      function filter(str) {
        if(str == ""){
            let st = "PaRaMeTeR"
            var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("hasil").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "/ajax/validasi/"+st, true);
                xmlhttp.send();
        }
        else{
            var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("hasil").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "/ajax/validasi/"+str, true);
                xmlhttp.send();

        }
           
              
            
        
        }
</script>
  
@endsection
