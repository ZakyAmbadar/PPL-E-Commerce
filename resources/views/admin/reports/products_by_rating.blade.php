<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Daftar Produk Berdasarkan Rating</title>
    <style>
        body{font-family: DejaVu Sans, sans-serif; font-size:12px}
        table{width:100%;border-collapse:collapse}
        th,td{border:1px solid #000;padding:6px;text-align:left}
        th{background:#f0f0f0}
        .muted{color:#666;font-size:11px}
    </style>
</head>
<body>
    <h3>Platform - Laporan Daftar Produk Berdasarkan Rating</h3>
    <p class="muted">Tanggal dibuat: {{ $generated_at->format('d-m-Y H:i') }} oleh {{ $generated_by }}</p>

    <table>
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Rating</th>
                <th>Nama Toko</th>
                <th>Propinsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $i => $product)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ number_format($product->reviews_avg_rating ?? 0, 2) }}</td>
                <td>{{ $product->seller->store_name ?? '-' }}</td>
                <td>{{ $product->seller->province ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
