<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Daftar Toko Berdasarkan Propinsi</title>
    <style>
        body{font-family: DejaVu Sans, sans-serif; font-size:12px}
        table{width:100%;border-collapse:collapse}
        th,td{border:1px solid #000;padding:6px;text-align:left}
        th{background:#f0f0f0}
        .muted{color:#666;font-size:11px}
    </style>
</head>
<body>
    <h3>Platform - Laporan Daftar Toko Berdasarkan Lokasi Propinsi</h3>
    <p class="muted">Tanggal dibuat: {{ $generated_at->format('d-m-Y H:i') }} oleh {{ $generated_by }}</p>

    <table>
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th>Nama Toko</th>
                <th>Nama PIC</th>
                <th>Propinsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellers as $i => $seller)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $seller->store_name ?? '-' }}</td>
                <td>{{ $seller->pic_name ?? '-' }}</td>
                <td>{{ $seller->province ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
