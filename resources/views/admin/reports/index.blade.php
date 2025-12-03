<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Reports - Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body{font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial}</style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <div class="w-64 bg-blue-800 text-white p-6">
            <h1 class="text-2xl font-bold">MarketPlace</h1>
            <p class="text-blue-200 text-sm mt-2">Admin Platform</p>
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="block py-2">Dashboard</a>
                <a href="{{ route('admin.reports.index') }}" class="block py-2 font-semibold">View Reports</a>
            </nav>
        </div>

        <main class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold mb-4">Pilih Laporan yang Akan Diunduh</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="font-semibold">Laporan Penjual - Status</h3>
                        <p class="text-sm text-gray-600 mt-2">Daftar akun penjual berdasarkan status (Aktif dulu).</p>
                        <div class="mt-4">
                            <a href="{{ route('admin.reports.sellers.status.pdf') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">Download PDF</a>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="font-semibold">Laporan Toko - Per Propinsi</h3>
                        <p class="text-sm text-gray-600 mt-2">Daftar toko untuk setiap lokasi propinsi, diurutkan berdasarkan propinsi.</p>
                        <div class="mt-4">
                            <a href="{{ route('admin.reports.sellers.province.pdf') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">Download PDF</a>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="font-semibold">Laporan Produk - Berdasarkan Rating</h3>
                        <p class="text-sm text-gray-600 mt-2">Daftar produk dan ratingnya, diurutkan berdasarkan rating menurun.</p>
                        <div class="mt-4">
                            <a href="{{ route('admin.reports.products.rating.pdf') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">Download PDF</a>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-sm text-gray-500">
                    <p>Note: PDF akan dibuat dan diunduh langsung. Pastikan data sudah tersedia pada database.</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
