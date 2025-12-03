<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Seller Reports - MarketPlace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body{font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial}</style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-purple-800 text-white flex flex-col justify-between">
            <div class="p-6">
                <h1 class="text-2xl font-bold">MarketPlace</h1>
                <p class="text-purple-200 text-sm mt-2">Seller Panel</p>
            </div>
            <nav class="mt-8 flex-1">
                <a href="{{ route('seller.dashboard') }}" class="block py-2 px-6 hover:bg-purple-700 rounded">&larr; Kembali ke Dashboard</a>
                <a href="{{ route('seller.reports.index') }}" class="block py-2 px-6 font-semibold bg-purple-900 rounded mt-2">Laporan Produk</a>
            </nav>
            <div class="p-6 text-xs text-purple-200">&copy; {{ date('Y') }} MarketPlace</div>
        </div>
        <!-- Main Content -->
        <main class="flex-1 flex flex-col items-center justify-center">
            <div class="max-w-2xl w-full p-8">
                <h2 class="text-2xl font-bold mb-4 text-center">Pilih Laporan yang Akan Diunduh</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="font-semibold mb-2">Laporan Produk Berdasarkan Stock</h3>
                            <p class="text-sm text-gray-600">Daftar produk toko Anda diurutkan berdasarkan stock secara menurun.</p>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('seller.report.stock') }}" class="inline-block bg-purple-600 text-white px-4 py-2 rounded">Download PDF</a>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="font-semibold mb-2">Laporan Produk Berdasarkan Rating</h3>
                            <p class="text-sm text-gray-600">Daftar produk toko Anda diurutkan berdasarkan rating secara menurun.</p>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('seller.report.rating') }}" class="inline-block bg-purple-600 text-white px-4 py-2 rounded">Download PDF</a>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="font-semibold mb-2">Laporan Produk Segera Dipesan</h3>
                            <p class="text-sm text-gray-600">Produk dengan stock kurang dari 2, diurutkan berdasarkan kategori dan nama produk.</p>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('seller.report.reorder') }}" class="inline-block bg-purple-600 text-white px-4 py-2 rounded">Download PDF</a>
                        </div>
                    </div>
                </div>
                <div class="mt-6 text-sm text-gray-500 text-center">
                    <p>Note: PDF akan dibuat dan diunduh langsung. Pastikan data produk sudah tersedia pada database.</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
