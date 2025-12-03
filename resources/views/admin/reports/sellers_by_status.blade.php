<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Daftar Akun Penjual - Status</title>
    <style>
        body{font-family: DejaVu Sans, sans-serif; font-size:12px}
        table{width:100%;border-collapse:collapse}
        th,td{border:1px solid #000;padding:6px;text-align:left}
        th{background:#f0f0f0}
        .muted{color:#666;font-size:11px}
    </style>
</head>
<body>
    <h3>Platform - Laporan Daftar Akun Penjual Berdasarkan Status</h3>
    <p class="muted">Tanggal dibuat: {{ $generated_at->format('d-m-Y H:i') }} oleh {{ $generated_by }}</p>

    <table>
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th>Nama User</th>
                <th>Nama PIC</th>
                <th>Nama Toko</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellers as $i => $seller)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $seller->email ?? '-' }}</td>
                <td>{{ $seller->pic_name ?? '-' }}</td>
                <td>{{ $seller->store_name ?? '-' }}</td>
                <td>{{ $seller->status === 'approved' ? 'Aktif' : 'Tidak Aktif' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
