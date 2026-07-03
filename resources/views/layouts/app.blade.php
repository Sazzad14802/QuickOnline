<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

             {{-- Toast --}}
            @if(session('success'))
                <div class="toast-container position-fixed bottom-0 end-0 p-3">

                    <div id="successToast"
                        class="toast text-bg-success"
                        role="alert"
                        data-bs-delay="2000">

                        <div class="toast-body">
                            {{ session('success') }}
                        </div>

                    </div>

                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const toast = new bootstrap.Toast(
                            document.getElementById('successToast')
                        );
                        toast.show();
                    });
                </script>
            @endif
            @if(session('error'))
                <div class="toast-container position-fixed bottom-0 end-0 p-3">

                    <div id="errorToast"
                        class="toast text-bg-danger"
                        role="alert"
                        data-bs-delay="3000"
                        data-bs-autohide="true">

                        <div class="toast-body">
                            {{ session('error') }}
                        </div>

                    </div>

                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const toast = new bootstrap.Toast(document.getElementById('errorToast'));
                        toast.show();
                    });
                </script>   
            @endif
            @if(session('warning'))
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="warningToast"
                        class="toast text-bg-warning"
                        role="alert"
                        data-bs-delay="3000"
                        data-bs-autohide="true">

                        <div class="toast-body">
                            {{ session('warning') }}
                        </div>

                    </div>

                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const toast = new bootstrap.Toast(document.getElementById('warningToast'));
                    toast.show();
                });
                </script>
            @endif
        
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
