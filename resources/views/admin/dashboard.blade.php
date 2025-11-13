<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">MarketPlace</h1>
                <p class="text-blue-200 text-sm mt-2">Admin Platform</p>
            </div>
            
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 bg-blue-900 border-l-4 border-white">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('admin.sellers.all') }}" class="flex items-center px-6 py-3 hover:bg-blue-700 border-l-4 border-transparent">
                    <i class="fas fa-store w-6"></i>
                    <span class="ml-3">Manage Sellers</span>
                </a>
                <a href="{{ route('admin.seller.verification') }}" class="flex items-center px-6 py-3 hover:bg-blue-700 border-l-4 border-transparent">
                    <i class="fas fa-check-circle w-6"></i>
                    <span class="ml-3">Verify Sellers</span>
                    @if($stats['pending_sellers'] > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                            {{ $stats['pending_sellers'] }}
                        </span>
                    @endif
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 border-l-4 border-transparent">
                    <i class="fas fa-chart-bar w-6"></i>
                    <span class="ml-3">View Reports</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 border-l-4 border-transparent">
                    <i class="fas fa-tags w-6"></i>
                    <span class="ml-3">Manage Categories</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-8 py-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Platform Admin Dashboard</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <i class="fas fa-bell text-gray-600"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">3</span>
                        </div>
                        <div class="flex items-center">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="Admin" class="w-8 h-8 rounded-full">
                            <span class="ml-2 text-gray-700">Administrator</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Stats Section -->
            <main class="p-8">
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Registered -->
                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Registered</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($stats['total_sellers']) }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-users text-blue-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-sm text-green-600">
                            <i class="fas fa-arrow-up"></i> 12% from last month
                        </div>
                    </div>

                    <!-- Total Products -->
                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Products</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($stats['total_products']) }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-box text-green-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-sm text-green-600">
                            <i class="fas fa-arrow-up"></i> 8% from last month
                        </div>
                    </div>

                    <!-- Total Revenue -->
                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Monthly Revenue</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">Rp 12.350Jt</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-dollar-sign text-purple-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-sm text-green-600">
                            <i class="fas fa-arrow-up"></i> 15% from last month
                        </div>
                    </div>

                    <!-- Pending Verification -->
                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Sellers Pending Verification</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['pending_sellers'] }}</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-clock text-yellow-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.seller.verification') }}" class="text-blue-600 text-sm hover:text-blue-800">
                                Review Now <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <a href="{{ route('admin.sellers.all') }}" class="bg-white rounded-lg shadow p-6 text-center hover:shadow-md transition-shadow cursor-pointer">
                        <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-store text-blue-500 text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">Manage Sellers</h3>
                        <p class="text-gray-500 text-sm mt-1">View all registered sellers</p>
                    </a>

                    <a href="{{ route('admin.seller.verification') }}" class="bg-white rounded-lg shadow p-6 text-center hover:shadow-md transition-shadow cursor-pointer">
                        <div class="bg-yellow-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-clipboard-check text-yellow-500 text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">Verify Sellers</h3>
                        <p class="text-gray-500 text-sm mt-1">Review pending seller applications</p>
                        @if($stats['pending_sellers'] > 0)
                            <span class="inline-block mt-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                {{ $stats['pending_sellers'] }} pending
                            </span>
                        @endif
                    </a>

                    <a href="#" class="bg-white rounded-lg shadow p-6 text-center hover:shadow-md transition-shadow cursor-pointer">
                        <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-chart-bar text-purple-500 text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">View Reports</h3>
                        <p class="text-gray-500 text-sm mt-1">Platform analytics & reports</p>
                    </a>

                    <a href="#" class="bg-white rounded-lg shadow p-6 text-center hover:shadow-md transition-shadow cursor-pointer">
                        <div class="bg-orange-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-tags text-orange-500 text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">Manage Categories</h3>
                        <p class="text-gray-500 text-sm mt-1">Product categories management</p>
                    </a>
                </div>

                <!-- Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Recent Sellers -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Recent Sellers</h2>
                        </div>
                        <div class="p-6">
                            @foreach($recentSellers as $seller)
                            <div class="flex items-center justify-between py-3 border-b last:border-b-0">
                                <div class="flex items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($seller->store_name) }}&background=0D8ABC&color=fff" 
                                         alt="{{ $seller->store_name }}" class="w-10 h-10 rounded-full">
                                    <div class="ml-4">
                                        <p class="font-medium text-gray-800">{{ $seller->store_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $seller->email }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 text-xs rounded-full 
                                    {{ $seller->status == 'approved' ? 'bg-green-100 text-green-800' : 
                                       ($seller->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($seller->status) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Products -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Recent Products</h2>
                        </div>
                        <div class="p-6">
                            @foreach($recentProducts as $product)
                            <div class="flex items-center justify-between py-3 border-b last:border-b-0">
                                <div class="flex items-center">
                                    <div class="bg-gray-100 w-10 h-10 rounded flex items-center justify-center">
                                        <i class="fas fa-box text-gray-500"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="font-medium text-gray-800">{{ Str::limit($product->name, 30) }}</p>
                                        <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-medium text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-500">{{ $product->seller->store_name }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Simple interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to quick action cards
            const actionCards = document.querySelectorAll('.cursor-pointer');
            actionCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Navigation is now handled by href links
                    console.log('Navigating to:', this.href);
                });
            });
        });
    </script>
</body>
</html>