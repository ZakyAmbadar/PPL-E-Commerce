<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Verification - Admin Dashboard</title>
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
                        <h1 class="text-2xl font-bold text-gray-900">Seller Verification</h1>
                        <p class="text-gray-600">Review and verify seller applications</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                        </a>
                        <a href="{{ route('admin.sellers.all') }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-list mr-1"></i>All Sellers
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-clock text-yellow-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pending Verification</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_count'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Approved Sellers</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['approved_count'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="bg-red-100 p-3 rounded-full">
                                <i class="fas fa-times-circle text-red-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Rejected Sellers</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['rejected_count'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Sellers</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_sellers'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Sellers Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-lg font-semibold text-gray-800">Pending Seller Applications</h2>
                        <p class="text-sm text-gray-600 mt-1">Review and verify new seller registrations</p>
                    </div>

                    @if($pendingSellers->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Seller Info
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Contact
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Address
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Registered
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pendingSellers as $seller)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-12 w-12 bg-gray-200 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-store text-gray-400"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $seller->store_name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        PIC: {{ $seller->pic_name }}
                                                    </div>
                                                    <div class="text-xs text-gray-400">
                                                        Products: {{ $seller->products_count }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $seller->email }}</div>
                                            <div class="text-sm text-gray-500">{{ $seller->pic_phone }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{ $seller->village }}, {{ $seller->city }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $seller->province }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $seller->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2">
                                                <form action="{{ route('admin.sellers.approve', $seller->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm"
                                                            onclick="return confirm('Approve this seller?')">
                                                        <i class="fas fa-check mr-1"></i>Approve
                                                    </button>
                                                </form>
                                                <button onclick="showRejectForm({{ $seller->id }})" 
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                                    <i class="fas fa-times mr-1"></i>Reject
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-check-circle text-4xl text-green-400 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900">No pending verifications</h3>
                            <p class="text-gray-500 mt-2">All seller applications have been processed.</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Rejection Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900">Reject Seller Application</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mt-4">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700">Reason for Rejection</label>
                        <textarea id="rejection_reason" name="rejection_reason" rows="4" required
                                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Please provide a reason for rejection..."></textarea>
                    </div>
                    <div class="mt-4 flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectModal()" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                            Confirm Rejection
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showRejectForm(sellerId) {
            const form = document.getElementById('rejectForm');
            form.action = '/admin/sellers/' + sellerId + '/reject';
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejection_reason').value = '';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('rejectModal');
            if (event.target === modal) {
                closeRejectModal();
            }
        }
    </script>
</body>
</html>