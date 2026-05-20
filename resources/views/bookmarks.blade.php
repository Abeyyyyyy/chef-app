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
    <x-sidebar active="bookmarks" />

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
                            <img alt="Pan-seared salmon" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out" src="https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=1200&auto=format&fit=crop"/>
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
                            <img alt="Avocado toast" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out" src="https://images.unsplash.com/photo-1525351484163-7529414344d8?q=80&w=1200&auto=format&fit=crop"/>
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
                            <img alt="Handmade pasta" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out" src="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?q=80&w=1200&auto=format&fit=crop"/>
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
                    @forelse($bookmarkedSessions as $session)
                        <a class="block bg-surface-container-lowest p-6 rounded-3xl border border-surface-variant/60 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group" href="/chat?session={{ $session->id }}">
                            <div class="flex items-start gap-4">
                                <div class="bg-primary/10 p-3 rounded-full text-primary shrink-0 group-hover:bg-primary group-hover:text-white transition-colors">
                                    <span class="material-symbols-outlined icon-fill">bookmark</span>
                                </div>
                                <div class="min-w-0 flex-1 relative">
                                    <button onclick="toggleBookmark(event, '{{ $session->id }}')" class="absolute top-0 right-0 text-primary hover:text-secondary/30 transition-colors p-1 rounded-full hover:bg-surface-container-high" title="Hapus Penanda">
                                        <span class="material-symbols-outlined text-[20px] icon-fill">bookmark</span>
                                    </button>
                                    <h4 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors leading-tight truncate pr-8">{{ $session->title }}</h4>
                                    @if($session->latestMessage)
                                        @php
                                            $previewContent = $session->latestMessage->content;
                                            if ($session->latestMessage->sender_role === 'assistant' && !empty($session->latestMessage->recipe_data)) {
                                                $rData = is_string($session->latestMessage->recipe_data) ? json_decode($session->latestMessage->recipe_data, true) : $session->latestMessage->recipe_data;
                                                if (isset($rData['description'])) {
                                                    $previewContent = $rData['description'];
                                                }
                                            }
                                        @endphp
                                        <p class="text-sm text-on-surface-variant mb-4 leading-relaxed line-clamp-2">{{ Str::limit($previewContent, 120) }}</p>
                                    @endif
                                    <div class="flex items-center gap-4 text-xs text-secondary font-bold">
                                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">chat_bubble</span> {{ $session->messages_count }} pesan</span>
                                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> {{ $session->last_active_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full py-12 flex flex-col items-center justify-center text-on-surface-variant/50">
                            <span class="material-symbols-outlined text-5xl mb-3">bookmark</span>
                            <p class="text-base font-medium mb-1">Belum ada percakapan tersimpan</p>
                            <p class="text-sm">Bookmark percakapan dengan AI dari halaman chat</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="mt-12">
                <div class="mb-8 flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-on-surface flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">restaurant_menu</span>
                        Resep Eksplorasi Tersimpan
                    </h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @forelse($bookmarkedRecipes ?? [] as $recipe)
                        <article class="recipe-card bg-white rounded-3xl overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative border border-surface-variant/60 flex flex-col" id="recipe-{{ $recipe->recipe_id }}">
                            <button class="absolute top-4 right-4 z-10 bg-white p-2 rounded-full text-primary hover:text-error transition-colors shadow-md bookmark-btn" onclick="removeExploreBookmark(event, {{ $recipe->recipe_id }})">
                                <span class="material-symbols-outlined icon-bookmark text-[20px] icon-fill">bookmark</span>
                            </button>
                            <div class="relative h-56 overflow-hidden bg-surface-container-low">
                                <img alt="{{ $recipe->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ $recipe->image }}"/>
                            </div>
                            <div class="p-6 flex flex-col flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="text-primary font-bold text-[11px] uppercase tracking-wider">{{ $recipe->category }}</span>
                                    <span class="flex items-center text-[11px] text-on-surface-variant font-medium"><span class="material-symbols-outlined text-[14px] mr-1">schedule</span> {{ $recipe->time }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-on-surface mb-2 leading-tight">
                                    <a href="{{ route('recipe.detail', ['slug' => $recipe->slug]) }}" class="hover:text-primary transition-colors before:absolute before:inset-0">
                                        {{ $recipe->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-on-surface-variant mb-6 line-clamp-2 relative z-10">{{ $recipe->description }}</p>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-12 flex flex-col items-center justify-center text-on-surface-variant/50">
                            <span class="material-symbols-outlined text-5xl mb-3">restaurant_menu</span>
                            <p class="text-base font-medium mb-1">Belum ada resep tersimpan</p>
                            <p class="text-sm">Eksplorasi resep dan simpan yang Anda sukai</p>
                            <a href="/explore" class="mt-4 bg-primary text-white font-bold py-2 px-6 rounded-full hover:bg-primary-container transition-colors text-sm">Eksplorasi Sekarang</a>
                        </div>
                    @endforelse
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

        async function toggleBookmark(e, sessionId) {
            e.preventDefault();
            e.stopPropagation();
            
            if (!confirm('Hapus penanda ini?')) return;
            
            try {
                const response = await fetch(`/chat/session/${sessionId}/bookmark`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Gagal mengubah penanda.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan.');
            }
        }

        async function removeExploreBookmark(e, recipeId) {
            e.preventDefault();
            e.stopPropagation();
            
            if (!confirm('Hapus resep ini dari penanda?')) return;
            
            try {
                const response = await fetch('/explore/bookmark', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        recipe_id: recipeId,
                        // Provide dummy required fields for deletion since the backend only uses recipe_id to find and delete it
                        title: 'dummy',
                        slug: 'dummy'
                    })
                });
                
                if (response.ok) {
                    const data = await response.json();
                    if (data.status === 'removed') {
                        document.getElementById('recipe-' + recipeId).remove();
                        // Optionally refresh the page to update empty state if needed
                        if (document.querySelectorAll('[id^="recipe-"]').length === 0) {
                            window.location.reload();
                        }
                    }
                } else {
                    alert('Gagal menghapus penanda.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan.');
            }
        }
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
    <x-support-modal />
</body>
</html>
