<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Culinary Atelier') }} - Welcome</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
            .bg-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
        <script>
            // Reset loader flag when user visits login/register page
            sessionStorage.removeItem('hasSeenLoader');
        </script>
    </head>
    <body class="antialiased text-on-surface bg-background selection:bg-primary selection:text-white">
        <div class="flex min-h-screen">
            <!-- Left Pane: Image/Branding -->
            <div class="relative hidden w-0 flex-1 lg:block overflow-hidden">
                <div class="absolute inset-0 bg-gray-900">
                    <img class="absolute inset-0 h-full w-full object-cover opacity-60 transition-transform duration-1000 hover:scale-105" src="https://images.unsplash.com/photo-1600565193348-f74bd3c7ccdf?q=80&w=1920&auto=format&fit=crop" alt="Culinary Background">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-black/10"></div>
                </div>
                <div class="absolute inset-0 bg-pattern"></div>
                
                <div class="absolute bottom-0 left-0 p-16 text-white w-full z-10 animate-fade-up">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                        </div>
                        <span class="text-2xl font-bold tracking-tight">Culinary Atelier</span>
                    </div>
                    <h2 class="text-5xl font-bold mb-6 leading-tight">Master your kitchen <br/> with smart management.</h2>
                    <p class="text-lg text-gray-300 max-w-xl font-light leading-relaxed">Experience a state-of-the-art chef simulator and intelligent pantry management system designed for culinary excellence.</p>
                </div>
            </div>

            <!-- Right Pane: Form -->
            <div class="flex flex-1 flex-col justify-center px-6 py-12 sm:px-12 lg:flex-none lg:px-24 xl:px-32 bg-background relative overflow-hidden">
                <!-- Decorative glowing blobs -->
                <div class="absolute -top-32 -right-32 w-96 h-96 bg-brand-green/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
                <div class="absolute top-1/2 -left-32 w-80 h-80 bg-secondary/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>

                <!-- Floating Back Button -->
                <a href="/" class="absolute top-6 right-6 md:top-8 md:right-8 z-50 flex items-center gap-2 px-5 py-2.5 bg-white/90 backdrop-blur-sm rounded-full shadow-lg shadow-primary/10 border border-surface-variant/50 text-primary hover:text-white hover:bg-primary transition-all duration-300 hover:-translate-y-1 group" title="Kembali ke Beranda">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="font-bold text-sm">Kembali</span>
                </a>

                <div class="mx-auto w-full max-w-md relative z-10 animate-fade-up">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden mb-10 flex justify-center">
                        <a href="/" class="flex items-center gap-3 group">
                            <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center shadow-lg shadow-primary/30 group-hover:scale-105 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                            </div>
                            <span class="text-2xl font-bold text-on-surface tracking-tight">Culinary Atelier</span>
                        </a>
                    </div>

                    {{ $slot }}

                </div>
            </div>
        </div>
        <script>
            // Professional global image fallback mechanism
            document.addEventListener('error', function(e) {
                if (e.target.tagName && e.target.tagName.toLowerCase() === 'img') {
                    if (e.target.dataset.fallbackApplied) return;
                    e.target.dataset.fallbackApplied = 'true';
                    
                    e.target.src = "data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='600' viewBox='0 0 800 600'%3E%3Cdefs%3E%3ClinearGradient id='bg' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%23f5f4eb'/%3E%3Cstop offset='100%25' stop-color='%23e2e3dd'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='800' height='600' fill='url(%23bg)'/%3E%3Cg transform='translate(400, 260)' text-anchor='middle'%3E%3Cg stroke='%23a09e95' stroke-width='2.5' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='-32' y='-32' width='64' height='64' rx='12'/%3E%3Ccircle cx='-10' cy='-10' r='6'/%3E%3Cpath d='M-32 16 L-16 0 L8 24 M12 12 L32 32'/%3E%3C/g%3E%3Ctext y='70' font-family='Plus Jakarta Sans, ui-sans-serif, system-ui, sans-serif' font-size='14' font-weight='800' fill='%235e5c54' letter-spacing='0.08em'%3EIMAGE NOT AVAILABLE%3C/text%3E%3Ctext y='92' font-family='Plus Jakarta Sans, ui-sans-serif, system-ui, sans-serif' font-size='12' font-weight='500' fill='%23858277'%3EVisual tidak dapat dimuat%3C/text%3E%3C/g%3E%3C/svg%3E";
                    
                    e.target.classList.remove('p-4', 'bg-surface-container-low', 'object-contain');
                    e.target.classList.add('object-cover');
                }
            }, true);
        </script>
    </body>
</html>
