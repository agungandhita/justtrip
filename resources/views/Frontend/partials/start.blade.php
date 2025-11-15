<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <title>JustTrip - Explore the World with JustTrip</title>
    
    <!-- Fallback: mount a small Alpine guestBookingSearch component when bundled assets are not available (helps dev without running Vite) -->
    <script>
        // If Alpine is already present and guestBookingSearch is not registered by bundled JS,
        // register a lightweight fallback so suggestions work even if Vite/dev server isn't running.
        document.addEventListener('alpine:init', () => {
            try {
                if (!Alpine || typeof Alpine.data !== 'function') return;
            } catch (e) {
                return; // Alpine not available yet
            }

            if (Alpine.__guestBookingFallbackRegistered) return;

            if (!Alpine.data('guestBookingSearch')) {
                Alpine.data('guestBookingSearch', () => ({
                    destinasi: '', layananList: [], loading: false, error: null, selectedLayanan: null,
                    async searchLayanan() {
                        if (!this.destinasi || this.destinasi.trim().length < 3) { this.layananList = []; this.error = null; return; }
                        this.loading = true; this.error = null;
                        try {
                            const res = await fetch('/api/layanan/search?destinasi=' + encodeURIComponent(this.destinasi));
                            const data = await res.json();
                            if (data.success) { this.layananList = data.data || []; if (this.layananList.length) this.selectLayanan(this.layananList[0]); }
                            else { this.error = data.message || 'Gagal mencari layanan'; this.layananList = []; }
                        } catch (err) { this.error = err.message || 'Error'; this.layananList = []; }
                        finally { this.loading = false; }
                    },
                    selectLayanan(layanan) {
                        this.selectedLayanan = layanan;
                        const layananIdInput = document.querySelector('input[name="layanan_id"]'); if (layananIdInput) layananIdInput.value = layanan.layanan_id;
                        const durasiInput = document.querySelector('input[name="durasi_hari_diinginkan"]'); if (durasiInput && layanan.durasi_hari) durasiInput.value = layanan.durasi_hari;
                        document.dispatchEvent(new CustomEvent('layanan-selected', { detail: layanan }));
                    },
                    formatPrice(p) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(p); }
                }));
            }
            Alpine.__guestBookingFallbackRegistered = true;
        });
    </script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        'secondary': {
                            50: '#faf5ff',
                            100: '#f3e8ff',
                            200: '#e9d5ff',
                            300: '#d8b4fe',
                            400: '#c084fc',
                            500: '#a855f7',
                            600: '#9333ea',
                            700: '#7c3aed',
                            800: '#6b21a8',
                            900: '#581c87',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'bounce-slow': 'bounce 2s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
</head>
