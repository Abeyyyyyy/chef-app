<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Chef Simulator - Settings</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#006b2d",
                        "primary-container": "#0b873c",
                        secondary: "#80534c",
                        "secondary-container": "#ffc4ba",
                        "on-secondary-container": "#7b4e47",
                        surface: "#fbf9f0",
                        "surface-variant": "#e4e3da",
                        "on-surface": "#1b1c17",
                        "on-surface-variant": "#6e7a6d", /* Adjusted for text */
                        "surface-container-low": "#f6f4eb",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#eae8e0",
                        error: "#ba1a1a",
                        "outline-variant": "#becabb"
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans", "sans-serif"],
                        body: ["Plus Jakarta Sans", "sans-serif"],
                        label: ["Plus Jakarta Sans", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #fbf9f0; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .icon-fill { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-nav { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .bg-texture {
            background-image: url('data:image/svg+xml;utf8,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="1" fill="%231b1c17" fill-opacity="0.03"/></svg>');
        }
    </style>
        <script>
        if (sessionStorage.getItem('sidebarHovered') === 'true') {
            document.write(`
            <style id="force-hover-style">
                @media (min-width: 768px) {
                    #sidebar { width: 16rem !important; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important; }
                    #sidebar .md\\:opacity-0 { opacity: 1 !important; }
                    #sidebar .md\\:w-0 { width: auto !important; }
                    #sidebar .md\\:px-0 { padding-left: 1.5rem !important; padding-right: 1.5rem !important; }
                    #sidebar .md\\:px-3 { padding-left: 1rem !important; padding-right: 1rem !important; }
                    #sidebar img.md\\:w-10 { width: 4rem !important; height: 4rem !important; }
                }
            </style>
            `);
        }
    </script>
</head>
<body class="font-body text-on-surface bg-texture antialiased pb-24 md:pb-0 flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 hidden opacity-0 transition-all duration-300 ease-in-out"
        onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="group/sidebar h-screen fixed left-0 top-0 border-r border-surface-variant bg-surface/95 backdrop-blur-xl flex flex-col z-[60] transition-all duration-300 ease-in-out shadow-2xl md:shadow-none hover:md:shadow-2xl
        w-64 -translate-x-full md:translate-x-0 md:w-20 hover:md:w-64 overflow-x-hidden overflow-y-auto custom-scrollbar py-6">

        <button onclick="toggleSidebar()"
            class="md:hidden absolute top-4 right-4 text-on-surface-variant hover:bg-surface-variant p-2 rounded-full transition-colors">
            <span class="material-symbols-outlined">close</span>
        </button>

        <div class="flex flex-col items-center pt-2 px-6 md:px-0 group-hover/sidebar:px-6 transition-all duration-300">
            <div class="relative cursor-pointer shrink-0 flex justify-center w-full">
                <a href="/settings" class="block">
                    <img alt="Chef logo"
                        class="w-16 h-16 md:w-10 md:h-10 group-hover/sidebar:w-16 group-hover/sidebar:h-16 rounded-full object-cover organic-shadow relative z-10 border-2 border-white transition-all duration-300"
                        src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode(auth()->user()->name) }}&backgroundColor=fbf9f0" />
                </a>
            </div>
            <div class="text-center mt-3 opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                <h2 class="text-lg font-black text-primary font-headline tracking-tight">The Atelier</h2>
                <p class="text-[10px] font-bold text-secondary tracking-widest uppercase">Chef Simulator</p>
            </div>
        </div>

        <div class="px-6 md:px-3 group-hover/sidebar:px-6 transition-all duration-300 w-full mt-6 shrink-0">
            <a href="/chat"
                class="w-full bg-gradient-to-r from-primary to-primary-container text-white rounded-xl py-3 md:py-3 px-4 md:px-0 group-hover/sidebar:px-4 font-bold text-sm organic-shadow hover:shadow-lg hover:shadow-primary/30 active:scale-95 transition-all duration-200 flex justify-center items-center overflow-hidden">
                <span class="material-symbols-outlined text-[20px] shrink-0">add_circle</span> 
                <span class="whitespace-nowrap font-bold opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300 w-auto md:w-0 group-hover/sidebar:w-auto overflow-hidden pl-2">Create Recipe</span>
            </a>
        </div>

        <nav class="flex-1 space-y-1.5 font-medium px-4 md:px-3 group-hover/sidebar:px-4 transition-all duration-300 mt-6 shrink-0">
            <a href="/dashboard" class="flex items-center text-secondary hover:bg-surface-container-high rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined">grid_view</span>
                </div>
                <span class="whitespace-nowrap pr-4 font-medium opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300">Home</span>
            </a>
            <a href="/explore" class="flex items-center text-secondary hover:bg-surface-container-high rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined">restaurant_menu</span>
                </div>
                <span class="whitespace-nowrap pr-4 font-medium opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300">Recipes</span>
            </a>
            <a href="/pantry" class="flex items-center text-secondary hover:bg-surface-container-high rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined">inventory_2</span>
                </div>
                <span class="whitespace-nowrap pr-4 font-medium opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300">Pantry</span>
            </a>
            <a href="/community" class="flex items-center text-secondary hover:bg-surface-container-high rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined">groups</span>
                </div>
                <span class="whitespace-nowrap pr-4 font-medium opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300">Community</span>
            </a>
            <a href="/bookmarks" class="flex items-center text-secondary hover:bg-surface-container-high rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined">bookmark</span>
                </div>
                <span class="whitespace-nowrap pr-4 font-medium opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300">Bookmarks</span>
            </a>
            <a href="/history" class="flex items-center text-secondary hover:bg-surface-container-high rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined">history</span>
                </div>
                <span class="whitespace-nowrap pr-4 font-medium opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300">History</span>
            </a>
        </nav>

        <div class="mt-4 space-y-1.5 font-medium border-t border-surface-variant pt-4 px-4 md:px-3 group-hover/sidebar:px-4 transition-all duration-300 shrink-0">
            <a href="/settings" class="flex items-center bg-primary text-white shadow-md shadow-primary/20 hover:bg-primary rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">settings</span>
                </div>
                <span class="whitespace-nowrap pr-4 font-medium opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300">Settings</span>
            </a>
            <a href="#" class="flex items-center text-secondary hover:bg-surface-container-high rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined">help_outline</span>
                </div>
                <span class="whitespace-nowrap pr-4 font-medium opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300">Support</span>
            </a>
            <a href="#" onclick="openLogoutModal(event)" class="flex items-center text-error hover:bg-error-container hover:text-error rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined">logout</span>
                </div>
                <span class="whitespace-nowrap pr-4 font-bold opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300">Log Out</span>
            </a>
        </div>
    </aside>

    <div id="main-content" class="md:ml-20 flex-1 flex flex-col relative transition-all duration-300 w-full h-screen overflow-hidden">

        <nav class="sticky top-0 w-full z-40 flex justify-between items-center px-6 py-4 bg-[#fbf9f0]/80 glass-nav border-b border-surface-variant/50 transition-colors">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="text-primary hover:bg-surface-container-high p-2 rounded-full transition-colors duration-200 flex md:hidden">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <a class="text-xl font-bold italic text-primary tracking-tight hidden md:block" href="/dashboard">Chef Simulator</a>
                <h1 class="text-xl md:text-2xl font-bold tracking-tighter text-primary md:hidden">The Atelier</h1>
            </div>
            
            <div class="flex items-center gap-2 hidden md:flex ml-auto">
                <!-- Notification Dropdown -->
                <div class="relative">
                    <button id="notif-btn" onclick="toggleNotifications()"
                        class="text-primary hover:bg-surface-container-high p-2 rounded-full transition-colors relative group">
                        <span class="material-symbols-outlined icon-fill">notifications</span>
                        <span id="notif-badge" class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-surface group-hover:border-surface-container-high transition-colors"></span>
                    </button>

                    <!-- Dropdown Panel -->
                    <div id="notif-panel" class="absolute right-0 mt-2 w-80 md:w-96 bg-surface-container-lowest rounded-2xl organic-shadow border border-surface-variant z-50 hidden opacity-0 transform scale-95 transition-all duration-200 origin-top-right overflow-hidden shadow-ambient">
                        <div class="p-4 border-b border-surface-variant flex justify-between items-center bg-surface/50 backdrop-blur-md">
                            <h3 class="font-headline font-bold text-on-surface text-base">Notifikasi</h3>
                            <button class="text-xs font-bold text-primary hover:text-primary-container transition-colors">Tandai semua dibaca</button>
                        </div>
                        <div class="max-h-[320px] overflow-y-auto custom-scrollbar">
                            <!-- Item 1 -->
                            <a href="#" class="flex gap-4 p-4 hover:bg-surface-container-low transition-colors border-b border-surface-variant/50 relative">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">local_fire_department</span>
                                </div>
                                <div class="flex-1 text-left">
                                    <p class="text-sm text-on-surface font-medium leading-snug"><span class="font-bold">Resep Kari Ayam</span> yang Anda bagikan sedang trending di komunitas!</p>
                                    <p class="text-xs text-on-surface-variant mt-1">2 jam yang lalu</p>
                                </div>
                                <div class="w-2 h-2 bg-primary rounded-full absolute top-4 right-4"></div>
                            </a>
                            <!-- Item 2 -->
                            <a href="#" class="flex gap-4 p-4 hover:bg-surface-container-low transition-colors border-b border-surface-variant/50">
                                <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center text-secondary shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                                </div>
                                <div class="flex-1 text-left">
                                    <p class="text-sm text-on-surface font-medium leading-snug">Peringatan Pantry: Bawang putih tinggal sedikit.</p>
                                    <p class="text-xs text-on-surface-variant mt-1">5 jam yang lalu</p>
                                </div>
                            </a>
                            <!-- Item 3 -->
                            <a href="#" class="flex gap-4 p-4 hover:bg-surface-container-low transition-colors">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Renatta&backgroundColor=fbf9f0" class="w-10 h-10 rounded-full object-cover shrink-0 border border-surface-variant" alt="User">
                                <div class="flex-1 text-left">
                                    <p class="text-sm text-on-surface font-medium leading-snug"><span class="font-bold">Chef Renatta</span> menyukai resep Nasi Goreng Anda.</p>
                                    <p class="text-xs text-on-surface-variant mt-1">1 hari yang lalu</p>
                                </div>
                            </a>
                        </div>
                        <div class="p-3 border-t border-surface-variant text-center bg-surface-container-lowest">
                            <a href="#" class="text-sm font-bold text-primary hover:text-primary-container transition-colors">Lihat Semua Notifikasi</a>
                        </div>
                    </div>
                </div>
                <a href="/settings">
                    <img alt="User Avatar" class="w-9 h-9 rounded-full object-cover ml-2 border border-surface-variant" src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode(auth()->user()->name) }}&backgroundColor=fbf9f0"/>
                </a>
            </div>
        </nav>

        <!-- Main Content Canvas -->
        <main class="flex-1 p-6 md:p-12 relative overflow-y-auto">
            <div class="max-w-3xl mx-auto space-y-12">
                <header>
                    <h1 class="font-display text-4xl font-bold tracking-tight text-on-surface mb-2">Settings</h1>
                    <p class="font-body text-on-surface-variant text-lg">Manage your culinary preferences and account details.</p>
                </header>

                <div class="space-y-8">
                    <!-- Account Settings Card -->
                    <section class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm border border-surface-variant/50 relative overflow-hidden group">
                        <h2 class="font-headline text-xl font-bold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">account_circle</span>
                            Account Profile
                        </h2>
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <!-- Avatar Upload -->
                            <div class="relative inline-block group/avatar shrink-0">
                                <img alt="Profile" class="w-24 h-24 rounded-full object-cover border-4 border-surface shadow-sm" src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode(auth()->user()->name) }}&backgroundColor=fbf9f0"/>
                                <button aria-label="Edit Profile Picture" class="absolute bottom-0 right-0 bg-primary text-white rounded-full p-2 shadow-sm transform translate-y-1/4 translate-x-1/4 hover:scale-105 transition-transform">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </button>
                            </div>
                            <!-- Form Fields -->
                            <form method="POST" action="{{ route('profile.update') }}" class="flex-1 space-y-5 w-full">
                                @csrf
                                @method('patch')
                                
                                <div>
                                    <label class="block font-label text-sm font-bold mb-2 text-on-surface-variant uppercase tracking-wider" for="name">Chef Name</label>
                                    <input class="w-full bg-surface-container-high border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/40 transition-shadow text-on-surface font-body" id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required/>
                                    @error('name', 'updateProfileInformation')
                                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block font-label text-sm font-bold mb-2 text-on-surface-variant uppercase tracking-wider" for="email">Email Address</label>
                                    <input class="w-full bg-surface-container-high border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/40 transition-shadow text-on-surface font-body" id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required/>
                                    @error('email', 'updateProfileInformation')
                                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                @if (session('status') === 'profile-updated')
                                    <p class="text-primary text-sm font-bold">Profile updated successfully!</p>
                                @endif

                                <div class="pt-2">
                                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-primary to-primary-container text-white font-bold text-sm shadow-sm hover:opacity-90 transition-opacity">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </section>

                    <!-- Preferences Card -->
                    <section class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm border border-surface-variant/50">
                        <h2 class="font-headline text-xl font-bold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">tune</span>
                            Environment Preferences
                        </h2>
                        <div class="space-y-6">
                            <!-- Toggle Item 1 -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-body font-bold text-on-surface">Evening Atmosphere (Dark Mode)</p>
                                    <p class="font-body text-sm text-on-surface-variant mt-1">Dim the kitchen lights for late-night prep.</p>
                                </div>
                                <button aria-checked="false" class="relative inline-flex h-6 w-11 items-center rounded-full bg-surface-variant transition-colors focus:outline-none" role="switch">
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white translate-x-1 transition-transform"></span>
                                </button>
                            </div>
                            <div class="h-px bg-surface-variant/50 w-full"></div>
                            <!-- Toggle Item 2 -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-body font-bold text-on-surface">Pantry Notifications</p>
                                    <p class="font-body text-sm text-on-surface-variant mt-1">Receive alerts for low ingredient stock.</p>
                                </div>
                                <button aria-checked="true" class="relative inline-flex h-6 w-11 items-center rounded-full bg-primary transition-colors focus:outline-none" role="switch">
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white translate-x-6 transition-transform"></span>
                                </button>
                            </div>
                            <div class="h-px bg-surface-variant/50 w-full"></div>
                            <!-- Toggle Item 3 -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-body font-bold text-on-surface">Culinary Soundscapes</p>
                                    <p class="font-body text-sm text-on-surface-variant mt-1">Enable ambient chopping and sizzling sounds.</p>
                                </div>
                                <button aria-checked="true" class="relative inline-flex h-6 w-11 items-center rounded-full bg-primary transition-colors focus:outline-none" role="switch">
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white translate-x-6 transition-transform"></span>
                                </button>
                            </div>
                        </div>
                    </section>

                    <!-- Security Card -->
                    <section class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm border border-surface-variant/50">
                        <h2 class="font-headline text-xl font-bold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">shield</span>
                            Kitchen Security
                        </h2>
                        <div class="space-y-6">
                            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between p-4 bg-surface-container-low rounded-xl border border-surface-variant">
                                <div>
                                    <p class="font-body font-bold text-on-surface">Password</p>
                                    <p class="font-body text-sm text-on-surface-variant mt-1">Last changed some time ago</p>
                                    @if (session('status') === 'password-updated')
                                        <p class="text-primary text-xs font-bold mt-1">Password updated successfully!</p>
                                    @endif
                                </div>
                                <button onclick="openPasswordModal()" class="px-5 py-2 rounded-xl border border-outline-variant/50 text-primary font-bold text-sm hover:bg-surface-container-highest transition-colors">
                                    Update Password
                                </button>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between pt-4">
                                <div>
                                    <p class="font-body font-bold text-error">Close Kitchen (Delete Account)</p>
                                    <p class="font-body text-sm text-on-surface-variant mt-1">Permanently remove your recipes and data.</p>
                                </div>
                                <button onclick="openDeleteModal()" class="px-5 py-2 rounded-xl text-error font-bold text-sm hover:bg-error/10 transition-colors">
                                    Delete Account
                                </button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar.classList.contains('-translate-x-full')) {
                overlay.classList.remove('hidden');
                requestAnimationFrame(() => {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('opacity-0');
                });
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        // Logout Modal Functions
        function openLogoutModal(e) {
            e.preventDefault();
            const modal = document.getElementById('logout-modal');
            const content = document.getElementById('logout-modal-content');
            
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    modal.classList.remove('opacity-0');
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                });
            });
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logout-modal');
            const content = document.getElementById('logout-modal-content');
            
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Notification Logic
        function toggleNotifications() {
            const panel = document.getElementById('notif-panel');
            const badge = document.getElementById('notif-badge');
            
            if (panel.classList.contains('hidden')) {
                // Open panel
                panel.classList.remove('hidden');
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        panel.classList.remove('opacity-0', 'scale-95');
                        panel.classList.add('opacity-100', 'scale-100');
                    });
                });
                
                // Hide badge red dot as it's viewed
                if(badge) badge.classList.add('hidden');
            } else {
                // Close panel
                panel.classList.remove('opacity-100', 'scale-100');
                panel.classList.add('opacity-0', 'scale-95');
                setTimeout(() => panel.classList.add('hidden'), 200);
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const panel = document.getElementById('notif-panel');
            const btn = document.getElementById('notif-btn');
            if (panel && !panel.classList.contains('hidden')) {
                if (!panel.contains(event.target) && !btn.contains(event.target)) {
                    panel.classList.remove('opacity-100', 'scale-100');
                    panel.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => panel.classList.add('hidden'), 200);
                }
            }
        });

        // Password Modal Functions
        function openPasswordModal() {
            const modal = document.getElementById('password-modal');
            const content = document.getElementById('password-modal-content');
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            });
        }

        function closePasswordModal() {
            const modal = document.getElementById('password-modal');
            const content = document.getElementById('password-modal-content');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        // Delete Account Modal Functions
        function openDeleteModal() {
            const modal = document.getElementById('delete-modal');
            const content = document.getElementById('delete-modal-content');
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            });
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            const content = document.getElementById('delete-modal-content');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        // Open modals if there are validation errors
        window.addEventListener('DOMContentLoaded', () => {
            @if($errors->updatePassword->any())
                openPasswordModal();
            @endif
            @if($errors->userDeletion->any())
                openDeleteModal();
            @endif
        });
    </script>

    <!-- Logout Modal Container -->
    <div id="logout-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 hidden opacity-0 transition-all duration-300 ease-in-out">
        <!-- Blurred Background -->
        <div class="absolute inset-0 bg-surface/80 backdrop-blur-md" onclick="closeLogoutModal()"></div>
        
        <!-- The Modal -->
        <div class="bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-ambient p-8 relative overflow-hidden flex flex-col items-center text-center transform scale-95 transition-transform duration-300 z-10" id="logout-modal-content">
            <!-- Decorative Icon -->
            <div class="mb-6 h-16 w-16 bg-surface-container-low rounded-full flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">
                    door_open
                </span>
            </div>
            <!-- Typography -->
            <h2 class="font-headline text-2xl font-bold text-primary mb-3 tracking-tight">
                Yakin ingin keluar, Chef?
            </h2>
            <p class="font-body text-on-surface-variant text-base mb-8 leading-relaxed max-w-[280px]">
                Pastikan resepmu sudah tersimpan rapi sebelum meninggalkan dapur.
            </p>
            <!-- Actions -->
            <div class="w-full flex flex-col sm:flex-row gap-4">
                <button onclick="closeLogoutModal()" class="flex-1 py-3 px-6 rounded-lg border border-outline-variant/30 text-primary font-label font-bold hover:bg-surface-container-low transition-colors duration-200">
                    Batal
                </button>
                <form method="POST" action="/logout" class="flex-1 flex">
                    <button type="submit" class="w-full py-3 px-6 rounded-lg bg-gradient-to-r from-primary to-primary-container text-white font-label font-bold hover:opacity-90 transition-opacity duration-200 shadow-sm">
                        Iya, Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const forceStyle = document.getElementById('force-hover-style');
            
            if (sidebar) {
                sidebar.addEventListener('mouseenter', () => {
                    sessionStorage.setItem('sidebarHovered', 'true');
                });
                
                sidebar.addEventListener('mouseleave', () => {
                    sessionStorage.setItem('sidebarHovered', 'false');
                    if (forceStyle) {
                        forceStyle.remove();
                    }
                });
            }
        });
    </script>
    <!-- Password Update Modal -->
    <div id="password-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 hidden opacity-0 transition-all duration-300 ease-in-out">
        <div class="absolute inset-0 bg-surface/80 backdrop-blur-md" onclick="closePasswordModal()"></div>
        <div class="bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-ambient p-8 relative overflow-hidden transform scale-95 transition-transform duration-300 z-10" id="password-modal-content">
            <h2 class="font-headline text-2xl font-bold text-primary mb-6 tracking-tight text-center">Update Password</h2>
            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('put')
                <div>
                    <label class="block font-label text-xs font-bold mb-2 text-on-surface-variant uppercase" for="current_password">Current Password</label>
                    <input class="w-full bg-surface-container-high border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/40 text-on-surface" id="current_password" name="current_password" type="password" required/>
                    @error('current_password', 'updatePassword')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block font-label text-xs font-bold mb-2 text-on-surface-variant uppercase" for="password">New Password</label>
                    <input class="w-full bg-surface-container-high border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/40 text-on-surface" id="password" name="password" type="password" required/>
                    @error('password', 'updatePassword')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block font-label text-xs font-bold mb-2 text-on-surface-variant uppercase" for="password_confirmation">Confirm Password</label>
                    <input class="w-full bg-surface-container-high border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/40 text-on-surface" id="password_confirmation" name="password_confirmation" type="password" required/>
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closePasswordModal()" class="flex-1 py-3 rounded-lg border border-outline-variant/30 text-primary font-bold hover:bg-surface-container-low transition-colors">Cancel</button>
                    <button type="submit" class="flex-1 py-3 rounded-lg bg-gradient-to-r from-primary to-primary-container text-white font-bold hover:opacity-90 transition-opacity">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div id="delete-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 hidden opacity-0 transition-all duration-300 ease-in-out">
        <div class="absolute inset-0 bg-surface/80 backdrop-blur-md" onclick="closeDeleteModal()"></div>
        <div class="bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-ambient p-8 relative overflow-hidden transform scale-95 transition-transform duration-300 z-10" id="delete-modal-content">
            <h2 class="font-headline text-2xl font-bold text-error mb-4 tracking-tight text-center">Delete Account</h2>
            <p class="text-on-surface-variant text-center mb-6">Are you sure you want to delete your account? This action cannot be undone.</p>
            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')
                <div>
                    <label class="block font-label text-xs font-bold mb-2 text-on-surface-variant uppercase" for="delete_password">Password</label>
                    <input class="w-full bg-surface-container-high border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-error/40 text-on-surface" id="delete_password" name="password" type="password" placeholder="Enter password to confirm" required/>
                    @error('password', 'userDeletion')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 py-3 rounded-lg border border-outline-variant/30 text-primary font-bold hover:bg-surface-container-low transition-colors">Cancel</button>
                    <button type="submit" class="flex-1 py-3 rounded-lg bg-error text-white font-bold hover:opacity-90 transition-opacity">Delete Account</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
