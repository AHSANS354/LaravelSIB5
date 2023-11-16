<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tes PDF</title>
</head>
<body>
    <h3 align="center">Data Produk</h3>
    <table border="1" cellpadding="10" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Min Stok</th>
                <th>Jenis Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $k)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$k->kode}}</td>
                <td class="text-truncate">{{$k->nama}}</td>
                <td>{{$k->harga_jual}}</td>
                <td>{{$k->harga_beli}}</td>
                <td>{{$k->stok}}</td>
                <td>{{$k->min_stok}}</td>
                <td>{{$k->jenis}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>