<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Chef Simulator - Pantry</title>
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
                        "on-surface-variant": "#6e7a6d",
                        "surface-container-low": "#f6f4eb",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#eae8e0",
                        error: "#ba1a1a",
                        "outline-variant": "#becabb"
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans", "sans-serif"],
                        display: ["Plus Jakarta Sans", "sans-serif"],
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
        .organic-shadow { box-shadow: 0 12px 40px 0 rgba(27,28,23,0.05); }
        .ambient-shadow { box-shadow: 0 12px 40px 0 rgba(27, 28, 23, 0.05); }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e4e3da; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #becabb; }
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
            <a href="/pantry" class="flex items-center bg-primary text-white shadow-md shadow-primary/20 hover:bg-primary rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
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
            <a href="/settings" class="flex items-center text-secondary hover:bg-surface-container-high rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined">settings</span>
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
                        </div>
                        <div class="p-3 border-t border-surface-variant text-center bg-surface-container-lowest">
                            <a href="#" class="text-sm font-bold text-primary hover:text-primary-container transition-colors">Lihat Semua Notifikasi</a>
                        </div>
                    </div>
                </div>
                <button class="text-primary hover:bg-surface-container-high p-2 rounded-full transition-colors">
                    <span class="material-symbols-outlined icon-fill">favorite</span>
                </button>
                <a href="/settings">
                    <img alt="User Avatar" class="w-9 h-9 rounded-full object-cover ml-2 border border-surface-variant cursor-pointer hover:border-primary transition-colors" src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode(auth()->user()->name) }}&backgroundColor=fbf9f0"/>
                </a>
            </div>
        </nav>

        <!-- Main Content Canvas -->
        <main class="flex-1 overflow-y-auto w-full px-6 py-8 custom-scrollbar">
            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-12">
                <!-- Left Side: Pantry Content -->
                <div class="flex-1 flex flex-col gap-8 pb-20">
                    <!-- Header & Search -->
                    <div class="flex flex-col gap-6">
                        @if(session('success'))
                            <div class="bg-primary/10 border border-primary/20 text-primary px-6 py-4 rounded-xl flex items-center gap-3 animate-pulse">
                                <span class="material-symbols-outlined">check_circle</span>
                                <span class="font-bold text-sm">{{ session('success') }}</span>
                            </div>
                        @endif
                        <div class="flex items-baseline justify-between mb-2">
                            <h2 class="text-3xl font-display font-bold text-on-surface tracking-tight">Dapur Saya</h2>
                            <span class="text-sm font-medium text-secondary">Inventory</span>
                        </div>
                        <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
                            <!-- Chips -->
                            <div class="flex flex-wrap gap-3">
                                @php
                                    $currentCategory = request('category', 'Semua');
                                    $categories = ['Semua', 'Protein', 'Sayuran', 'Bumbu', 'Karbohidrat'];
                                @endphp

                                @foreach($categories as $cat)
                                    <a href="{{ route('pantry', ['category' => $cat]) }}" 
                                       class="px-5 py-2 rounded-xl text-sm font-bold shadow-sm transition-all hover:-translate-y-0.5 {{ $currentCategory === $cat ? 'bg-primary text-white' : 'bg-surface-container-lowest text-secondary border border-surface-variant hover:bg-surface-bright' }}">
                                        {{ $cat }}
                                    </a>
                                @endforeach
                            </div>
                            <!-- Mobile Search -->
                            <div class="relative w-full md:w-auto md:hidden">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-secondary">search</span>
                                <input class="w-full bg-surface-container-lowest rounded-xl py-3 pl-12 pr-4 border border-surface-variant focus:outline-none focus:ring-2 focus:ring-primary/40 text-sm" placeholder="Find ingredient..." type="text"/>
                            </div>
                        </div>
                    </div>

                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($pantryItems as $item)
                            <div class="bg-surface-container-lowest rounded-2xl p-6 flex flex-col gap-4 ambient-shadow hover:shadow-md hover:-translate-y-1 transition-all duration-300 group cursor-pointer border border-surface-variant/50 relative overflow-hidden">
                                @if($item->status === 'Menipis')
                                    <div class="absolute top-0 left-0 w-full h-1.5 bg-error/80"></div>
                                @endif
                                <div class="flex justify-between items-start">
                                    @php
                                        $icon = 'inventory_2';
                                        $colorClass = 'text-primary';
                                        $bgColorClass = 'bg-surface-container-low';
                                        
                                        switch($item->category) {
                                            case 'Protein':
                                                $icon = 'set_meal';
                                                $colorClass = 'text-secondary';
                                                break;
                                            case 'Sayuran':
                                                $icon = 'eco';
                                                $colorClass = 'text-primary';
                                                break;
                                            case 'Bumbu':
                                                $icon = 'nutrition';
                                                $colorClass = 'text-secondary';
                                                break;
                                            case 'Karbohidrat':
                                                $icon = 'bakery_dining';
                                                $colorClass = 'text-primary';
                                                break;
                                        }

                                        if ($item->status === 'Menipis') {
                                            $colorClass = 'text-error';
                                            $bgColorClass = 'bg-error/5';
                                        }
                                    @endphp
                                    <div class="w-14 h-14 rounded-full {{ $bgColorClass }} flex items-center justify-center {{ $colorClass }} group-hover:opacity-80 transition-colors">
                                        <span class="material-symbols-outlined text-3xl icon-fill">{{ $icon }}</span>
                                    </div>
                                    @if($item->status === 'Menipis')
                                        <span class="bg-error/10 text-error text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">Stok Menipis</span>
                                    @else
                                        <button class="text-secondary/50 hover:text-secondary transition-colors"><span class="material-symbols-outlined">more_vert</span></button>
                                    @endif
                                </div>
                                <div class="mt-2">
                                    <h3 class="text-lg font-bold text-on-surface">{{ $item->name }}</h3>
                                    <p class="text-sm font-bold {{ $item->status === 'Menipis' ? 'text-error' : 'text-secondary' }} mt-1">
                                        {{ number_format($item->quantity, 1) }} {{ $item->unit }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        @if($pantryItems->isEmpty())
                            <div class="col-span-full py-20 flex flex-col items-center justify-center text-secondary/40">
                                <span class="material-symbols-outlined text-6xl mb-4">inventory_2</span>
                                <p class="text-lg font-medium">Dapur masih kosong. Ayo tambahkan bahan!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Side: Quick Add Panel -->
                <aside class="w-full xl:w-[340px] flex-shrink-0">
                    <div class="sticky top-8 bg-surface-container-lowest rounded-2xl p-8 ambient-shadow border border-surface-variant/50">
                        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-surface-variant">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined icon-fill">add_circle</span>
                            </div>
                            <h3 class="text-xl font-headline font-bold text-on-surface tracking-tight">Quick Add</h3>
                        </div>
                        <form method="POST" action="{{ route('pantry.store') }}" class="flex flex-col gap-6">
                            @csrf
                            <div class="flex flex-col gap-2.5">
                                <label class="text-[11px] font-bold text-secondary uppercase tracking-widest">Ingredient Name</label>
                                <input name="name" class="w-full bg-surface-container-high rounded-xl py-3.5 px-4 border-none focus:outline-none focus:ring-2 focus:ring-primary/40 focus:bg-surface transition-all text-on-surface font-medium placeholder:text-secondary/50" placeholder="e.g. Olive Oil" type="text" required/>
                            </div>
                            <div class="flex flex-col gap-2.5">
                                <label class="text-[11px] font-bold text-secondary uppercase tracking-widest">Category</label>
                                <div class="relative">
                                    <select name="category" class="w-full bg-surface-container-high rounded-xl py-3.5 px-4 appearance-none border-none focus:outline-none focus:ring-2 focus:ring-primary/40 focus:bg-surface transition-all text-on-surface font-medium">
                                        <option value="Bumbu">Bumbu</option>
                                        <option value="Protein">Protein</option>
                                        <option value="Sayuran">Sayuran</option>
                                        <option value="Karbohidrat">Karbohidrat</option>
                                    </select>
                                    <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-secondary">expand_more</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2.5">
                                <label class="text-[11px] font-bold text-secondary uppercase tracking-widest">Quantity</label>
                                <div class="flex gap-3">
                                    <input name="quantity" class="w-2/3 bg-surface-container-high rounded-xl py-3.5 px-4 border-none focus:outline-none focus:ring-2 focus:ring-primary/40 focus:bg-surface transition-all text-on-surface font-medium" placeholder="0" type="number" step="0.01" required/>
                                    <select name="unit" class="w-1/3 bg-surface-container-high rounded-xl py-3.5 px-2 appearance-none border-none focus:outline-none focus:ring-2 focus:ring-primary/40 focus:bg-surface transition-all text-on-surface font-medium text-center">
                                        <option value="kg">kg</option>
                                        <option value="gr">gr</option>
                                        <option value="L">L</option>
                                        <option value="pcs">pcs</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="mt-4 w-full bg-gradient-to-r from-primary to-primary-container text-white font-bold py-4 rounded-xl shadow-sm hover:shadow-md active:scale-95 transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm font-bold">add</span> Add to Pantry
                            </button>
                        </form>
                    </div>
                </aside>
            </div>
            
            <!-- Footer -->
            <footer class="w-full mt-12 mb-8 py-8 border-t border-surface-variant text-xs uppercase tracking-widest font-bold text-outline flex flex-col md:flex-row justify-between items-center px-4 max-w-7xl mx-auto gap-6 relative z-10">
                <div class="text-sm font-black text-primary">The Atelier</div>
                <div class="flex flex-wrap justify-center gap-6">
                    <a class="hover:text-primary transition-colors" href="#">About</a>
                    <a class="hover:text-primary transition-colors" href="#">Guidelines</a>
                    <a class="hover:text-primary transition-colors" href="#">Privacy</a>
                    <a class="hover:text-primary transition-colors" href="#">Support</a>
                </div>
                <div class="text-[10px]">© 2024 The Culinary Atelier.</div>
            </footer>
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
                panel.classList.remove('hidden');
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        panel.classList.remove('opacity-0', 'scale-95');
                        panel.classList.add('opacity-100', 'scale-100');
                    });
                });
                if(badge) badge.classList.add('hidden');
            } else {
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
    </script>

    <!-- Logout Modal Container -->
    <div id="logout-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 hidden opacity-0 transition-all duration-300 ease-in-out">
        <!-- Blurred Background -->
        <div class="absolute inset-0 bg-surface/80 backdrop-blur-md" onclick="closeLogoutModal()"></div>
        
        <!-- The Modal -->
        <div class="bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-ambient p-8 relative overflow-hidden flex flex-col items-center text-center transform scale-95 transition-transform duration-300 z-10" id="logout-modal-content">
            <!-- Decorative Icon -->
            <div class="mb-6 h-16 w-16 bg-surface-container-low rounded-full flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-4xl icon-fill">
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
                <button onclick="closeLogoutModal()" class="flex-1 py-3 px-6 rounded-xl border border-outline-variant/30 text-primary font-label font-bold hover:bg-surface-container-low transition-colors duration-200">
                    Batal
                </button>
                <form method="POST" action="/logout" class="flex-1 flex">
                    <button type="submit" class="w-full py-3 px-6 rounded-xl bg-gradient-to-r from-primary to-primary-container text-white font-label font-bold hover:opacity-90 transition-opacity duration-200 shadow-sm">
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
</body>
</html>
