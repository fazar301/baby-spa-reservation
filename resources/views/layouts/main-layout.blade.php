<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabySpa - Gentle Spa Experience for Your Little One</title>
    <style>
        html {
        scroll-behavior: smooth;
        }
    </style>
    @vite('resources/css/app.css','resources/js/app.js')
    {{-- <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {"50":"#fdf2f8","100":"#fce7f3","200":"#fbcfe8","300":"#f9a8d4","400":"#f472b6","500":"#ec4899","600":"#db2777","700":"#be185d","800":"#9d174d","900":"#831843"}
                    }
                }
            }
        }
    </script> --}}
</head>
<body class="flex min-h-screen flex-col">
    <!-- Navigation -->
    <x-navbar></x-navbar>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>
