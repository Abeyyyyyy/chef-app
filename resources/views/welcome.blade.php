@extends('layouts.chef')

@section('content')
    <main class="flex-grow flex items-center justify-center p-6 min-h-screen">
        <div class="w-full max-w-[420px] bg-white rounded-lg p-8 shadow-xl border border-gray-100 opacity-0 animate-fade-up">
            
            {{-- Header Logo & Title --}}
            <div class="flex flex-col items-center mb-8">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-brand-green text-3xl" style="font-variation-settings: 'FILL' 1;">skillet</span>
                    <h1 class="text-2xl font-extrabold tracking-tight text-brand-green">Chef Simulator</h1>
                </div>
                <p class="text-sm text-secondary font-medium italic">"Masak lebih pintar, dengan bahan yang ada."</p>
            </div>

            {{-- Tab Switcher --}}
            <div class="flex bg-gray-100 p-1 rounded-full mb-8 relative" id="auth-tabs">
                <button
                    class="flex-1 py-2 text-sm font-semibold rounded-full bg-white text-brand-green shadow-sm transition-all"
                    onclick="switchTab('login', this)">Masuk</button>
                <button class="flex-1 py-2 text-sm font-semibold rounded-full text-gray-500 transition-all"
                    onclick="switchTab('register', this)">Daftar</button>
            </div>

            {{-- Login Form --}}
            <div id="login-form" class="tab-content active">
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase text-gray-500 ml-1">Email</label>
                        <input type="email" name="email"
                            class="w-full bg-gray-50 border-none rounded-lg py-3.5 px-4 focus:ring-2 focus:ring-brand-green/20"
                            placeholder="chef@example.com" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase text-gray-500 ml-1">Password</label>
                        <input type="password" name="password"
                            class="w-full bg-gray-50 border-none rounded-lg py-3.5 px-4 focus:ring-2 focus:ring-brand-green/20"
                            placeholder="••••••••" required>
                    </div>
                    <button type="submit"
                        class="w-full bg-brand-green text-white font-bold py-4 rounded-lg shadow-lg hover:bg-brand-dark-green transition-all">
                        Masuk ke Dapur
                    </button>
                </form>
            </div>

            {{-- Register Form --}}
            <div id="register-form" class="tab-content hidden">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-gray-500 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" 
                            class="w-full bg-gray-50 border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-brand-green/20" 
                            placeholder="Chef Abiyya" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-gray-500 ml-1">Email</label>
                        <input type="email" name="email" 
                            class="w-full bg-gray-50 border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-brand-green/20" 
                            placeholder="chef@example.com" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-gray-500 ml-1">Password</label>
                        <input type="password" name="password" 
                            class="w-full bg-gray-50 border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-brand-green/20" 
                            placeholder="Minimal 8 karakter" required autocomplete="new-password">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase text-gray-500 ml-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" 
                            class="w-full bg-gray-50 border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-brand-green/20" 
                            placeholder="Ketik ulang password" required>
                    </div>
                    <button type="submit" 
                        class="w-full bg-brand-green text-white font-bold py-4 rounded-lg shadow-lg hover:bg-brand-dark-green transition-all mt-2">
                        Mulai Memasak
                    </button>
                </form>
            </div>

            {{-- Social Login Divider --}}
            <div class="mt-8 pt-6 border-t border-gray-100">
                <button
                    class="w-full bg-white border border-gray-200 py-3 rounded-lg flex items-center justify-center gap-3 hover:bg-gray-50 transition-all text-sm font-semibold text-gray-600">
                    <img src="https://www.google.com/favicon.ico" class="w-4 h-4" alt="Google Icon"> 
                    Lanjutkan dengan Google
                </button>
            </div>
        </div>
    </main>

    <style>
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>

    <script>
        function switchTab(type, el) {
            // Toggle Buttons Style
            const buttons = document.querySelectorAll('#auth-tabs button');
            buttons.forEach(btn => {
                btn.classList.remove('bg-white', 'text-brand-green', 'shadow-sm');
                btn.classList.add('text-gray-500');
            });
            el.classList.add('bg-white', 'text-brand-green', 'shadow-sm');
            el.classList.remove('text-gray-500');

            // Toggle Forms Visibility
            document.getElementById('login-form').classList.remove('active');
            document.getElementById('register-form').classList.remove('active');
            
            const targetForm = document.getElementById(type + '-form');
            targetForm.classList.add('active');
            
            // Handle hidden class for Tailwind compatibility
            if(type === 'login') {
                document.getElementById('login-form').classList.remove('hidden');
                document.getElementById('register-form').classList.add('hidden');
            } else {
                document.getElementById('register-form').classList.remove('hidden');
                document.getElementById('login-form').classList.add('hidden');
            }
        }
    </script>
@endsection