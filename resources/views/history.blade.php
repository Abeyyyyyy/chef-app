<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Chef Simulator - Riwayat Aktivitas</title>
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
<body class="font-body text-on-surface bg-texture antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Sidebar Overlay for Mobile & Desktop -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 hidden opacity-0 transition-all duration-300 ease-in-out" onclick="closeSidebar()"></div>

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
            <a href="/history" class="flex items-center bg-primary text-white shadow-md shadow-primary/20 hover:bg-primary rounded-xl overflow-hidden transition-colors">
                <div class="w-14 h-12 shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">history</span>
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

        <!-- Main Canvas -->
        <main class="flex-1 px-6 py-10 md:px-12 max-w-5xl mx-auto w-full pb-20">
            <!-- Page Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 relative z-10">
                <div>
                    <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight text-on-surface mb-2 leading-tight">Riwayat Aktivitas</h2>
                    <p class="font-body text-on-surface-variant text-lg">Jejak perjalanan kulinermu, dari dapur hingga meja makan.</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="relative sm:hidden group flex-1">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                        <input class="w-full bg-surface-container-high rounded-full py-3 pl-10 pr-4 text-sm border-transparent focus:ring-2 focus:ring-primary/30 transition-colors font-body text-on-surface" placeholder="Cari riwayat..." type="text"/>
                    </div>
                    <button class="flex items-center justify-center gap-2 px-6 py-3 bg-white border border-surface-variant text-primary rounded-full font-bold text-sm hover:bg-surface-container-low transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-[20px]">tune</span>
                        <span class="hidden sm:inline">Filter</span>
                    </button>
                </div>
            </div>

            <!-- Timeline Content -->
            <div class="space-y-12 relative z-10">
                
                <!-- Group: Hari Ini -->
                <section class="relative">
                    <h3 class="text-xl font-bold text-secondary mb-6 flex items-center gap-4">
                        Hari Ini
                        <div class="h-[1px] flex-1 bg-surface-variant"></div>
                    </h3>
                    <div class="space-y-4">
                        <!-- Card 1 -->
                        <div class="group flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 rounded-3xl bg-white hover:bg-surface-container-lowest shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer border border-surface-variant/60">
                            <div class="w-full sm:w-28 h-40 sm:h-24 shrink-0 rounded-2xl overflow-hidden relative">
                                <img alt="Sup Daging" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" src="https://images.unsplash.com/photo-1582878826629-29b7ad1cb431?q=80&w=600&auto=format&fit=crop"/>
                            </div>
                            <div class="flex-1 flex flex-col justify-center min-w-0">
                                <h4 class="text-xl text-on-surface font-bold truncate tracking-tight group-hover:text-primary transition-colors">Sup Daging Rempah</h4>
                                <p class="text-sm text-on-surface-variant mt-1">Dimasak secara perlahan selama 4 jam.</p>
                            </div>
                            <div class="flex items-center gap-4 sm:flex-col sm:items-end w-full sm:w-auto mt-2 sm:mt-0 justify-between sm:justify-center">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-primary/10 text-primary text-[11px] font-bold uppercase tracking-widest border border-primary/20">
                                    <span class="material-symbols-outlined text-[14px] mr-1 icon-fill">check_circle</span>
                                    Selesai Dimasak
                                </span>
                                <span class="text-sm text-on-surface-variant font-medium">14:30</span>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="group flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 rounded-3xl bg-white hover:bg-surface-container-lowest shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer border border-surface-variant/60">
                            <div class="w-full sm:w-28 h-40 sm:h-24 shrink-0 rounded-2xl overflow-hidden relative">
                                <img alt="Pasta Carbonara" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" src="https://images.unsplash.com/photo-1611270629569-8b357cb88da9?q=80&w=600&auto=format&fit=crop"/>
                            </div>
                            <div class="flex-1 flex flex-col justify-center min-w-0">
                                <h4 class="text-xl text-on-surface font-bold truncate tracking-tight group-hover:text-primary transition-colors">Classic Carbonara</h4>
                                <p class="text-sm text-on-surface-variant mt-1">Persiapan cepat, sangat lezat.</p>
                            </div>
                            <div class="flex items-center gap-4 sm:flex-col sm:items-end w-full sm:w-auto mt-2 sm:mt-0 justify-between sm:justify-center">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-secondary-container text-on-secondary-container text-[11px] font-bold uppercase tracking-widest border border-secondary/20">
                                    <span class="material-symbols-outlined text-[14px] mr-1">visibility</span>
                                    Dilihat
                                </span>
                                <span class="text-sm text-on-surface-variant font-medium">09:15</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Group: Kemarin -->
                <section class="relative">
                    <h3 class="text-xl font-bold text-secondary mb-6 flex items-center gap-4">
                        Kemarin
                        <div class="h-[1px] flex-1 bg-surface-variant"></div>
                    </h3>
                    <div class="space-y-4">
                        <!-- Card 3 -->
                        <div class="group flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 rounded-3xl bg-white hover:bg-surface-container-lowest shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer border border-surface-variant/60">
                            <div class="w-full sm:w-28 h-40 sm:h-24 shrink-0 rounded-2xl overflow-hidden relative">
                                <img alt="Ayam Bakar" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" src="https://images.unsplash.com/photo-1598514982205-f36b96d1e8d4?q=80&w=600&auto=format&fit=crop"/>
                            </div>
                            <div class="flex-1 flex flex-col justify-center min-w-0">
                                <h4 class="text-xl text-on-surface font-bold truncate tracking-tight group-hover:text-primary transition-colors">Ayam Bakar Madu</h4>
                                <p class="text-sm text-on-surface-variant mt-1">Dimarinasi semalaman.</p>
                            </div>
                            <div class="flex items-center gap-4 sm:flex-col sm:items-end w-full sm:w-auto mt-2 sm:mt-0 justify-between sm:justify-center">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-primary/10 text-primary text-[11px] font-bold uppercase tracking-widest border border-primary/20">
                                    <span class="material-symbols-outlined text-[14px] mr-1 icon-fill">check_circle</span>
                                    Selesai Dimasak
                                </span>
                                <span class="text-sm text-on-surface-variant font-medium">19:00</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
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
