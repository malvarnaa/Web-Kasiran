<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Dashboard</title>
    
    <link rel="icon" type="image/png" href="https://1.bp.blogspot.com/-fhQrt5qoZVQ/Vk7JRkLvD4I/AAAAAAAAF-k/ePg_jf3sDwI/s1600/Smk-Negeri-1-Kawali-Logo.png">
    
    <!-- Google Font: Nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}

    <!-- Bootstrap CSS -->

    <!-- Include Bootstrap CSS in the <head> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include Bootstrap JavaScript before </body> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYd3hjErRk9YtG9QAEp0hquMXP1p7buM6f/FO/5dCp10Rg" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ECFjA5qg65t0LgQn9W/UQKnoO6AnQmMbqlkCqSb2TKEp5gT2pS/Yt1CeqiNB6kBp" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            height: 100vh;
        }
    </style>

    <div class="wrapper">

        <x-navbar></x-navbar>

        <x-sidebar></x-sidebar>

        <div class="content-wrapper">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <footer class="main-footer text-center">
        </footer>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-QXn99R6Aq5LA8B9ScE2k9b6Q8KoZ+X2Hg24SHaqnqPOfz0gnNnXnE4+Maa4mH3sV" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Sidebar Toggle Script -->
    {{-- <script>
        document.querySelector('.menu-icon').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        document.querySelector('.menu-icon').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.content-wrapper').classList.toggle('active');
        });
    </script> --}}
</body>
</html>