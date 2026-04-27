<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Chef Simulator - Bookmarks</title>
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
                        "outline-variant": "#becabb",
                        "surface-bright": "#fbf9f0"
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
        .organic-shadow { box-shadow: 0 12px 40px 0 rgba(27,28,23,0.05); }
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
            <a href="/bookmarks" class="flex items-center bg-primary text-white shadow-md shadow-primary/20 hover:bg-primary rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">bookmark</span>
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

    <div id="main-content" class="md:ml-20 flex-1 flex flex-col relative transition-all duration-300 w-full h-screen overflow-y-auto">

        <nav class="sticky top-0 w-full z-40 flex justify-between items-center px-6 py-4 bg-[#fbf9f0]/80 glass-nav border-b border-surface-variant/50 transition-colors">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="text-primary hover:bg-surface-container-high p-2 rounded-full transition-colors duration-200 flex md:hidden">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <a class="text-xl font-bold italic text-primary tracking-tight hidden md:block" href="/dashboard">Chef Simulator</a>
                <h1 class="text-xl md:text-2xl font-bold tracking-tighter text-primary md:hidden">The Atelier</h1>
            </div>
            
            <div class="flex items-center gap-2 ml-auto">
                <button class="text-primary hover:bg-surface-container-high p-2 rounded-full transition-colors relative group">
                    <span class="material-symbols-outlined icon-fill">notifications</span>
                </button>
                <a href="/settings">
                    <img alt="User Avatar" class="w-9 h-9 rounded-full object-cover ml-2 border border-surface-variant" src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode(auth()->user()->name) }}&backgroundColor=fbf9f0"/>
                </a>
            </div>
        </nav>

        <main class="pt-6 md:pt-10 px-4 md:px-8 max-w-6xl mx-auto w-full pb-16">
            
            <!-- Main Header Banner -->
            <header class="bg-surface-container-low rounded-3xl p-8 md:p-12 mb-12 relative overflow-hidden flex items-center justify-between border border-surface-variant/50 organic-shadow">
                <div class="z-10 max-w-2xl">
                    <div class="inline-flex items-center gap-2 bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-bold tracking-widest uppercase mb-4 border border-primary/20">
                        <span class="material-symbols-outlined text-sm icon-fill">bookmark</span>
                        Koleksi Penanda
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight text-on-surface mb-4 leading-tight">Koleksi Penanda Anda</h2>
                    <p class="text-lg text-on-surface-variant max-w-xl leading-relaxed">Telusuri resep, panduan, dan percakapan favorit yang telah Anda simpan dari berbagai sesi masak.</p>
                </div>
                <!-- Stylized Graphic -->
                <div class="hidden lg:block z-10 opacity-80 relative right-8">
                    <div class="w-48 h-48 bg-primary-container/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-primary/20 shadow-lg">
                        <span class="material-symbols-outlined text-[80px] text-primary icon-fill">book_4</span>
                    </div>
                </div>
                <!-- Background Decorative Elements -->
                <div class="absolute -right-10 -top-10 w-64 h-64 bg-secondary-container/30 rounded-full blur-3xl z-0"></div>
                <div class="absolute right-40 -bottom-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl z-0"></div>
            </header>

            <!-- Section 1: Resep Tersimpan -->
            <section class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-on-surface flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">restaurant</span>
                        Resep Tersimpan
                    </h3>
                    <a class="text-primary font-bold text-sm hover:underline hover:text-primary-container transition-colors" href="/explore">Jelajahi Resep Lain</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    
                    <!-- Recipe Card 1 -->
                    <article class="bg-surface-container-lowest rounded-3xl overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-surface-variant/60 relative cursor-pointer flex flex-col">
                        <div class="absolute top-4 right-4 z-20 bg-surface/80 backdrop-blur-md p-2 rounded-full shadow-md text-primary hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-[20px] icon-fill">bookmark</span>
                        </div>
                        <div class="aspect-[4/3] w-full overflow-hidden relative bg-surface-container-low">
                            <img alt="Pan-seared salmon" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out mix-blend-multiply" src="https://images.unsplash.com/photo-1485921325833-c519f76c4927?q=80&w=600&auto=format&fit=crop"/>
                            <!-- Rating Overlay -->
                            <div class="absolute bottom-4 left-4 bg-surface/90 backdrop-blur-sm px-3 py-1.5 rounded-lg flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-yellow-500 text-[16px] icon-fill">star</span>
                                <span class="text-sm font-bold text-on-surface">4.9</span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="px-3 py-1 bg-secondary-container text-on-secondary-container rounded-full text-[10px] font-bold tracking-wider uppercase">Makan Malam</span>
                                <span class="px-3 py-1 bg-surface-container-high text-on-surface rounded-full text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[12px]">schedule</span> 45 mnt
                                </span>
                            </div>
                            <h4 class="text-xl font-bold text-on-surface mb-2 leading-tight group-hover:text-primary transition-colors">Herb-Crusted Salmon with Asparagus</h4>
                            <p class="text-on-surface-variant text-sm line-clamp-2">A perfectly seared fillet with a crispy herb crust, served over tender-crisp seasonal vegetables.</p>
                        </div>
                    </article>

                    <!-- Recipe Card 2 -->
                    <article class="bg-surface-container-lowest rounded-3xl overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-surface-variant/60 relative cursor-pointer flex flex-col">
                        <div class="absolute top-4 right-4 z-20 bg-surface/80 backdrop-blur-md p-2 rounded-full shadow-md text-primary hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-[20px] icon-fill">bookmark</span>
                        </div>
                        <div class="aspect-[4/3] w-full overflow-hidden relative bg-surface-container-low">
                            <img alt="Avocado toast" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out mix-blend-multiply" src="https://images.unsplash.com/photo-1603048297172-c92544798d5e?q=80&w=600&auto=format&fit=crop"/>
                            <div class="absolute bottom-4 left-4 bg-surface/90 backdrop-blur-sm px-3 py-1.5 rounded-lg flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-yellow-500 text-[16px] icon-fill">star</span>
                                <span class="text-sm font-bold text-on-surface">4.7</span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="px-3 py-1 bg-primary/20 text-primary-container border border-primary/20 rounded-full text-[10px] font-bold tracking-wider uppercase">Sarapan</span>
                                <span class="px-3 py-1 bg-surface-container-high text-on-surface rounded-full text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[12px]">schedule</span> 15 mnt
                                </span>
                            </div>
                            <h4 class="text-xl font-bold text-on-surface mb-2 leading-tight group-hover:text-primary transition-colors">Artisan Avocado Toast & Egg</h4>
                            <p class="text-on-surface-variant text-sm line-clamp-2">Elevate your morning routine with crusty sourdough, perfectly ripe avocado, and a jammy egg.</p>
                        </div>
                    </article>

                    <!-- Recipe Card 3 -->
                    <article class="bg-surface-container-lowest rounded-3xl overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-surface-variant/60 relative cursor-pointer flex flex-col">
                        <div class="absolute top-4 right-4 z-20 bg-surface/80 backdrop-blur-md p-2 rounded-full shadow-md text-primary hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-[20px] icon-fill">bookmark</span>
                        </div>
                        <div class="aspect-[4/3] w-full overflow-hidden relative bg-surface-container-low">
                            <img alt="Handmade pasta" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out mix-blend-multiply" src="https://images.unsplash.com/photo-1611270629569-8b357cb88da9?q=80&w=600&auto=format&fit=crop"/>
                            <div class="absolute bottom-4 left-4 bg-surface/90 backdrop-blur-sm px-3 py-1.5 rounded-lg flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-yellow-500 text-[16px] icon-fill">star</span>
                                <span class="text-sm font-bold text-on-surface">5.0</span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="px-3 py-1 bg-secondary-container text-on-secondary-container rounded-full text-[10px] font-bold tracking-wider uppercase">Makan Siang</span>
                                <span class="px-3 py-1 bg-surface-container-high text-on-surface rounded-full text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[12px]">schedule</span> 60 mnt
                                </span>
                            </div>
                            <h4 class="text-xl font-bold text-on-surface mb-2 leading-tight group-hover:text-primary transition-colors">Rustic Pappardelle al Ragù</h4>
                            <p class="text-on-surface-variant text-sm line-clamp-2">Slow-simmered rich meat sauce tossed with wide ribbons of fresh egg pasta.</p>
                        </div>
                    </article>
                </div>
            </section>

            <!-- Section 2: Cakapan & Topik Favorit -->
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-on-surface flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">forum</span>
                        Cakapan & Topik Favorit
                    </h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Chat Item 1 -->
                    <a class="block bg-surface-container-lowest p-6 rounded-3xl border border-surface-variant/60 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group" href="#">
                        <div class="flex items-start gap-4">
                            <div class="bg-primary/10 p-3 rounded-full text-primary shrink-0 group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined icon-fill">bookmark</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors leading-tight">Perfecting the Sourdough Starter</h4>
                                <p class="text-sm text-on-surface-variant mb-4 leading-relaxed line-clamp-2">Discussion on feeding schedules, hydration ratios, and troubleshooting sluggish starters during winter months.</p>
                                <div class="flex items-center gap-4 text-xs text-secondary font-bold">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">chat_bubble</span> 24 balasan</span>
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 2 hari yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Chat Item 2 -->
                    <a class="block bg-surface-container-lowest p-6 rounded-3xl border border-surface-variant/60 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group" href="#">
                        <div class="flex items-start gap-4">
                            <div class="bg-primary/10 p-3 rounded-full text-primary shrink-0 group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined icon-fill">bookmark</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors leading-tight">Gluten-Free Pastry Alternatives</h4>
                                <p class="text-sm text-on-surface-variant mb-4 leading-relaxed line-clamp-2">Comparing different flour blends for achieving flaky crusts without gluten. Almond flour vs. Cassava.</p>
                                <div class="flex items-center gap-4 text-xs text-secondary font-bold">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">chat_bubble</span> 18 balasan</span>
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 1 minggu yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Chat Item 3 -->
                    <a class="block bg-surface-container-lowest p-6 rounded-3xl border border-surface-variant/60 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group" href="#">
                        <div class="flex items-start gap-4">
                            <div class="bg-primary/10 p-3 rounded-full text-primary shrink-0 group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined icon-fill">bookmark</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors leading-tight">Mastering Knife Skills: The Basics</h4>
                                <p class="text-sm text-on-surface-variant mb-4 leading-relaxed line-clamp-2">A guide to the essential cuts every chef needs to know, from julienne to brunoise, and how to maintain your blade.</p>
                                <div class="flex items-center gap-4 text-xs text-secondary font-bold">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">chat_bubble</span> 42 balasan</span>
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 3 minggu yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        </main>
    </div>

    <!-- Script for Persistent, Auto-closing Sidebar -->
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
                    if (forceStyle) {
                        forceStyle.remove();
                    }
                });
            }
        });
    </script>
</body>
</html>
