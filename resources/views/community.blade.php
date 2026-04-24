<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Chef Simulator - Community</title>
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
            <a href="/community" class="flex items-center bg-primary text-white shadow-md shadow-primary/20 hover:bg-primary rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">groups</span>
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
                    <img alt="User Avatar" class="w-9 h-9 rounded-full object-cover ml-2 border border-surface-variant cursor-pointer hover:border-primary transition-colors" src="https://api.dicebear.com/7.x/avataaars/svg?seed=ChefJuna&backgroundColor=fbf9f0"/>
                </a>
            </div>
        </nav>

        <!-- Main Content Canvas -->
        <main class="flex-1 overflow-y-auto w-full px-6 py-8 custom-scrollbar">
            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-12">
                <!-- Left Column: Feed -->
                <div class="flex-1 lg:w-2/3 space-y-8 pb-20">
                    <div class="flex items-baseline justify-between mb-2">
                        <h2 class="text-3xl font-display font-bold text-on-surface tracking-tight">Chef's Feed</h2>
                        <span class="text-sm font-medium text-secondary">Discover inspirations</span>
                    </div>

                    <!-- Feed Card 1 -->
                    <article class="bg-surface-container-lowest rounded-2xl ambient-shadow overflow-hidden group hover:bg-surface-container-low transition-colors duration-300 border border-surface-variant/50">
                        <div class="p-6">
                            <!-- User Meta -->
                            <div class="flex items-center gap-4 mb-5">
                                <img alt="Mateo R." class="w-12 h-12 rounded-full object-cover border-2 border-surface" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDMCmEA2lTIfmCx6Cv9yaHSj26Iao_DVE9zmsvWlhXpG78XZdFhL5bny7eTq2SE13iyhCw7Znaooh2UrylT2tZcuk4BWeeZvpv62AgjjOktVjoDS7rvzb7zfZqFim7Ixjo3OGQHjrJmN9HXIQB1Xeho0w04pPrDuI3dS3-U4X-VKjRPVjZNTeYXKqiQYTj5PtueFIMtnKaGYtX_2giVDiSDhi2g1y9laieSeB8OAj81St9VPTR6T3OPKz7Q8EB7EBNoKL230ykqTc6v"/>
                                <div>
                                    <h3 class="font-bold text-on-surface text-base">Mateo R.</h3>
                                    <p class="text-xs text-on-surface-variant font-medium">2 hours ago • Weekend Bake</p>
                                </div>
                                <button class="ml-auto text-outline hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-xl">more_horiz</span>
                                </button>
                            </div>
                            <!-- Image Content -->
                            <div class="mb-5 rounded-xl overflow-hidden relative shadow-sm">
                                <img alt="Fresh sourdough bread" class="w-full h-[400px] object-cover group-hover:scale-[1.02] transition-transform duration-700 ease-in-out" src="https://lh3.googleusercontent.com/aida-public/AB6AXuATZo5irBhWHEiXz7XgagoweXImXQCFj61VrvFU1In_V6n1QlyalGwu4XOWub1qBmf5JxsI5Bk1d-WArufovGZvbSjcDLB-7rAMp4ovqVGZgqCKq9uqzo4tDKzzZoK5MzETzvTgOaRVMMJBxrnLmLqbOlEKib4tZhqQ5HZEg-aP0b1_gfqhkb56DWtVD7BOtGDlkslQxu0u2kCW_AE-efbBrb-QO1dO_gwxIUcFi5T_ZAGnSLpNCHTTnAt6y_E5pSdhgvyRGVn5JZ3X"/>
                                <div class="absolute top-4 right-4 bg-surface/80 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold text-primary flex items-center gap-1 shadow-sm">
                                    <span class="material-symbols-outlined text-[16px] icon-fill">verified</span>
                                    Verified Result
                                </div>
                            </div>
                            <!-- Review Text -->
                            <p class="text-base font-body text-on-surface-variant mb-6 leading-relaxed">
                                Let the dough ferment for an extra 12 hours in the fridge and the flavor depth is incredible. The crumb is exactly what I was aiming for. Such a therapeutic weekend project! 🌾✨
                            </p>
                            <!-- Original Recipe Link -->
                            <div class="bg-surface-container-high rounded-xl p-3 flex items-center gap-4 mb-6 cursor-pointer hover:bg-surface-variant transition-colors ring-1 ring-surface-variant/50 shadow-sm">
                                <img alt="Recipe thumb" class="w-14 h-14 rounded-lg object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDGtxDvd40bTYtFcGX5KWJQpZBgevR6WTkib2L6U7WpMQx4mBGfVGixTFpCg1JoB8PZU18QKsTo3ksI8gIryQ8hYwKk46s0kA8i5eaOSP8rbPLAbGxMPBsoyCGiKccaieZw4D-mKA2zwfAs6vN4XykBuggF7HpgfR5ZUfj80MKdRqiKHRkzcT1vUQvDsBSevxDBaNXTeMmGxo-kLe-QzYGPF9v5ReCrOpcV-YcKcjAUpgOXwvkGyDdnsdI8FoTRSmseL7Td9oYMVCxF"/>
                                <div class="flex-1">
                                    <p class="text-xs font-bold text-secondary uppercase tracking-wider mb-1">Original Recipe</p>
                                    <p class="text-sm font-bold text-on-surface line-clamp-1">Classic Tartine Country Loaf</p>
                                </div>
                                <span class="material-symbols-outlined text-outline">chevron_right</span>
                            </div>
                            <!-- Interaction Bar -->
                            <div class="flex items-center justify-between pt-2">
                                <div class="flex gap-6">
                                    <button class="flex items-center gap-2 text-on-surface-variant hover:text-secondary transition-colors group/btn">
                                        <span class="material-symbols-outlined group-hover/btn:scale-110 transition-transform">favorite</span>
                                        <span class="text-sm font-bold">124</span>
                                    </button>
                                    <button class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors group/btn">
                                        <span class="material-symbols-outlined group-hover/btn:scale-110 transition-transform">chat_bubble</span>
                                        <span class="text-sm font-bold">18</span>
                                    </button>
                                </div>
                                <button class="bg-gradient-to-r from-primary to-primary-container text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:shadow-md hover:scale-[1.02] active:scale-95 transition-all flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">bookmark_add</span>
                                    Try this
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Feed Card 2 -->
                    <article class="bg-surface-container-lowest rounded-2xl ambient-shadow overflow-hidden group hover:bg-surface-container-low transition-colors duration-300 border border-surface-variant/50">
                        <div class="p-6">
                            <div class="flex items-center gap-4 mb-5">
                                <img alt="Sarah J." class="w-12 h-12 rounded-full object-cover border-2 border-surface" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCd_tpCGk1Nlf0PyNXH4EPwN23EQkdfQGfIXYxjc38SENDnMyCXMa2t11BKMb3mszGiAONPS6o9-Z0NwSD12De7xJ8Ep5yEhbIFV1Ncgd9TGjTHemvgZ-fn8QHXb-8P1zq7SAz5J4rRXmwZYOgg4_a10a81vP-hkA6OHreEs9xmCY5PAd7ptvkXyCOlt1kZx4jm9oSgnZMUlTGIjWkQ1T1wBlCFlDw9kOIkgWd_lZ_25mz27jidAUQa1Sk8h-BmF4x8Qpuab7eUc9x1"/>
                                <div>
                                    <h3 class="font-bold text-on-surface text-base">Sarah J.</h3>
                                    <p class="text-xs text-on-surface-variant font-medium">5 hours ago • Quick Dinner</p>
                                </div>
                                <button class="ml-auto text-outline hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-xl">more_horiz</span>
                                </button>
                            </div>
                            <div class="mb-5 rounded-xl overflow-hidden relative shadow-sm">
                                <img alt="Healthy salad bowl" class="w-full h-[300px] object-cover group-hover:scale-[1.02] transition-transform duration-700 ease-in-out" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC93aTmaLiiTKXxHWTmPVIkAETe5SKZCc4a1Lc7LvbtkwopeHjD7NuvtK8EQocX01QYIQaO7znX0Rs07agJzDOwiOhdHnTNM8N5BRYCilgJqWFTp-__PGOmFYQITGSfq19ZfBPuzQYnrVSs-EXBqSn0NaXP4ySklh9UhRBJwEs2ByUx0-9tO2hGMB9F5i2XD1wfYrqh6TjZImCZyZN4kpfVnagLL9RSFPYGacA-C-hSabRoXC-l-TPCQhXFA5Hc6xYMoVWFlMABFTCa"/>
                            </div>
                            <p class="text-base font-body text-on-surface-variant mb-6 leading-relaxed">
                                Swapped the kale for spinach because that's what I had in the garden. The lemon-tahini dressing is an absolute game changer!
                            </p>
                            <div class="bg-surface-container-high rounded-xl p-3 flex items-center gap-4 mb-6 cursor-pointer hover:bg-surface-variant transition-colors ring-1 ring-surface-variant/50 shadow-sm">
                                <img alt="Recipe thumb" class="w-14 h-14 rounded-lg object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlqVE63XJNsdk60aHmcZSOigEdWB1qyD-LTOl0MY7va8cKFWI9S8MfzlIT13QjYW1xmFpbMhrcZ2dTSbhjJdpNZhhKE3zqkvCPR2iFLahdjBRclnzJfFIe-DUsXk1rXtIVYbucCDVY6rlZK34AP-aX5GDUR-P1kQzBE02TlDm62Cim_PmydpWWiYuiJnbcD50Wja7YeDuuoEpfLH9d3Y2R8DWjJzQE1hft2s7KtIj75EehEL-09a0kXOY8nojOPUqRiqhmrvdKo6DO"/>
                                <div class="flex-1">
                                    <p class="text-xs font-bold text-secondary uppercase tracking-wider mb-1">Original Recipe</p>
                                    <p class="text-sm font-bold text-on-surface line-clamp-1">Harvest Nourish Bowl</p>
                                </div>
                                <span class="material-symbols-outlined text-outline">chevron_right</span>
                            </div>
                            <div class="flex items-center justify-between pt-2">
                                <div class="flex gap-6">
                                    <button class="flex items-center gap-2 text-on-surface-variant hover:text-secondary transition-colors group/btn">
                                        <span class="material-symbols-outlined group-hover/btn:scale-110 transition-transform">favorite</span>
                                        <span class="text-sm font-bold">89</span>
                                    </button>
                                    <button class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors group/btn">
                                        <span class="material-symbols-outlined group-hover/btn:scale-110 transition-transform">chat_bubble</span>
                                        <span class="text-sm font-bold">5</span>
                                    </button>
                                </div>
                                <button class="bg-gradient-to-r from-primary to-primary-container text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:shadow-md hover:scale-[1.02] active:scale-95 transition-all flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">bookmark_add</span>
                                    Try this
                                </button>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Right Column: Sidebar Extras -->
                <aside class="w-full lg:w-[340px] flex-shrink-0 space-y-8">
                    <!-- Monthly Challenge Card -->
                    <div class="bg-surface-container-lowest rounded-2xl ambient-shadow border border-surface-variant/50 overflow-hidden relative">
                        <div class="h-36 w-full relative">
                            <img alt="Artisan Bread" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCxp0r4q1mAPFKB02AeNTMIc6GK_Bp43_ZoZH83O7LNJV8OtSgXOedJ7pDADEiZHVFCGzEZvb7CVbmiVGf2eHbI_QrNFmCS2oRwAvSAyMRoq3jvhoawsLPQSMmQtTC79Q9jDStBRZ9uXN2E9UiFI2ePzGk_wNhMCeOaLttvLd11VYxV5M1rebvXHCfe0dpvyWDI8Zt7hccxPBu0GM98jkwn2aaPMILvw4BaHSB0_ZjXtFKxOH9mIquaeb-DQh0J_vcwmlrScLWfGLt"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-surface-container-lowest via-surface-container-lowest/40 to-transparent"></div>
                            <div class="absolute bottom-3 left-6">
                                <span class="bg-secondary-container text-on-secondary-container px-3 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase mb-1 inline-block shadow-sm">Monthly Challenge</span>
                            </div>
                        </div>
                        <div class="p-6 pt-2">
                            <h3 class="text-2xl font-display font-bold text-on-surface mb-2 tracking-tight">Artisan Bread Week</h3>
                            <p class="text-sm text-on-surface-variant mb-6 leading-relaxed">Master the art of natural fermentation and create your perfect rustic loaf.</p>
                            <!-- Countdown -->
                            <div class="flex gap-3 mb-6">
                                <div class="bg-surface-container-high rounded-xl p-3 flex-1 text-center shadow-inner">
                                    <span class="block text-xl font-black text-primary">04</span>
                                    <span class="text-[10px] uppercase font-bold text-outline tracking-wider">Days</span>
                                </div>
                                <div class="bg-surface-container-high rounded-xl p-3 flex-1 text-center shadow-inner">
                                    <span class="block text-xl font-black text-primary">12</span>
                                    <span class="text-[10px] uppercase font-bold text-outline tracking-wider">Hours</span>
                                </div>
                                <div class="bg-surface-container-high rounded-xl p-3 flex-1 text-center shadow-inner">
                                    <span class="block text-xl font-black text-primary">45</span>
                                    <span class="text-[10px] uppercase font-bold text-outline tracking-wider">Mins</span>
                                </div>
                            </div>
                            <button class="w-full bg-gradient-to-r from-primary to-primary-container text-white py-3.5 rounded-xl font-bold shadow-sm hover:shadow-md active:scale-95 transition-all">
                                Join Challenge
                            </button>
                        </div>
                    </div>

                    <!-- Top Contributors Section -->
                    <div class="bg-surface-container-lowest border border-surface-variant/50 rounded-2xl p-6 relative overflow-hidden ambient-shadow">
                        <!-- Decorative bg flourish -->
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/10 rounded-full blur-2xl"></div>
                        <div class="flex items-center justify-between mb-6 relative z-10">
                            <h3 class="text-lg font-headline font-bold text-on-surface">Top Contributors</h3>
                            <button class="text-xs font-bold text-primary hover:text-primary-container transition-colors">View All</button>
                        </div>
                        <div class="space-y-5 relative z-10">
                            <!-- Contributor 1 -->
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <img alt="David K." class="w-10 h-10 rounded-full object-cover shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqvdjcPkPuejEGCOJNWcUJqBrwy1c8H1XRZQU4kvMhB90FtDHSJF6b6S-fJGqD32z-Cre2IRCSwYitP6IteQK9MDeqyvgyvLOQttKoIMd1EFNvt2IsfD3_yYFveC9sNG7ArTEWSFR7XJt84iAlMzjKYTtf7snrCCsqpW2dlaGLFQkxRuaeWLVlgbKPX31ppqMsF2w0ayxeOhnqRebYZ8OSRrIrBfTWmAt2IbAnldOl6mkuf1drKEf7giHvYKawd9e8DOCJ3uJqDiKM"/>
                                    <div class="absolute -top-1 -right-1 bg-surface-container-lowest rounded-full p-[2px] shadow-sm">
                                        <span class="material-symbols-outlined text-[14px] text-yellow-500 icon-fill">star</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-on-surface">David K.</p>
                                    <p class="text-xs font-medium text-on-surface-variant">Master Chef • 4.2k pts</p>
                                </div>
                                <span class="text-lg font-black text-outline/40">1</span>
                            </div>
                            <!-- Contributor 2 -->
                            <div class="flex items-center gap-4">
                                <img alt="Elena V." class="w-10 h-10 rounded-full object-cover shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAOiC_qNtdnzulXiwkmBy4B6hv3v6QxxnTodbljFtdliO_yN0XKPfCKa_VPl0aFUHgwqgfT8MRpnx6-jnMdUjOw-2-Eg-XUlFNU5H9V4YFgPLIfOwZgfDnzaHUDiNAWmwFQpiTwquT6doAfZNxXaGVDx3hUbmhpktf26F0VCt5KnQtENmyd9QpLnTafKdmOeMaxewT4-FxEdu1Ni2aM-RlUE2CSlLe3dPYURbK2Ddy6fyRAoKhASjDkJ4KIs5sp9obESxItYODS-DF1"/>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-on-surface">Elena V.</p>
                                    <p class="text-xs font-medium text-on-surface-variant">Sous Chef • 3.8k pts</p>
                                </div>
                                <span class="text-lg font-black text-outline/40">2</span>
                            </div>
                            <!-- Contributor 3 -->
                            <div class="flex items-center gap-4">
                                <img alt="Marcus T." class="w-10 h-10 rounded-full object-cover shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDX7_byq4NkO3lzuB0BDyHA1mzOFfDP8tnZDpeCna3hpi7OrgiLMdmIbQYJDKFAf3IcllGpwtZCE_RTKFCTp20_M4j-6UoPIFtydqy39lM6O0zmb5dlxxt1YQQwBt3rJJF_9EDtTD0jHNG7rCL-N84MkZWtKFUBL_tnI4gC8zB9Qdrc__UnrPWFUKXGz-kbZrFg8IM2BLzOnU9Pu_d0vXr5Fl49sTwI3Kd84tcfMZkYcsiwEp8OQVoVspsANMFEt4u7HrUHge152DQs"/>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-on-surface">Marcus T.</p>
                                    <p class="text-xs font-medium text-on-surface-variant">Patissier • 3.1k pts</p>
                                </div>
                                <span class="text-lg font-black text-outline/40">3</span>
                            </div>
                        </div>
                    </div>

                    <!-- Flavor Profile Tags -->
                    <div class="pt-2">
                        <h4 class="text-xs font-black text-outline uppercase tracking-wider mb-4">Trending Flavors</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-secondary-container text-on-secondary-container px-4 py-1.5 rounded-full text-xs font-bold shadow-sm">Earthy</span>
                            <span class="bg-secondary-container text-on-secondary-container px-4 py-1.5 rounded-full text-xs font-bold shadow-sm">Fermented</span>
                            <span class="bg-surface-container-high text-on-surface-variant px-4 py-1.5 rounded-full text-xs font-bold hover:bg-surface-variant cursor-pointer transition-colors shadow-sm">Roasted</span>
                            <span class="bg-surface-container-high text-on-surface-variant px-4 py-1.5 rounded-full text-xs font-bold hover:bg-surface-variant cursor-pointer transition-colors shadow-sm">Zesty</span>
                        </div>
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
