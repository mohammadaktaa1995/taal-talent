<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Taal Talent School</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="https://taal-talent.nl/ona/temp/assets/css/core.min.css" rel="stylesheet">
    <link href="https://taal-talent.nl/ona/temp/assets/css/app.min.css" rel="stylesheet">
    <link href="https://taal-talent.nl/ona/temp/assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="shortcut icon" href="https://taal-talent.nl/wp-content/uploads/2018/07/LOGO2.png"/>
    <link rel="apple-touch-icon" href="https://taal-talent.nl/wp-content/uploads/2018/07/LOGO2.png"/>
    <script src="js/script.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body>
@include("layouts.header")
<main class="main-container">
    @yield('content')
    @include("layouts.footer")
</main>
<!-- Scripts -->
<script src="https://taal-talent.nl/ona/temp/assets/js/core.min.js"></script>
<script src="https://taal-talent.nl/ona/temp/assets/js/app.min.js"></script>
<script src="https://taal-talent.nl/ona/temp/assets/js/script.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{asset('js/custom.js')}}"></script>
@stack('scripts')

</body>
</html>
