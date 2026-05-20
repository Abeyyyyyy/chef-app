<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <!-- Sidebar Overlay -->
    <x-sidebar active="history" />

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
                <a href="/settings">
                    <img alt="User Avatar" class="w-9 h-9 rounded-full object-cover ml-2 border border-surface-variant" src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode(auth()->user()->name) }}&backgroundColor=fbf9f0"/>
                </a>
            </div>
        </nav>

        <!-- Main Canvas -->
        <main class="flex-1 px-6 py-10 md:px-12 max-w-5xl mx-auto w-full pb-20">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 relative z-10">
                <div>
                    <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight text-on-surface mb-2 leading-tight">Riwayat Aktivitas</h2>
                    <p class="font-body text-on-surface-variant text-lg">Jejak percakapanmu dengan Chef AI.</p>
                </div>
                <a href="/chat" class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary to-primary-container text-white rounded-full font-bold text-sm hover:shadow-lg hover:shadow-primary/30 active:scale-95 transition-all shadow-md">
                    <span class="material-symbols-outlined text-[20px]">add_circle</span>
                    Sesi Baru
                </a>
            </div>

            <!-- Timeline Content -->
            <div class="space-y-12 relative z-10">
                @forelse($grouped as $dateLabel => $sessions)
                    <section class="relative">
                        <h3 class="text-xl font-bold text-secondary mb-6 flex items-center gap-4">
                            {{ $dateLabel }}
                            <div class="h-[1px] flex-1 bg-surface-variant"></div>
                        </h3>
                        <div class="space-y-4">
                            @foreach($sessions as $session)
                                <a href="/chat?session={{ $session->id }}"
                                   class="group flex items-center gap-4 p-4 md:p-5 rounded-3xl bg-white hover:bg-surface-container-lowest shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer border border-surface-variant/60">
                                    <div class="w-12 h-12 md:w-14 md:h-14 shrink-0 rounded-2xl bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                        <span class="material-symbols-outlined icon-fill text-xl md:text-2xl">chat</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-base md:text-lg text-on-surface font-bold truncate tracking-tight group-hover:text-primary transition-colors">{{ $session->title }}</h4>
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
                                            <p class="text-xs md:text-sm text-on-surface-variant mt-0.5 line-clamp-1 opacity-80">
                                                {{ $session->latestMessage->sender_role === 'assistant' ? 'Chef: ' : 'Anda: ' }}{{ Str::limit($previewContent, 60) }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="flex flex-col items-end gap-2 shrink-0">
                                        <div class="flex items-center gap-2">
                                            @if($session->is_bookmarked)
                                                <span class="text-primary">
                                                    <span class="material-symbols-outlined text-[18px] md:text-[20px] icon-fill">bookmark</span>
                                                </span>
                                            @endif
                                            <button onclick="deleteSession(event, '{{ $session->id }}')" class="text-secondary/30 hover:text-error transition-colors p-1 rounded-full hover:bg-error/5">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </div>
                                        <span class="text-[10px] md:text-xs text-on-surface-variant font-bold opacity-60">{{ $session->last_active_at->format('H:i') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @empty
                    <div class="py-20 flex flex-col items-center justify-center text-on-surface-variant/50">
                        <span class="material-symbols-outlined text-6xl mb-4">history</span>
                        <p class="text-lg font-medium mb-2">Belum ada riwayat percakapan</p>
                        <p class="text-sm mb-6">Mulai sesi baru untuk berinteraksi dengan Chef AI</p>
                        <a href="/chat" class="bg-primary text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-primary-container transition-colors shadow-md">
                            Mulai Sesi Baru
                        </a>
                    </div>
                @endforelse
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

        async function deleteSession(e, sessionId) {
            e.preventDefault();
            e.stopPropagation();
            
            if (!confirm('Hapus riwayat percakapan ini?')) return;
            
            try {
                const response = await fetch(`/chat/session/${sessionId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });
                
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Gagal menghapus sesi.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus sesi.');
            }
        }
    </script>

    <!-- Logout Modal -->
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
                sidebar.addEventListener('mouseenter', () => { sessionStorage.setItem('sidebarHovered', 'true'); });
                sidebar.addEventListener('mouseleave', () => { sessionStorage.setItem('sidebarHovered', 'false'); if (forceStyle) forceStyle.remove(); });
            }
        });
    </script>
    <x-support-modal />
</body>
</html>
