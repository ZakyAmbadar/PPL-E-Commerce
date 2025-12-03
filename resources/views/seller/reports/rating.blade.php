<!DOCTYPE html>
<html>
<head>
    <title>Laporan Daftar Produk Berdasarkan Rating</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 6px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Daftar Produk Berdasarkan Rating</h2>
    <p>Tanggal dibuat: {{ $date }} oleh {{ $user->name }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $i => $product)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>Rp{{ number_format($product->price,0,',','.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ number_format($product->reviews->avg('rating'),2) ?? '-' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
