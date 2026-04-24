<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Chef Simulator - Explore Recipes</title>
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
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .glass-nav { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
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
<body class="font-body text-on-surface antialiased pb-24 md:pb-0 flex flex-col md:flex-row min-h-screen">

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
                        src="https://api.dicebear.com/7.x/avataaars/svg?seed=ChefJuna&backgroundColor=fbf9f0" />
                </a>
            </div>
            <div class="text-center mt-3 opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                <h2 class="text-lg font-black text-primary font-headline tracking-tight">The Atelier</h2>
                <p class="text-[10px] font-bold text-secondary tracking-widest uppercase">Chef Simulator</p>
            </div>
        </div>

        <div class="px-6 md:px-3 group-hover/sidebar:px-6 transition-all duration-300 w-full mt-6 shrink-0">
            <button
                class="w-full bg-gradient-to-r from-primary to-primary-container text-white rounded-xl py-3 md:py-3 px-4 md:px-0 group-hover/sidebar:px-4 font-bold text-sm organic-shadow hover:shadow-lg hover:shadow-primary/30 active:scale-95 transition-all duration-200 flex justify-center items-center overflow-hidden">
                <span class="material-symbols-outlined text-[20px] shrink-0">add_circle</span> 
                <span class="whitespace-nowrap font-bold opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300 w-auto md:w-0 group-hover/sidebar:w-auto overflow-hidden pl-2">Create Recipe</span>
            </button>
        </div>

        <nav class="flex-1 space-y-1.5 font-medium px-4 md:px-3 group-hover/sidebar:px-4 transition-all duration-300 mt-6 shrink-0">
            <a href="/dashboard" class="flex items-center text-secondary hover:bg-surface-container-high rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined">grid_view</span>
                </div>
                <span class="whitespace-nowrap pr-4 font-medium opacity-100 md:opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-300">Home</span>
            </a>
            <a href="/explore" class="flex items-center bg-primary text-white shadow-md shadow-primary/20 hover:bg-primary rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">restaurant_menu</span>
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

    <div id="main-content" class="md:ml-20 flex-1 flex flex-col relative transition-all duration-300 w-full">

    <nav class="sticky top-0 w-full z-40 flex justify-between items-center px-6 py-4 bg-[#fbf9f0]/80 glass-nav border-b border-surface-variant/50 transition-colors">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="text-primary hover:bg-surface-container-high p-2 rounded-full transition-colors duration-200 flex md:hidden">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <a class="text-xl font-bold italic text-primary tracking-tight hidden md:block" href="/dashboard">Chef Simulator</a>
            <h1 class="text-xl md:text-2xl font-bold tracking-tighter text-primary md:hidden">The Atelier</h1>
        </div>
        
        <div class="flex-1 max-w-xl mx-8 relative hidden lg:block">
            <input id="searchInput" oninput="filterRecipes()" class="w-full bg-surface-container-high border-none rounded-full py-2.5 pl-12 pr-4 text-sm text-on-surface focus:ring-2 focus:ring-primary/30 transition-all font-body placeholder:text-on-surface-variant" placeholder="Cari resep, bahan, atau alat..." type="text"/>
            <span class="material-symbols-outlined absolute left-4 top-2.5 text-on-surface-variant text-[20px]">search</span>
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
                <div id="notif-panel" class="absolute right-0 mt-2 w-80 md:w-96 bg-surface-container-lowest rounded-2xl organic-shadow border border-surface-variant z-50 hidden opacity-0 transform scale-95 transition-all duration-200 origin-top-right overflow-hidden">
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
            <button class="text-primary hover:bg-surface-container-high p-2 rounded-full transition-colors">
                <span class="material-symbols-outlined icon-fill">favorite</span>
            </button>
            <a href="/settings">
                <img alt="User Avatar" class="w-9 h-9 rounded-full object-cover ml-2 border border-surface-variant" src="https://api.dicebear.com/7.x/avataaars/svg?seed=ChefJuna&backgroundColor=fbf9f0"/>
            </a>
        </div>
    </nav>

    <main class="pt-6 md:pt-28 px-4 md:px-8 max-w-7xl mx-auto">
        
        <section class="relative bg-surface-container-lowest rounded-[24px] overflow-hidden mb-10 shadow-sm border border-surface-variant/40">
            <div class="absolute inset-0 z-0 opacity-30">
                <img alt="Kitchen background" class="w-full h-full object-cover grayscale" src="https://images.unsplash.com/photo-1556911220-bff31c812dba?q=80&w=1200&auto=format&fit=crop"/>
                <div class="absolute inset-0 bg-gradient-to-r from-surface-container-lowest via-surface-container-lowest/90 to-transparent"></div>
            </div>
            <div class="relative z-10 py-16 px-8 md:px-12 md:w-2/3">
                <h1 class="text-4xl md:text-[42px] font-extrabold text-on-surface tracking-tight mb-4 leading-tight">Temukan Inspirasi Masak</h1>
                <p class="text-base text-on-surface-variant mb-0 max-w-md leading-relaxed">Jelajahi ribuan resep dari dapur lokal hingga hidangan internasional, dikurasi khusus untuk pengalaman masakmu.</p>
            </div>
        </section>

        <section class="mb-10 overflow-x-auto hide-scrollbar">
            <div class="flex gap-3 min-w-max px-1" id="categoryFilters">
                <button onclick="setCategory('Semua', this)" class="category-btn active bg-primary text-white font-bold text-sm px-6 py-2.5 rounded-full shadow-md shadow-primary/20 hover:bg-primary-container transition-colors" data-default-class="bg-white border border-outline-variant/30 text-on-surface font-medium text-sm px-6 py-2.5 rounded-full hover:bg-surface-container-low transition-colors shadow-sm" data-active-class="bg-primary text-white font-bold text-sm px-6 py-2.5 rounded-full shadow-md shadow-primary/20 hover:bg-primary-container transition-colors">Semua</button>
                <button onclick="setCategory('Sarapan', this)" class="category-btn bg-white border border-outline-variant/30 text-on-surface font-medium text-sm px-6 py-2.5 rounded-full hover:bg-surface-container-low transition-colors shadow-sm" data-default-class="bg-white border border-outline-variant/30 text-on-surface font-medium text-sm px-6 py-2.5 rounded-full hover:bg-surface-container-low transition-colors shadow-sm" data-active-class="bg-primary text-white font-bold text-sm px-6 py-2.5 rounded-full shadow-md shadow-primary/20 hover:bg-primary-container transition-colors">Sarapan</button>
                <button onclick="setCategory('Makan Siang', this)" class="category-btn bg-white border border-outline-variant/30 text-on-surface font-medium text-sm px-6 py-2.5 rounded-full hover:bg-surface-container-low transition-colors shadow-sm" data-default-class="bg-white border border-outline-variant/30 text-on-surface font-medium text-sm px-6 py-2.5 rounded-full hover:bg-surface-container-low transition-colors shadow-sm" data-active-class="bg-primary text-white font-bold text-sm px-6 py-2.5 rounded-full shadow-md shadow-primary/20 hover:bg-primary-container transition-colors">Makan Siang</button>
                <button onclick="setCategory('Makan Malam', this)" class="category-btn bg-white border border-outline-variant/30 text-on-surface font-medium text-sm px-6 py-2.5 rounded-full hover:bg-surface-container-low transition-colors shadow-sm" data-default-class="bg-white border border-outline-variant/30 text-on-surface font-medium text-sm px-6 py-2.5 rounded-full hover:bg-surface-container-low transition-colors shadow-sm" data-active-class="bg-primary text-white font-bold text-sm px-6 py-2.5 rounded-full shadow-md shadow-primary/20 hover:bg-primary-container transition-colors">Makan Malam</button>
                <button onclick="setCategory('Dessert', this)" class="category-btn bg-white border border-outline-variant/30 text-on-surface font-medium text-sm px-6 py-2.5 rounded-full hover:bg-surface-container-low transition-colors shadow-sm" data-default-class="bg-white border border-outline-variant/30 text-on-surface font-medium text-sm px-6 py-2.5 rounded-full hover:bg-surface-container-low transition-colors shadow-sm" data-active-class="bg-primary text-white font-bold text-sm px-6 py-2.5 rounded-full shadow-md shadow-primary/20 hover:bg-primary-container transition-colors">Dessert</button>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="recipesContainer">
            @foreach($recipes as $recipe)
            <article class="recipe-card bg-white rounded-3xl overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative border border-surface-variant/60 flex flex-col" data-category="{{ $recipe['category'] }}" data-title="{{ $recipe['title'] }}" data-id="{{ $recipe['id'] }}">
                <button class="absolute top-4 right-4 z-10 bg-white p-2 rounded-full text-secondary hover:text-error transition-colors shadow-md bookmark-btn" onclick="toggleBookmark(this, {{ $recipe['id'] }})">
                    <span class="material-symbols-outlined icon-bookmark text-[20px]">bookmark</span>
                </button>
                <div class="relative h-56 overflow-hidden bg-surface-container-low">
                    <img alt="{{ $recipe['title'] }}" class="w-full h-full object-cover mix-blend-multiply group-hover:scale-110 transition-transform duration-700" src="{{ $recipe['image'] }}"/>
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-primary font-bold text-[11px] uppercase tracking-wider">{{ $recipe['category'] }}</span>
                        <span class="flex items-center text-[11px] text-on-surface-variant font-medium"><span class="material-symbols-outlined text-[14px] mr-1">schedule</span> {{ $recipe['time'] }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-2 leading-tight">
                        <a href="{{ route('recipe.detail', ['slug' => $recipe['slug']]) }}" class="hover:text-primary transition-colors before:absolute before:inset-0">
                            {{ $recipe['title'] }}
                        </a>
                    </h3>
                    <p class="text-sm text-on-surface-variant mb-6 line-clamp-2 relative z-10">{{ $recipe['description'] }}</p>
                    <div class="flex justify-between items-center mt-auto pt-4 border-t border-surface-variant/50 relative z-10">
                        <span class="text-xs font-bold text-secondary flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">local_fire_department</span> {{ $recipe['difficulty'] }}</span>
                        <a href="/chat" class="text-primary font-bold text-sm flex items-center hover:text-primary-container transition-colors group/btn">Masak <span class="material-symbols-outlined text-[18px] ml-1 transform group-hover/btn:translate-x-1 transition-transform">arrow_forward</span></a>
                    </div>
                </div>
            </article>
            @endforeach

            <!-- Empty State (Hidden by default) -->
            <div id="emptyState" class="hidden col-span-1 md:col-span-2 lg:col-span-3 text-center py-20">
                <div class="w-24 h-24 bg-surface-container-high rounded-full flex items-center justify-center mx-auto mb-6 text-secondary">
                    <span class="material-symbols-outlined text-[48px]">search_off</span>
                </div>
                <h3 class="text-2xl font-bold text-on-surface mb-2">Yah, resep tidak ditemukan</h3>
                <p class="text-on-surface-variant max-w-md mx-auto">Coba cari dengan kata kunci lain atau ubah filter kategori masakan di atas.</p>
                <button onclick="document.getElementById('searchInput').value=''; filterRecipes();" class="mt-6 bg-primary text-white font-bold py-3 px-8 rounded-full hover:bg-primary-container transition-colors">Lihat Semua Resep</button>
            </div>
        </section>

        <!-- Load More Button -->
        <div class="flex justify-center mb-16" id="loadMoreContainer">
            <button class="bg-surface-container-lowest border border-outline-variant/30 text-primary font-bold text-sm px-8 py-3.5 rounded-full hover:bg-surface-container-low transition-colors shadow-sm flex items-center gap-2 group">
                <span class="material-symbols-outlined transform group-hover:rotate-180 transition-transform duration-500">autorenew</span>
                Tampilkan Lebih Banyak
            </button>
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

        let currentCategory = 'Semua';

        function filterRecipes() {
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            const recipes = document.querySelectorAll('.recipe-card');
            const emptyState = document.getElementById('emptyState');
            const loadMore = document.getElementById('loadMoreContainer');
            let visibleCount = 0;

            recipes.forEach(recipe => {
                const title = recipe.getAttribute('data-title').toLowerCase();
                const category = recipe.getAttribute('data-category');
                const matchesSearch = title.includes(searchQuery);
                const matchesCategory = currentCategory === 'Semua' || category === currentCategory;

                if (matchesSearch && matchesCategory) {
                    recipe.style.display = 'flex';
                    visibleCount++;
                } else {
                    recipe.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
                loadMore.classList.add('hidden');
            } else {
                emptyState.classList.add('hidden');
                loadMore.classList.remove('hidden');
            }
        }

        function setCategory(category, buttonElement) {
            currentCategory = category;
            const buttons = document.querySelectorAll('.category-btn');
            buttons.forEach(btn => {
                btn.className = btn.getAttribute('data-default-class') + ' category-btn';
            });
            buttonElement.className = buttonElement.getAttribute('data-active-class') + ' category-btn active';
            filterRecipes();
        }

        function initBookmarks() {
            const savedBookmarks = JSON.parse(localStorage.getItem('chefBookmarks')) || [];
            document.querySelectorAll('.recipe-card').forEach(card => {
                const id = parseInt(card.getAttribute('data-id'));
                const icon = card.querySelector('.icon-bookmark');
                if (savedBookmarks.includes(id)) {
                    icon.classList.remove('text-secondary');
                    icon.classList.add('text-primary', 'icon-fill');
                } else {
                    icon.classList.remove('text-primary', 'icon-fill');
                    icon.classList.add('text-secondary');
                }
            });
        }

        function toggleBookmark(btn, id) {
            const icon = btn.querySelector('.icon-bookmark');
            let savedBookmarks = JSON.parse(localStorage.getItem('chefBookmarks')) || [];
            if (savedBookmarks.includes(id)) {
                savedBookmarks = savedBookmarks.filter(bId => bId !== id);
                icon.classList.remove('text-primary', 'icon-fill');
                icon.classList.add('text-secondary');
            } else {
                savedBookmarks.push(id);
                icon.classList.remove('text-secondary');
                icon.classList.add('text-primary', 'icon-fill');
            }
            localStorage.setItem('chefBookmarks', JSON.stringify(savedBookmarks));
        }

        document.addEventListener('DOMContentLoaded', () => {
            initBookmarks();
        });

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
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
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
        <div class="absolute inset-0 bg-surface/80 backdrop-blur-md" onclick="closeLogoutModal()"></div>
        <div class="bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-ambient p-8 relative overflow-hidden flex flex-col items-center text-center transform scale-95 transition-transform duration-300 z-10" id="logout-modal-content">
            <div class="mb-6 h-16 w-16 bg-surface-container-low rounded-full flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">door_open</span>
            </div>
            <h2 class="font-headline text-2xl font-bold text-primary mb-3 tracking-tight">Yakin ingin keluar, Chef?</h2>
            <p class="font-body text-on-surface-variant text-base mb-8 leading-relaxed max-w-[280px]">Pastikan resepmu sudah tersimpan rapi sebelum meninggalkan dapur.</p>
            <div class="w-full flex flex-col sm:flex-row gap-4">
                <button onclick="closeLogoutModal()" class="flex-1 py-3 px-6 rounded-xl border border-outline-variant/30 text-primary font-label font-bold hover:bg-surface-container-low transition-colors duration-200">Batal</button>
                <form method="POST" action="/logout" class="flex-1 flex">
                    @csrf
                    <button type="submit" class="w-full py-3 px-6 rounded-xl bg-gradient-to-r from-primary to-primary-container text-white font-label font-bold hover:opacity-90 transition-opacity duration-200 shadow-sm">Iya, Keluar</button>
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
                    if (forceStyle) { forceStyle.remove(); }
                });
            }
        });
    </script>
</body>
</html>