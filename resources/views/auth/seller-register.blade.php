<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Seller Registration
                </h2>
            </div>
            
            <form class="mt-8 space-y-6" action="{{ route('seller.register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Store Information -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Store Information</h3>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="store_name" class="block text-sm font-medium text-gray-700">Store Name *</label>
                        <input type="text" id="store_name" name="store_name" required 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label for="store_description" class="block text-sm font-medium text-gray-700">Short Store Description *</label>
                        <textarea id="store_description" name="store_description" rows="3" required
                                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <!-- PIC Information -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">PIC Information</h3>
                    </div>

                    <div>
                        <label for="pic_name" class="block text-sm font-medium text-gray-700">PIC Name *</label>
                        <input type="text" id="pic_name" name="pic_name" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="pic_phone" class="block text-sm font-medium text-gray-700">PIC Mobile Number *</label>
                        <input type="tel" id="pic_phone" name="pic_phone" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">PIC Email *</label>
                        <input type="email" id="email" name="email" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Address</h3>
                    </div>

                    <div class="md:col-span-2">
                        <label for="street_address" class="block text-sm font-medium text-gray-700">Street Address *</label>
                        <input type="text" id="street_address" name="street_address" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="rt_rw" class="block text-sm font-medium text-gray-700">RT/RW *</label>
                        <input type="text" id="rt_rw" name="rt_rw" placeholder="001/002" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="village" class="block text-sm font-medium text-gray-700">Village *</label>
                        <input type="text" id="village" name="village" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City *</label>
                        <input type="text" id="city" name="city" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-700">Province *</label>
                        <select id="province" name="province" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Province</option>
                            <option value="DKI Jakarta">DKI Jakarta</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                        </select>
                    </div>

                    <!-- Documents -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Documents</h3>
                    </div>

                    <div>
                        <label for="id_card_number" class="block text-sm font-medium text-gray-700">PIC ID Card Number *</label>
                        <input type="text" id="id_card_number" name="id_card_number" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="id_card_file" class="block text-sm font-medium text-gray-700">ID Card File *</label>
                        <input type="file" id="id_card_file" name="id_card_file" accept=".jpg,.jpeg,.png,.pdf" required
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="md:col-span-2">
                        <label for="pic_photo" class="block text-sm font-medium text-gray-700">PIC Photo *</label>
                        <input type="file" id="pic_photo" name="pic_photo" accept=".jpg,.jpeg,.png" required
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <!-- Password -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Account Security</h3>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password *</label>
                        <input type="password" id="password" name="password" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Register
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('seller.login') }}" class="text-blue-600 hover:text-blue-500">
                        Already have an account? Login here
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>