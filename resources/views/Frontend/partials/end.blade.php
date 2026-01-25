<!-- AOS Animation Script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 50, // Muncul lebih awal saat scroll
        delay: 0,
        anchorPlacement: 'top-bottom', // Animasi dipicu saat bagian atas elemen masuk ke bawah viewport
    });
</script>

@stack('scripts')
