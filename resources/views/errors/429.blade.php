<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>429 - Terlalu Banyak Permintaan | JustTrip</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('image/logo6.png') }}" type="image/png">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-cyan-50 via-blue-50 to-teal-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl border border-cyan-100 p-8 text-center relative overflow-hidden">
        <!-- Decorative Glow -->
        <div class="absolute -top-12 -right-12 w-32 h-32 bg-cyan-200/50 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-12 -left-12 w-32 h-32 bg-teal-200/50 rounded-full blur-2xl"></div>

        <div class="relative z-10">
            <!-- Icon / Badge -->
            <div class="w-20 h-20 mx-auto mb-6 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center shadow-inner">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <!-- Error Code & Title -->
            <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full mb-3 uppercase tracking-wider">
                HTTP 429 • Security Rate Limit
            </span>
            <h1 class="text-2xl font-black text-gray-900 mb-2">Terlalu Banyak Permintaan</h1>
            <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                {{ $message ?? 'Sistem mendeteksi aktivitas yang terlalu cepat atau percobaan login berulang. Demi keamanan akun dan sistem, silakan tunggu sejenak sebelum mencoba kembali.' }}
            </p>

            <!-- Actions -->
            <div class="space-y-3">
                <a href="{{ route('home') }}" class="block w-full py-3 px-4 bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white font-semibold rounded-xl shadow-lg shadow-cyan-500/25 transition-all duration-200">
                    Kembali ke Beranda
                </a>
                <button onclick="window.history.back()" class="block w-full py-2.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl text-sm transition-colors">
                    Kembali ke Halaman Sebelumnya
                </button>
            </div>

            <!-- Security Footer -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-xs text-gray-400">
                Dilindungi oleh Sistem Keamanan JustTrip
            </div>
        </div>
    </div>
</body>
</html>

