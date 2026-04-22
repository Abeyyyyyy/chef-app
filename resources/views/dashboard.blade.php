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
</head>

<body class="flex h-screen overflow-hidden text-sm md:text-base">

    <div id="toast-container" class="fixed top-20 right-8 z-[100] flex flex-col gap-3 pointer-events-none"></div>

    <div id="sidebar-overlay"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 hidden opacity-0 transition-all duration-300 ease-in-out"
        onclick="toggleSidebar()"></div>

    <aside id="sidebar"
        class="h-screen w-64 fixed left-0 top-0 border-r border-surface-variant bg-surface/95 backdrop-blur-xl flex flex-col p-6 space-y-8 z-40 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl">

        <button onclick="toggleSidebar()"
            class="md:hidden absolute top-4 right-4 text-on-surface-variant hover:bg-surface-variant p-2 rounded-full transition-colors">
            <span class="material-symbols-outlined">close</span>
        </button>

        <div class="flex flex-col items-center gap-4 pt-4">
            <div class="relative group cursor-pointer">
                <div
                    class="absolute inset-0 bg-primary/20 rounded-full scale-110 opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-md">
                </div>
                <img alt="Chef logo"
                    class="w-20 h-20 rounded-full object-cover organic-shadow relative z-10 border-2 border-white"
                    src="https://api.dicebear.com/7.x/avataaars/svg?seed=ChefJuna&backgroundColor=fbf9f0" />
            </div>
            <div class="text-center">
                <h2 class="text-lg font-black text-primary font-headline tracking-tight">The Atelier</h2>
                <p class="text-xs font-medium text-secondary tracking-widest uppercase">Chef Simulator</p>
            </div>
        </div>

        <button onclick="showToast('Membuka kanvas resep baru...', 'success')"
            class="w-full bg-gradient-to-r from-primary to-primary-container text-white rounded-xl py-3 px-4 font-bold text-sm organic-shadow hover:shadow-lg hover:shadow-primary/30 active:scale-95 transition-all duration-200 flex justify-center items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add_circle</span> Create Recipe
        </button>

        <nav class="flex-1 space-y-2 font-medium">
            <a class="flex items-center gap-3 bg-primary text-white rounded-xl px-4 py-3 shadow-md shadow-primary/20 transition-all"
                href="/dashboard">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">grid_view</span> Home
            </a>
            <a class="flex items-center gap-3 text-secondary hover:bg-surface-container-high rounded-xl px-4 py-3 transition-colors duration-200"
                href="/explore">
                <span class="material-symbols-outlined">restaurant_menu</span> Recipes
            </a>
            <a class="flex items-center gap-3 text-secondary hover:bg-surface-container-high rounded-xl px-4 py-3 transition-colors duration-200"
                href="/pantry">
                <span class="material-symbols-outlined">inventory_2</span> Pantry
            </a>
            <a class="flex items-center gap-3 text-secondary hover:bg-surface-container-high rounded-xl px-4 py-3 transition-colors duration-200"
                href="/community">
                <span class="material-symbols-outlined">groups</span> Community
            </a>
            <a class="flex items-center gap-3 text-secondary hover:bg-surface-container-high rounded-xl px-4 py-3 transition-colors duration-200"
                href="#">
                <span class="material-symbols-outlined">bookmark</span> Bookmark
            </a>
            <a class="flex items-center gap-3 text-secondary hover:bg-surface-container-high rounded-xl px-4 py-3 transition-colors duration-200"
                href="#">
                <span class="material-symbols-outlined">history</span> History
            </a>
        </nav>

        <div class="mt-auto space-y-2 font-medium border-t border-surface-variant pt-4">
            <a class="flex items-center gap-3 text-secondary hover:bg-surface-container-high rounded-xl px-4 py-3 transition-colors duration-200"
                href="/settings">
                <span class="material-symbols-outlined">settings</span> Settings
            </a>
            <a class="flex items-center gap-3 text-secondary hover:bg-surface-container-high rounded-xl px-4 py-3 transition-colors duration-200"
                href="#">
                <span class="material-symbols-outlined">help_outline</span> Support
            </a>
            <a class="flex items-center gap-3 text-error hover:bg-error-container hover:text-error rounded-xl px-4 py-3 transition-colors duration-200"
                href="#" onclick="openLogoutModal(event)">
                <span class="material-symbols-outlined">logout</span> Log Out
            </a>
        </div>
    </aside>

    <div id="main-content" class="flex-1 flex flex-col relative overflow-hidden transition-all duration-300 w-full">

        <header
            class="sticky top-0 w-full flex items-center justify-between px-6 md:px-8 py-4 bg-surface/80 backdrop-blur-md border-b border-surface-variant z-20">
            <div class="flex items-center gap-4 md:gap-8">
                <button onclick="toggleSidebar()"
                    class="text-primary p-2 hover:bg-surface-variant rounded-full transition-colors flex">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h1 class="text-xl md:text-2xl font-bold tracking-tighter text-primary md:hidden">The Atelier</h1>

                <nav class="hidden md:flex gap-6 text-sm font-bold">
                    <a class="text-primary border-b-2 border-primary pb-1" href="#">Browse</a>
                    <a class="text-outline-variant hover:text-primary transition-colors pb-1" href="#">Pro Features</a>
                    <a class="text-outline-variant hover:text-primary transition-colors pb-1" href="#">Journal</a>
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
                        src="https://api.dicebear.com/7.x/avataaars/svg?seed=ChefJuna&backgroundColor=fbf9f0" />
                </a>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-8 pb-24 space-y-8 scroll-smooth">

            <section
                class="relative bg-surface-container-low rounded-3xl overflow-hidden p-6 md:p-12 organic-shadow flex flex-col md:flex-row items-center justify-between gap-8 group border border-white">
                <div class="z-10 max-w-xl text-center md:text-left">
                    <h2
                        class="text-3xl md:text-5xl font-display font-bold tracking-tight text-on-surface mb-4 leading-tight">
                        Selamat Datang,<br /><span class="text-primary">Chef Abey!</span></h2>
                    <p class="text-base md:text-lg text-secondary mb-8 font-medium">Dapur sudah disiapkan dan
                        bahan-bahan telah menunggu. Mahakarya kuliner apa yang akan kamu ciptakan hari ini?</p>
                    <a href="/chat"
                        class="bg-primary text-white px-6 md:px-8 py-3 md:py-4 rounded-2xl font-bold text-base md:text-lg inline-flex items-center gap-3 organic-shadow hover:bg-primary-container active:scale-95 transition-all duration-300 w-max">
                        Mulai Simulasi Baru
                        <span class="material-symbols-outlined animate-bounce"
                            style="font-variation-settings: 'FILL' 1;">skillet</span>
                    </a>
                </div>
                <div
                    class="w-full md:w-5/12 aspect-video md:aspect-[4/3] relative rounded-2xl overflow-hidden shadow-2xl">
                    <img alt="Kitchen prep area"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000 ease-out"
                        src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=1000&auto=format&fit=crop" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                </div>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">

                <section
                    class="lg:col-span-1 bg-white rounded-3xl p-6 md:p-8 organic-shadow flex flex-col justify-between border border-surface-variant/50 hover:border-primary/30 transition-colors">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-on-surface">Pantry Status</h3>
                            <div class="p-2 bg-surface-container-low rounded-xl">
                                <span class="material-symbols-outlined text-secondary">inventory</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div
                                class="bg-error-container/40 rounded-2xl p-5 border border-error-container/50 transform hover:-translate-y-1 transition-transform cursor-default">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="w-2 h-2 rounded-full bg-error animate-pulse"></span>
                                    <p class="text-xs font-bold text-error uppercase tracking-wider">Stok Menipis</p>
                                </div>
                                <p class="text-lg font-bold text-on-surface">Telur, Susu Sapi</p>
                            </div>
                            <div
                                class="bg-surface-container-low rounded-2xl p-5 transform hover:-translate-y-1 transition-transform cursor-default">
                                <p class="text-xs font-bold text-secondary uppercase tracking-wider mb-1">Resep
                                    Tersimpan</p>
                                <div class="flex items-end gap-2">
                                    <p class="text-4xl font-black text-primary leading-none">12</p>
                                    <p class="text-sm font-medium text-secondary pb-1">resep</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button onclick="showToast('Membuka manajemen pantry...', 'info')"
                        class="mt-6 w-full py-3 border-2 border-outline-variant/30 rounded-xl text-primary font-bold hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 active:scale-95">
                        Kelola Pantry
                    </button>
                </section>

                <section
                    class="lg:col-span-2 bg-wMulai Simulasi Baruite rounded-3xl p-6 md:p-8 organic-shadow border border-surface-variant/50">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-on-surface">Obrolan Terakhir</h3>
                        <div class="p-2 bg-surface-container-low rounded-xl">
                            <span class="material-symbols-outlined text-secondary">forum</span>
                        </div>
                    </div>
                    <div class="space-y-3">

                        <div onclick="showToast('Memuat obrolan Sourdough...', 'info')"
                            class="group flex items-center justify-between p-4 rounded-2xl hover:bg-surface-container-low hover:shadow-md transition-all cursor-pointer border border-transparent hover:border-outline-variant/20">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center text-on-secondary-container shadow-sm">
                                    <span class="material-symbols-outlined">restaurant</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-on-surface group-hover:text-primary transition-colors">
                                        Menyempurnakan Starter Sourdough</h4>
                                    <p class="text-xs font-medium text-secondary mt-0.5">Aktif: 2 jam yang lalu</p>
                                </div>
                            </div>
                            <div
                                class="w-10 h-10 rounded-full bg-white flex items-center justify-center opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all shadow-sm">
                                <span class="material-symbols-outlined text-primary">arrow_forward</span>
                            </div>
                        </div>

                        <div onclick="showToast('Memuat obrolan Pastry...', 'info')"
                            class="group flex items-center justify-between p-4 rounded-2xl hover:bg-surface-container-low hover:shadow-md transition-all cursor-pointer border border-transparent hover:border-outline-variant/20">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-surface-variant rounded-full flex items-center justify-center text-secondary shadow-sm">
                                    <span class="material-symbols-outlined">cake</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-on-surface group-hover:text-primary transition-colors">
                                        Alternatif Pastry Bebas Gluten</h4>
                                    <p class="text-xs font-medium text-secondary mt-0.5">Aktif: Kemarin</p>
                                </div>
                            </div>
                            <div
                                class="w-10 h-10 rounded-full bg-white flex items-center justify-center opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all shadow-sm">
                                <span class="material-symbols-outlined text-primary">arrow_forward</span>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            <section class="pt-4">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-on-surface">Resep Unggulan</h3>
                    <a class="text-primary font-bold hover:text-primary-container flex items-center gap-1 group bg-primary/10 px-4 py-2 rounded-full transition-colors"
                        href="#">
                        Lihat Semua <span
                            class="material-symbols-outlined text-sm transform group-hover:translate-x-1 transition-transform">east</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

                    <article
                        class="group bg-white rounded-3xl overflow-hidden organic-shadow hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-surface-variant/50 relative">
                        <div class="relative h-56 overflow-hidden">
                            <img alt="Herb Roasted Chicken"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                src="https://images.unsplash.com/photo-1598514982205-f36b96d1e8d4?q=80&w=600&auto=format&fit=crop" />

                            <button onclick="toggleSave(this)"
                                class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm p-2 rounded-full text-outline hover:text-error transition-colors shadow-sm z-10">
                                <span class="material-symbols-outlined icon-save">favorite</span>
                            </button>

                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full text-xs font-bold text-primary flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">timer</span> 45m
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-4">
                                <span
                                    class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Menengah</span>
                                <span
                                    class="bg-surface-variant text-on-surface-variant px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Makan
                                    Malam</span>
                            </div>
                            <h4
                                class="text-xl font-bold text-on-surface mb-2 group-hover:text-primary transition-colors cursor-pointer">
                                Ayam Panggang Lemon Bumbu</h4>
                            <p class="text-sm text-secondary line-clamp-2 leading-relaxed">Aroma klasik dengan sentuhan
                                rosemary segar, thyme, dan taburan kulit lemon yang cerah.</p>
                        </div>
                    </article>

                    <article
                        class="group bg-white rounded-3xl overflow-hidden organic-shadow hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-surface-variant/50 relative">
                        <div class="relative h-56 overflow-hidden">
                            <img alt="Mushroom Risotto"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                src="https://images.unsplash.com/photo-1476124369491-e7addf5db378?q=80&w=600&auto=format&fit=crop" />

                            <button onclick="toggleSave(this)"
                                class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm p-2 rounded-full text-outline hover:text-error transition-colors shadow-sm z-10">
                                <span class="material-symbols-outlined icon-save">favorite</span>
                            </button>

                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full text-xs font-bold text-primary flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">timer</span> 30m
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-4">
                                <span
                                    class="bg-[#f3dede] text-[#653c35] px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Mahir</span>
                                <span
                                    class="bg-surface-variant text-on-surface-variant px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Vegetarian</span>
                            </div>
                            <h4
                                class="text-xl font-bold text-on-surface mb-2 group-hover:text-primary transition-colors cursor-pointer">
                                Risotto Jamur Liar Truffle</h4>
                            <p class="text-sm text-secondary line-clamp-2 leading-relaxed">Nasi arborio yang creamy
                                dimasak perlahan dengan kaldu porcini, diselesaikan dengan minyak truffle.</p>
                        </div>
                    </article>

                    <article
                        class="group bg-white rounded-3xl overflow-hidden organic-shadow hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-surface-variant/50 relative hidden lg:block">
                        <div class="relative h-56 overflow-hidden">
                            <img alt="Artisan Bread"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                src="https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=600&auto=format&fit=crop" />

                            <button onclick="toggleSave(this)"
                                class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm p-2 rounded-full text-outline hover:text-error transition-colors shadow-sm z-10">
                                <span class="material-symbols-outlined icon-save">favorite</span>
                            </button>

                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full text-xs font-bold text-primary flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">timer</span> 2j 15m
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-4">
                                <span
                                    class="bg-[#dcdad2] text-[#3e4a3e] px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Pemula</span>
                                <span
                                    class="bg-surface-variant text-on-surface-variant px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Baking</span>
                            </div>
                            <h4
                                class="text-xl font-bold text-on-surface mb-2 group-hover:text-primary transition-colors cursor-pointer">
                                Sourdough Boule Klasik</h4>
                            <p class="text-sm text-secondary line-clamp-2 leading-relaxed">Roti artisan dengan hidrasi
                                tinggi dan kerak renyah, sempurna untuk pemula pembuat ragi liar.</p>
                        </div>
                    </article>

                </div>
            </section>
        </main>
    </div>

    <script>
        // 1. Mobile Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar.classList.contains('-translate-x-full')) {
                // Buka Sidebar
                overlay.classList.remove('hidden');
                // Gunakan requestAnimationFrame untuk memastikan display block di-render sebelum transisi opacity
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        sidebar.classList.remove('-translate-x-full');
                        overlay.classList.remove('opacity-0');
                    });
                });
            } else {
                // Tutup Sidebar
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
</body>

</html>