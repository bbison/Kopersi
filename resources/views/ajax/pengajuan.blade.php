<table class="table-bordered border-secondary">
    <tr class="text-center">
        <th>Jatuh Tempo</th>
        <th>Tagihan</th>
    </tr>
    @foreach ($data as $item)
    <tr class="text-center">
        <td> {{ $item }}</td>
        <td>@currency($tagihan)</td>
    </tr>
        
    @endforeach
</table>