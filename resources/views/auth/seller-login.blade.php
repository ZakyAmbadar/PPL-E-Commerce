<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login - Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Seller Login
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Access your seller dashboard
                </p>
            </div>
            
            <form class="mt-8 space-y-6" action="{{ route('seller.login') }}" method="POST">
                @csrf
                
                <div>
                    <label for="login" class="block text-sm font-medium text-gray-700">Email/Phone Number</label>
                    <input type="text" id="login" name="login" required 
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter your email or phone number"
                           value="{{ old('login') }}">
                    @error('login')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter your password">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" 
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Remember me
                    </label>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Sign in to Dashboard
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('seller.register') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                        Don't have an account? Register here
                    </a>
                </div>
            </form>

            <!-- Display success message if any -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>