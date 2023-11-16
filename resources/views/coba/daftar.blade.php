@php
    $no = 1;

    $s1 = ['nama' => 'Fawwaz', 'nilai' => 65];
    $s2 = ['nama' => 'Aji', 'nilai' => 75];
    $s3 = ['nama' => 'Faza', 'nilai' => 85];
    $s4 = ['nama' => 'Fauzan', 'nilai' => 95];
    $s5 = ['nama' => 'Burhan', 'nilai' => 55];

    $judul = ['No','Nama','Nilai','Keterangan'];

    $siswa = [$s1, $s2, $s3, $s4, $s5];
@endphp

<table border="1" align="center" cellpading="10">
    <thead>
        <tr>
            @foreach($judul as $jdl)
                <th>{{ $jdl }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($siswa as $s)
        @php
            $ket = ($s['nilai'] >= 60) ? 'Lulus' : 'Tidak Lulus';
        @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $s['nama'] }}</td>
            <td>{{ $s['nilai'] }}</td>
            <td>{{ $ket }}</td>
        </tr>
    @endforeach
    </tbody>
</table>