@include('Frontend.partials.start')

<body class="font-sans antialiased bg-gray-50">
    @include('Frontend.partials.navbar')
    
    <!-- Main Content -->
    <main class="pt-16">
        @yield('container')
    </main>
    
    @include('Frontend.partials.footer')
    @include('Frontend.partials.end')
    @include('sweetalert::alert')
</body>
</html>
