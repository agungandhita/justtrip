<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile User - JustTrip</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <img src="{{ asset('image/logo6.png') }}" alt="JustTrip Logo" class="w-10 h-10 mr-3">
                        <h1 class="text-2xl font-bold text-gray-900">Profile User</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900">Informasi Profile</h2>
                    </div>
                    
                    <div class="px-6 py-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <div class="bg-gray-50 border border-gray-300 rounded-md px-3 py-2">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <div class="bg-gray-50 border border-gray-300 rounded-md px-3 py-2">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <div class="bg-gray-50 border border-gray-300 rounded-md px-3 py-2">
                                    {{ Auth::user()->phone ?? 'Belum diisi' }}
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                <div class="bg-gray-50 border border-gray-300 rounded-md px-3 py-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ ucfirst(Auth::user()->role) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                <div class="bg-gray-50 border border-gray-300 rounded-md px-3 py-2 min-h-[80px]">
                                    {{ Auth::user()->address ?? 'Belum diisi' }}
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bergabung Sejak</label>
                                <div class="bg-gray-50 border border-gray-300 rounded-md px-3 py-2">
                                    {{ Auth::user()->created_at->format('d F Y') }}
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Terakhir Update</label>
                                <div class="bg-gray-50 border border-gray-300 rounded-md px-3 py-2">
                                    {{ Auth::user()->updated_at->format('d F Y H:i') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex space-x-4">
                            <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-md transition-colors">
                                Kembali ke Website
                            </a>
                            <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-md transition-colors">
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>