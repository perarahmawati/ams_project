<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        AMS Dashboard
    </title>

    <!-- Fonts -->
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.min.css">
    <!-- Boxicons -->
    <link rel="stylesheet" href="assets/fonts/boxicons/css/boxicons.min.css">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/ams_dashboard.css">

</head>

<body class="{{ $class ?? '' }}">

    @guest
        @yield('content')
    @endguest

    @auth
        @yield('content')
    @endauth
    
    <!-- JS Files -->
    
</body>
</html>