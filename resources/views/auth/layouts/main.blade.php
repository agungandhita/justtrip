<!DOCTYPE html>
<html>
<head>
    @include('auth.partials.head')
</head>
<body>
    @yield('container')
</div>

@include('auth.partials.end')
@include('sweetalert::alert')

<!-- Add SweetAlert scripts before closing body tag -->
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
</body>
</html>


