@php
    $nama = "Budi";
    $nilai = 60.00;
@endphp

@if($nilai >= 60) @php $ket = "lulus"; @endphp
@else @php $ket = "tidak lulus"; @endphp
@endif

Siswa {{$nama}} dengan nilai {{$nilai}} dinyatakan {{$ket}}