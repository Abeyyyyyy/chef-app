<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Chef Simulator - Main Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

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
                        "on-surface-variant": "#3e4a3e",
                        "surface-container-low": "#f6f4eb",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#eae8e0",
                        error: "#ba1a1a",
                        "error-container": "#ffdad6",
                        outline: "#6e7a6d",
                        "outline-variant": "#becabb"
                    },
                    fontFamily: {
                        sans: ["Plus Jakarta Sans", "sans-serif"],
                        headline: ["Plus Jakarta Sans", "sans-serif"],
                        display: ["Plus Jakarta Sans", "sans-serif"],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: theme('colors.surface');
            color: theme('colors.on-surface');
            background-image: url('data:image/svg+xml;utf8,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="%23006b2d" fill-opacity="0.03"/></svg>');
            background-attachment: fixed;
        }

        .organic-shadow {
            box-shadow: 0 12px 40px 0 rgba(27, 28, 23, 0.05);
        }

        /* Toast Animation */
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .toast-enter {
            animation: slideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .toast-leave {
            animation: fadeOut 0.3s ease-in forwards;
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

<body class="flex h-screen overflow-hidden text-sm md:text-base">

    <div id="toast-container" class="fixed top-20 right-8 z-[100] flex flex-col gap-3 pointer-events-none"></div>

    <div id="sidebar-overlay"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 hidden opacity-0 transition-all duration-300 ease-in-out"
        onclick="toggleSidebar()"></div>

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
            <a href="/dashboard" class="flex items-center bg-primary text-white shadow-md shadow-primary/20 hover:bg-primary rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">grid_view</span>
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

    <div id="main-content" class="md:ml-20 flex-1 flex flex-col relative overflow-hidden transition-all duration-300 w-full">

        <header
            class="sticky top-0 w-full flex items-center justify-between px-6 md:px-8 py-4 bg-surface/80 backdrop-blur-md border-b border-surface-variant z-20">
            <div class="flex items-center gap-4 md:gap-8">
                <button onclick="toggleSidebar()"
                    class="text-primary p-2 hover:bg-surface-variant rounded-full transition-colors flex md:hidden">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h1 class="text-xl md:text-2xl font-bold tracking-tighter text-primary md:hidden">The Atelier</h1>

                <nav class="hidden md:flex gap-6 text-sm font-bold">
                    <a class="text-primary border-b-2 border-primary pb-1" href="/explore">Browse</a>
                    <a class="text-outline-variant hover:text-primary transition-colors pb-1" href="/pantry">Pro Features</a>
                    <a class="text-outline-variant hover:text-primary transition-colors pb-1" href="/history">Journal</a>
                </nav>
            </div>

            <div class="flex items-center gap-2 md:gap-4 ml-auto">
                <div
                    class="hidden lg:flex items-center bg-white rounded-full px-4 py-2 w-64 border border-outline-variant/30 focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary transition-all organic-shadow">
                    <span class="material-symbols-outlined text-outline-variant mr-2 text-[20px]">search</span>
                    <input
                        class="bg-transparent border-none outline-none text-sm w-full placeholder-outline-variant text-on-surface"
                        placeholder="Cari resep..." type="text" />
                </div>
                <!-- Notification Dropdown -->
                <div class="relative">
                    <button id="notif-btn" onclick="toggleNotifications()"
                        class="text-secondary hover:bg-surface-container-high transition-colors p-2.5 rounded-full relative group">
                        <span class="material-symbols-outlined">notifications</span>
                        <span id="notif-badge"
                            class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-surface group-hover:border-surface-container-high transition-colors"></span>
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
                <a href="/settings" class="hidden md:block">
                    <img alt="User Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-surface-variant cursor-pointer hover:border-primary transition-colors"
                        src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode(auth()->user()->name) }}&backgroundColor=fbf9f0" />
                </a>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-8 pb-24 space-y-8 scroll-smooth custom-scrollbar">

            <!-- Top Row: Hero & Stats -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                
                <!-- Hero Banner (Col 1-2) -->
                <section class="lg:col-span-2 relative bg-surface-container-low rounded-3xl overflow-hidden p-6 md:p-10 organic-shadow flex flex-col justify-center border border-white group">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-secondary-container/30 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">wb_sunny</span> Pagi yang Indah
                            </span>
                        </div>
                        <h2 class="text-3xl md:text-5xl font-display font-bold tracking-tight text-on-surface mb-3 leading-tight">
                            Siap berkreasi,<br /><span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">{{ auth()->user()->name }}!</span>
                        </h2>
                        <p class="text-base text-secondary mb-8 font-medium max-w-lg">
                            Tantangan hari ini: Buat hidangan menggunakan <strong>rosemary</strong> dan <strong>bawang putih</strong>.
                        </p>
                        <a href="/chat" class="bg-gradient-to-r from-primary to-primary-container text-white px-8 py-4 rounded-2xl font-bold text-base inline-flex items-center gap-3 organic-shadow hover:shadow-lg hover:shadow-primary/30 active:scale-95 transition-all duration-300 w-max group/btn">
                            Mulai Simulasi Baru
                            <span class="material-symbols-outlined transform group-hover/btn:rotate-12 transition-transform" style="font-variation-settings: 'FILL' 1;">skillet</span>
                        </a>
                    </div>
                    
                    <!-- Decorative Image Right side -->
                    <div class="absolute right-0 bottom-0 h-[120%] w-1/2 hidden md:block opacity-20 transform translate-x-1/4 translate-y-1/4 group-hover:scale-105 transition-transform duration-1000 pointer-events-none">
                        <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover rounded-tl-[100px]" style="mask-image: linear-gradient(to left, black, transparent); -webkit-mask-image: linear-gradient(to left, black, transparent);" />
                    </div>
                </section>

                <!-- Profile/Stats Panel (Col 3) -->
                <section class="lg:col-span-1 bg-surface-container-lowest rounded-3xl p-6 md:p-8 organic-shadow border border-surface-variant/50 relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 inset-x-0 h-24 bg-gradient-to-b from-primary/10 to-transparent"></div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="relative mb-4 group">
                            <div class="absolute inset-0 bg-primary/20 rounded-full blur-md transform group-hover:scale-110 transition-transform"></div>
                            <img alt="Chef Avatar" class="w-20 h-20 rounded-full object-cover border-4 border-white relative z-10 shadow-md" src="https://api.dicebear.com/7.x/avataaars/svg?seed=ChefJuna&backgroundColor=fbf9f0" />
                        </div>
                        
                        <h3 class="text-xl font-bold text-on-surface mb-1">{{ auth()->user()->name }}</h3>
                        <p class="text-sm text-secondary font-medium mb-6">Culinary Enthusiast</p>
                        
                        <!-- Simple Stats Grid -->
                        <div class="w-full grid grid-cols-2 gap-3 mt-2">
                            <div class="flex flex-col items-center justify-center bg-surface-container-low py-4 rounded-2xl border border-surface-variant/50 hover:bg-surface-variant transition-colors">
                                <span class="text-2xl font-bold text-primary mb-1">{{ $recipesCreated }}</span>
                                <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Resep Dibuat</span>
                            </div>
                            <div class="flex flex-col items-center justify-center bg-surface-container-low py-4 rounded-2xl border border-surface-variant/50 hover:bg-surface-variant transition-colors">
                                <span class="text-2xl font-bold text-primary mb-1">{{ $savedRecipes }}</span>
                                <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Disimpan</span>
                            </div>
                        </div>
                        
                        <a href="/settings" class="mt-6 w-full py-3 bg-transparent border border-outline-variant/30 text-on-surface-variant font-bold text-sm rounded-xl hover:bg-surface-container-low hover:text-on-surface transition-colors flex justify-center items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">edit</span> Edit Profil
                        </a>
                    </div>
                </section>
            </div>

            <!-- Quick Actions Row -->
            <section>
                <h3 class="text-sm font-bold text-secondary uppercase tracking-widest mb-4 pl-2">Aksi Cepat</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="/chat" class="bg-white p-4 rounded-2xl organic-shadow hover:-translate-y-1 hover:shadow-lg transition-all duration-300 border border-surface-variant/30 flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors shrink-0">
                            <span class="material-symbols-outlined text-[20px]">history</span>
                        </div>
                        <div class="text-left overflow-hidden">
                            <p class="text-xs text-secondary font-medium truncate">Lanjutkan</p>
                            <p class="text-sm font-bold text-on-surface truncate">Sourdough</p>
                        </div>
                    </a>
                    
                    <a href="/explore" class="bg-white p-4 rounded-2xl organic-shadow hover:-translate-y-1 hover:shadow-lg transition-all duration-300 border border-surface-variant/30 flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-white transition-colors shrink-0">
                            <span class="material-symbols-outlined text-[20px]">search</span>
                        </div>
                        <div class="text-left overflow-hidden">
                            <p class="text-xs text-secondary font-medium truncate">Cari Inspirasi</p>
                            <p class="text-sm font-bold text-on-surface truncate">Resep Baru</p>
                        </div>
                    </a>

                    <a href="/pantry" class="bg-white p-4 rounded-2xl organic-shadow hover:-translate-y-1 hover:shadow-lg transition-all duration-300 border border-error/10 flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center text-error group-hover:bg-error group-hover:text-white transition-colors shrink-0">
                            <span class="material-symbols-outlined text-[20px]">kitchen</span>
                        </div>
                        <div class="text-left overflow-hidden">
                            <p class="text-xs text-error font-medium truncate">Stok Menipis</p>
                            <p class="text-sm font-bold text-on-surface truncate">Cek Pantry</p>
                        </div>
                    </a>

                    <a href="/community" class="bg-white p-4 rounded-2xl organic-shadow hover:-translate-y-1 hover:shadow-lg transition-all duration-300 border border-surface-variant/30 flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                            <span class="material-symbols-outlined text-[20px]">forum</span>
                        </div>
                        <div class="text-left overflow-hidden">
                            <p class="text-xs text-secondary font-medium truncate">Lagi Rame!</p>
                            <p class="text-sm font-bold text-on-surface truncate">Komunitas</p>
                        </div>
                    </a>
                </div>
            </section>

            <!-- Bento Grid Bottom Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                
                <!-- Trending Community (Col 1) -->
                <section class="lg:col-span-1 bg-surface-container-lowest rounded-3xl p-6 organic-shadow border border-surface-variant/50 flex flex-col">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary">trending_up</span> Trending
                        </h3>
                        <a href="/community" class="text-xs font-bold text-primary hover:underline">Lihat Forum</a>
                    </div>
                    
                    <div class="space-y-4 flex-1">
                        <div class="p-4 bg-surface-container-low rounded-2xl hover:bg-surface-variant transition-colors cursor-pointer border border-transparent hover:border-outline-variant/30">
                            <div class="flex items-center gap-3 mb-2">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Renatta" class="w-6 h-6 rounded-full bg-white border border-surface-variant" />
                                <span class="text-xs font-bold text-on-surface">Chef Renatta</span>
                            </div>
                            <p class="text-sm font-medium text-on-surface-variant line-clamp-2">Ada yang punya tips supaya kulit ayam panggang tetap crispy setelah 2 jam?</p>
                            <div class="flex items-center gap-4 mt-3 text-xs text-secondary font-medium">
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">favorite</span> 24</span>
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">chat_bubble</span> 12 balasan</span>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-surface-container-low rounded-2xl hover:bg-surface-variant transition-colors cursor-pointer border border-transparent hover:border-outline-variant/30">
                            <div class="flex items-center gap-3 mb-2">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Arnold" class="w-6 h-6 rounded-full bg-white border border-surface-variant" />
                                <span class="text-xs font-bold text-on-surface">Chef Arnold</span>
                            </div>
                            <p class="text-sm font-medium text-on-surface-variant line-clamp-2">Resep rahasia kaldu jamur vegan yang umami-nya nendang banget!</p>
                            <div class="flex items-center gap-4 mt-3 text-xs text-secondary font-medium">
                                <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">favorite</span> 156</span>
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">chat_bubble</span> 45 balasan</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Recommended Recipes Carousel (Col 2-3) -->
                <section class="lg:col-span-2 bg-surface-container-lowest rounded-3xl p-6 md:p-8 organic-shadow border border-surface-variant/50 flex flex-col">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-on-surface">Spesial Untukmu</h3>
                            <p class="text-sm text-secondary font-medium">Berdasarkan stok pantry dan level keahlianmu.</p>
                        </div>
                        <div class="flex gap-2 hidden sm:flex">
                            <button class="w-8 h-8 rounded-full border border-surface-variant flex items-center justify-center hover:bg-surface-variant hover:text-primary transition-colors cursor-not-allowed opacity-50"><span class="material-symbols-outlined text-[18px]">chevron_left</span></button>
                            <button class="w-8 h-8 rounded-full border border-surface-variant flex items-center justify-center hover:bg-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined text-[18px]">chevron_right</span></button>
                        </div>
                    </div>

                    <div class="flex gap-6 overflow-x-auto pb-4 custom-scrollbar snap-x flex-1">
                        <!-- Recipe 1 -->
                        <article class="min-w-[280px] w-[280px] snap-center group bg-white rounded-3xl overflow-hidden border border-surface-variant/50 hover:shadow-xl transition-all duration-300 hover:border-primary/30 relative flex flex-col">
                            <div class="relative h-40 overflow-hidden shrink-0">
                                <img src="https://images.unsplash.com/photo-1611270629569-8b357cb88da9?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Pasta Carbonara" />
                                <button onclick="toggleSave(this)" class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm p-1.5 rounded-full text-outline hover:text-error transition-colors z-10">
                                    <span class="material-symbols-outlined icon-save text-[20px]">favorite</span>
                                </button>
                                <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-lg text-xs font-bold text-primary flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">timer</span> 25m
                                </div>
                            </div>
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-secondary mb-1 block">Pasta Italia</span>
                                    <h4 class="text-lg font-bold text-on-surface mb-2 leading-tight group-hover:text-primary transition-colors">
                                        <a href="/recipe/pasta-carbonara" class="before:absolute before:inset-0">Pasta Carbonara Autentik</a>
                                    </h4>
                                </div>
                                <div class="flex gap-1 mt-3">
                                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                                    <span class="w-2 h-2 rounded-full bg-surface-variant"></span>
                                </div>
                            </div>
                        </article>

                        <!-- Recipe 2 -->
                        <article class="min-w-[280px] w-[280px] snap-center group bg-white rounded-3xl overflow-hidden border border-surface-variant/50 hover:shadow-xl transition-all duration-300 hover:border-primary/30 relative flex flex-col">
                            <div class="relative h-40 overflow-hidden shrink-0">
                                <img src="https://images.unsplash.com/photo-1485921325833-c519f76c4927?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Salmon" />
                                <button onclick="toggleSave(this)" class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm p-1.5 rounded-full text-outline hover:text-error transition-colors z-10">
                                    <span class="material-symbols-outlined icon-save text-[20px]">favorite</span>
                                </button>
                                <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-lg text-xs font-bold text-primary flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">timer</span> 30m
                                </div>
                            </div>
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-secondary mb-1 block">Makan Malam</span>
                                    <h4 class="text-lg font-bold text-on-surface mb-2 leading-tight group-hover:text-primary transition-colors">
                                        <a href="/recipe/salmon-panggang" class="before:absolute before:inset-0">Salmon Panggang Lemon Asparagus</a>
                                    </h4>
                                </div>
                                <div class="flex gap-1 mt-3">
                                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                                    <span class="w-2 h-2 rounded-full bg-surface-variant"></span>
                                    <span class="w-2 h-2 rounded-full bg-surface-variant"></span>
                                </div>
                            </div>
                        </article>
                        
                        <!-- View More Card -->
                        <article class="min-w-[140px] w-[140px] snap-center bg-surface-container-low rounded-3xl flex flex-col items-center justify-center border border-surface-variant/50 hover:bg-surface-variant transition-colors group">
                            <a href="/explore" class="w-full h-full flex flex-col items-center justify-center gap-2 p-4">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary group-hover:scale-110 transition-transform organic-shadow">
                                    <span class="material-symbols-outlined">east</span>
                                </div>
                                <span class="text-sm font-bold text-primary text-center">Lihat<br>Semua</span>
                            </a>
                        </article>
                    </div>
                </section>
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

        // 2. Fungsi Tombol Save/Bookmark pada Resep
        function toggleSave(btn) {
            const icon = btn.querySelector('.icon-save');
            if (icon.style.fontVariationSettings.includes("'FILL' 1")) {
                // Unsave
                icon.style.fontVariationSettings = "'FILL' 0";
                icon.classList.remove('text-error');
                icon.classList.add('text-outline');
                showToast('Resep dihapus dari favorit');
            } else {
                // Save
                icon.style.fontVariationSettings = "'FILL' 1";
                icon.classList.remove('text-outline');
                icon.classList.add('text-error');
                showToast('Resep disimpan ke favorit!', 'success');
            }
        }

        // 3. Simulasi Mulai Memasak
        function startSimulation() {
            showToast('Menyiapkan peralatan dapur...', 'success');
            // Efek tambahan bisa ditaruh di sini (misal loading screen atau redirect)
        }

        // 4. Sistem Toast Notification
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            // Atur gaya berdasarkan tipe
            let bgClass = type === 'success' ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface border border-outline-variant/30';
            let icon = type === 'success' ? 'check_circle' : 'info';

            toast.className = `flex items-center gap-3 px-4 py-3 rounded-xl organic-shadow pointer-events-auto toast-enter ${bgClass}`;
            toast.innerHTML = `
                <span class="material-symbols-outlined text-[20px]">${icon}</span>
                <p class="text-sm font-bold">${message}</p>
            `;

            container.appendChild(toast);

            // Hapus otomatis setelah 3 detik
            setTimeout(() => {
                toast.classList.remove('toast-enter');
                toast.classList.add('toast-leave');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
        // 5. Logout Modal Functions
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

        // 6. Notification Logic
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
                    @csrf
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
</body>

</html>