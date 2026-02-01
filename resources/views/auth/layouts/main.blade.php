@include('auth.partials.head')

@yield('container')

@include('auth.partials.end')
@include('sweetalert::alert')

<!-- Add SweetAlert scripts before closing body tag -->
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>


