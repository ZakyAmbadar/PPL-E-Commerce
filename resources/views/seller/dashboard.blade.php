<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Seller Dashboard</h1>
                        <p class="text-gray-600">Welcome back, {{ Auth::guard('seller')->user()->store_name }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('seller.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <!-- Shop Summary -->
                <div class="bg-white rounded-lg shadow mb-8">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">Shop Summary</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Active Products -->
                            <div class="text-center p-6 bg-blue-50 rounded-lg">
                                <div class="text-3xl font-bold text-blue-600">{{ $stats['active_products'] }}</div>
                                <div class="text-gray-600 mt-2">Active Products</div>
                                <div class="text-sm text-green-600 mt-1">
                                    <i class="fas fa-arrow-up"></i> 2 new this week
                                </div>
                            </div>

                            <!-- Today's Orders -->
                            <div class="text-center p-6 bg-green-50 rounded-lg">
                                <div class="text-3xl font-bold text-green-600">{{ $stats['todays_orders'] }}</div>
                                <div class="text-gray-600 mt-2">Today's Orders</div>
                                <div class="text-sm text-green-600 mt-1">
                                    <i class="fas fa-arrow-up"></i> 3 from yesterday
                                </div>
                            </div>

                            <!-- Average Rating -->
                            <div class="text-center p-6 bg-yellow-50 rounded-lg">
                                <div class="text-3xl font-bold text-yellow-600">{{ $stats['average_rating'] }}</div>
                                <div class="text-gray-600 mt-2">Average Rating</div>
                                <div class="flex justify-center mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($stats['average_rating']))
                                            <i class="fas fa-star text-yellow-400"></i>
                                        @elseif($i - 0.5 <= $stats['average_rating'])
                                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                                        @else
                                            <i class="far fa-star text-yellow-400"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Quick Access -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b">
                            <h2 class="text-xl font-semibold text-gray-800">Quick Access</h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 gap-4">
                                <a href="{{ route('seller.products.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors">
                                    <div class="bg-blue-100 p-3 rounded-lg">
                                        <i class="fas fa-plus text-blue-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-800">Add Product</h3>
                                        <p class="text-sm text-gray-600">Upload new product to your store</p>
                                    </div>
                                </a>

                                <a href="{{ route('seller.products.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-200 transition-colors">
                                    <div class="bg-green-100 p-3 rounded-lg">
                                        <i class="fas fa-cubes text-green-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-800">Manage Products</h3>
                                        <p class="text-sm text-gray-600">Edit, delete or update products</p>
                                    </div>
                                </a>

                                <a href="#" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-200 transition-colors">
                                    <div class="bg-purple-100 p-3 rounded-lg">
                                        <i class="fas fa-chart-bar text-purple-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-800">View Report</h3>
                                        <p class="text-sm text-gray-600">Sales and performance reports</p>
                                    </div>
                                </a>

                                <a href="#" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-orange-50 hover:border-orange-200 transition-colors">
                                    <div class="bg-orange-100 p-3 rounded-lg">
                                        <i class="fas fa-store text-orange-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-800">Edit Shop Profile</h3>
                                        <p class="text-sm text-gray-600">Update your store information</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b">
                            <h2 class="text-xl font-semibold text-gray-800">Recent Activity</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach($recentActivities as $activity)
                                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        @if($activity['type'] === 'order')
                                        <div class="bg-green-100 p-2 rounded-full">
                                            <i class="fas fa-shopping-cart text-green-600"></i>
                                        </div>
                                        @elseif($activity['type'] === 'review')
                                        <div class="bg-blue-100 p-2 rounded-full">
                                            <i class="fas fa-star text-blue-600"></i>
                                        </div>
                                        @else
                                        <div class="bg-gray-100 p-2 rounded-full">
                                            <i class="fas fa-bell text-gray-600"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium">{{ $activity['message'] }}</p>
                                        <p class="text-sm text-gray-500">{{ $activity['time'] }}</p>
                                    </div>
                                </div>
                                @endforeach

                                <!-- Sample Activities (akan diganti dengan data real) -->
                                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        <div class="bg-green-100 p-2 rounded-full">
                                            <i class="fas fa-shopping-cart text-green-600"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium">New order #1234</p>
                                        <p class="text-sm text-gray-500">5 hours ago</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        <div class="bg-green-100 p-2 rounded-full">
                                            <i class="fas fa-shopping-cart text-green-600"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium">New order #1233</p>
                                        <p class="text-sm text-gray-500">1 day ago</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        <div class="bg-blue-100 p-2 rounded-full">
                                            <i class="fas fa-star text-blue-600"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium">Jane Doe: Great quality product!</p>
                                        <p class="text-sm text-gray-500">2 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Simple interactivity for quick access links
        document.addEventListener('DOMContentLoaded', function() {
            const quickAccessLinks = document.querySelectorAll('a[href="#"]');
            quickAccessLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const title = this.querySelector('h3').textContent;
                    alert(`Navigating to: ${title}\n\n(This feature will be implemented soon!)`);
                });
            });
        });
    </script>
</body>
</html>