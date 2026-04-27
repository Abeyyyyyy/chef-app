<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chef Simulator - Cooking Canvas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
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
                        body: ["Plus Jakarta Sans", "sans-serif"],
                        headline: ["Plus Jakarta Sans", "sans-serif"],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fbf9f0; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .icon-fill { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e4e3da; border-radius: 10px; }
        .glass-nav { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .pantry-chip { animation: chipIn 0.2s ease-out; }
        @keyframes chipIn { from { transform: scale(0.8); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        @keyframes fadeUp { from { transform: translateY(12px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .msg-animate { animation: fadeUp 0.3s ease-out; }
        .typing-dot { animation: blink 1.4s infinite both; }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        @keyframes blink { 0%,80%,100% { opacity:0.3; } 40% { opacity:1; } }
    </style>
</head>
<body class="h-screen flex flex-col overflow-hidden">

    <!-- Header -->
    <header class="px-6 py-3 bg-white/80 glass-nav border-b border-surface-variant flex justify-between items-center z-10 sticky top-0">
        <div class="flex items-center gap-4">
            <a href="/dashboard" class="p-2 hover:bg-surface-container-high rounded-full transition-colors flex items-center justify-center">
                <span class="material-symbols-outlined text-on-surface-variant">arrow_back</span>
            </a>
            <div>
                <h2 id="session-title" class="font-bold text-primary text-lg tracking-tight">Live Cooking Canvas</h2>
                <p class="text-xs text-on-surface-variant font-medium">Chef Atelier AI</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button id="bookmark-btn" onclick="toggleBookmark()" class="p-2 hover:bg-surface-container-high rounded-full transition-colors hidden" title="Bookmark sesi ini">
                <span class="material-symbols-outlined text-primary" id="bookmark-icon">bookmark</span>
            </button>
            <a href="/history" class="p-2 hover:bg-surface-container-high rounded-full transition-colors" title="Riwayat">
                <span class="material-symbols-outlined text-on-surface-variant">history</span>
            </a>
        </div>
    </header>

    <!-- Chat Canvas -->
    <main id="chat-canvas" class="flex-1 overflow-y-auto p-4 md:p-8 space-y-6 custom-scrollbar pb-48">
        @if(isset($existingSession) && $existingSession && count($existingMessages) > 0)
            @foreach($existingMessages as $msg)
                @if($msg->sender_role === 'user')
                    <div class="flex flex-row-reverse gap-3 items-start msg-animate">
                        <div class="w-9 h-9 rounded-full bg-secondary flex items-center justify-center text-white shadow shrink-0">
                            <span class="material-symbols-outlined text-[18px]">person</span>
                        </div>
                        <div class="bg-primary p-4 rounded-2xl rounded-tr-none text-white max-w-[85%] md:max-w-[70%] shadow-md">
                            <p class="text-sm font-medium leading-relaxed">{{ $msg->content }}</p>
                        </div>
                    </div>
                @elseif($msg->sender_role === 'assistant')
                    @if($msg->recipe_data)
                        <div class="flex gap-3 items-start msg-animate">
                            <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-white shadow shrink-0">
                                <span class="material-symbols-outlined text-[18px]">restaurant</span>
                            </div>
                            <div class="bg-white rounded-2xl shadow-md border border-surface-variant overflow-hidden max-w-[90%] md:max-w-[75%]">
                                <div class="bg-primary/5 p-5 border-b border-surface-variant">
                                    <h3 class="text-lg font-bold text-primary">{{ $msg->recipe_data['title'] ?? '' }}</h3>
                                </div>
                                <div class="p-5 text-sm text-on-surface-variant">
                                    <p>{{ $msg->content }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex gap-3 items-start msg-animate">
                            <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-white shadow shrink-0">
                                <span class="material-symbols-outlined text-[18px]">restaurant</span>
                            </div>
                            <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-surface-variant max-w-[85%] md:max-w-[70%]">
                                <p class="text-sm text-on-surface leading-relaxed whitespace-pre-line">{{ $msg->content }}</p>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        @else
            <!-- Welcome Message -->
            <div class="flex gap-3 items-start msg-animate">
                <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-white shadow-lg shrink-0">
                    <span class="material-symbols-outlined text-[18px]">restaurant</span>
                </div>
                <div class="bg-white p-5 rounded-2xl rounded-tl-none shadow-sm border border-surface-variant max-w-[85%] md:max-w-[70%]">
                    <p class="text-sm text-on-surface leading-relaxed">Halo Chef! 👋 Peralatan sudah siap. Klik tombol <strong class="text-primary">Pantry</strong> di bawah untuk memilih bahan dari dapur Anda, atau langsung ketik pertanyaan tentang masak-memasak!</p>
                </div>
            </div>
        @endif
    </main>

    <!-- Pantry Picker Popup -->
    <div id="pantry-popup" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" onclick="closePantryPicker()"></div>
        <div class="absolute bottom-24 left-1/2 -translate-x-1/2 w-[95%] max-w-lg bg-white rounded-2xl shadow-2xl border border-surface-variant overflow-hidden transform scale-95 opacity-0 transition-all duration-200" id="pantry-panel">
            <div class="p-4 border-b border-surface-variant bg-surface-container-low flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary icon-fill">inventory_2</span>
                    <h3 class="font-bold text-on-surface">Pilih dari Pantry</h3>
                </div>
                <button onclick="closePantryPicker()" class="p-1 hover:bg-surface-container-high rounded-full transition-colors">
                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]">close</span>
                </button>
            </div>
            <div id="pantry-loading" class="p-8 text-center text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl animate-spin">progress_activity</span>
                <p class="text-sm mt-2">Memuat isi pantry...</p>
            </div>
            <div id="pantry-list" class="p-4 max-h-[300px] overflow-y-auto custom-scrollbar hidden">
                <div id="pantry-empty" class="py-8 text-center text-on-surface-variant hidden">
                    <span class="material-symbols-outlined text-4xl mb-2">inventory_2</span>
                    <p class="text-sm">Pantry kosong. <a href="/pantry" class="text-primary font-bold hover:underline">Tambah bahan →</a></p>
                </div>
                <div id="pantry-items-grid" class="grid grid-cols-2 gap-2"></div>
            </div>
            <div id="pantry-footer" class="p-4 border-t border-surface-variant bg-surface-container-low hidden">
                <button onclick="confirmPantrySelection()" class="w-full bg-gradient-to-r from-primary to-primary-container text-white font-bold py-3 rounded-xl shadow-sm hover:shadow-md active:scale-95 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                    <span id="confirm-count">Gunakan Bahan (0)</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Input Area -->
    <div class="fixed bottom-0 left-0 right-0 z-30 p-4 md:p-6 bg-gradient-to-t from-surface via-surface to-transparent">
        <div class="max-w-4xl mx-auto">
            <!-- Selected Pantry Chips -->
            <div id="selected-chips" class="flex flex-wrap gap-2 mb-3 empty:mb-0"></div>
            <!-- Input Row -->
            <div class="flex items-center bg-white rounded-2xl shadow-xl border border-surface-variant p-2 pl-3 focus-within:ring-2 focus-within:ring-primary/20 transition-all">
                <button onclick="openPantryPicker()" class="p-2 hover:bg-primary/10 rounded-xl transition-colors group shrink-0" title="Pilih dari Pantry">
                    <span class="material-symbols-outlined text-primary group-hover:text-primary-container icon-fill">inventory_2</span>
                </button>
                <input type="text" id="user-input"
                    onkeypress="if(event.key === 'Enter') sendMessage()"
                    placeholder="Tanya seputar masak-memasak..."
                    class="flex-1 border-none outline-none focus:ring-0 text-sm py-3 bg-transparent w-full px-3 text-on-surface placeholder:text-on-surface-variant/50">
                <button onclick="sendMessage()" id="send-btn" class="bg-primary text-white p-3 md:px-6 rounded-xl hover:bg-primary-container transition-all shadow-md flex items-center gap-2 shrink-0">
                    <span class="hidden md:inline font-bold text-sm">Kirim</span>
                    <span class="material-symbols-outlined text-[20px]">send</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // State
        let currentSessionId = @json($existingSession->id ?? null);
        let isBookmarked = @json($existingSession->is_bookmarked ?? false);
        let selectedPantryItems = [];
        let allPantryItems = [];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Init
        document.addEventListener('DOMContentLoaded', () => {
            if (currentSessionId) {
                document.getElementById('bookmark-btn').classList.remove('hidden');
                updateBookmarkIcon();
                scrollToBottom();
            }
            @if(isset($existingSession) && $existingSession)
                document.getElementById('session-title').textContent = @json($existingSession->title);
            @endif
        });

        function scrollToBottom() {
            const canvas = document.getElementById('chat-canvas');
            canvas.scrollTop = canvas.scrollHeight;
        }

        // ===== SESSION MANAGEMENT =====
        async function ensureSession() {
            if (currentSessionId) return currentSessionId;
            const pantryCtx = selectedPantryItems.map(i => `${i.name} (${i.quantity} ${i.unit})`).join(', ');
            const res = await fetch('/chat/session', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ pantry_context: pantryCtx || null })
            });
            const data = await res.json();
            currentSessionId = data.id;
            document.getElementById('bookmark-btn').classList.remove('hidden');
            // Update URL without reload
            window.history.replaceState({}, '', `/chat?session=${currentSessionId}`);
            return currentSessionId;
        }

        // ===== SEND MESSAGE =====
        async function sendMessage() {
            const inputField = document.getElementById('user-input');
            const chatCanvas = document.getElementById('chat-canvas');
            let message = inputField.value.trim();

            // Prepend pantry items if selected
            if (selectedPantryItems.length > 0 && !message) {
                const names = selectedPantryItems.map(i => i.name).join(', ');
                message = `Saya punya bahan: ${names}. Buatkan resep yang cocok.`;
            }

            if (!message) return;

            // Show user bubble
            chatCanvas.insertAdjacentHTML('beforeend', `
                <div class="flex flex-row-reverse gap-3 items-start msg-animate">
                    <div class="w-9 h-9 rounded-full bg-secondary flex items-center justify-center text-white shadow shrink-0">
                        <span class="material-symbols-outlined text-[18px]">person</span>
                    </div>
                    <div class="bg-primary p-4 rounded-2xl rounded-tr-none text-white max-w-[85%] md:max-w-[70%] shadow-md">
                        <p class="text-sm font-medium leading-relaxed">${escapeHtml(message)}</p>
                    </div>
                </div>
            `);
            inputField.value = '';
            scrollToBottom();

            // Show typing indicator
            const loadingId = 'loading-' + Date.now();
            chatCanvas.insertAdjacentHTML('beforeend', `
                <div id="${loadingId}" class="flex gap-3 items-start msg-animate">
                    <div class="w-9 h-9 rounded-full bg-primary/20 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary text-[18px]">restaurant</span>
                    </div>
                    <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-surface-variant">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 rounded-full bg-primary/60 typing-dot"></div>
                            <div class="w-2 h-2 rounded-full bg-primary/60 typing-dot"></div>
                            <div class="w-2 h-2 rounded-full bg-primary/60 typing-dot"></div>
                        </div>
                    </div>
                </div>
            `);
            scrollToBottom();

            try {
                const sessionId = await ensureSession();
                const response = await fetch('/chat/message', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({
                        session_id: sessionId,
                        message: message,
                        pantry_items: selectedPantryItems.length > 0 ? selectedPantryItems : null
                    })
                });
                const data = await response.json();
                document.getElementById(loadingId)?.remove();

                if (data.error) throw new Error(data.error);

                // Update session title
                if (data.session_title) {
                    document.getElementById('session-title').textContent = data.session_title;
                }

                // Render AI response
                if (data.recipe_data) {
                    renderRecipe(data.recipe_data);
                } else {
                    renderTextMessage(data.content);
                }

                // Clear pantry selection after first message
                selectedPantryItems = [];
                document.getElementById('selected-chips').innerHTML = '';

            } catch (error) {
                document.getElementById(loadingId)?.remove();
                chatCanvas.insertAdjacentHTML('beforeend', `
                    <div class="flex gap-3 items-start msg-animate">
                        <div class="bg-error/10 text-error p-4 rounded-2xl max-w-[80%] text-sm border border-error/20 shadow-sm">
                            <b>Aduh Chef!</b> ${escapeHtml(error.message)}
                        </div>
                    </div>
                `);
            }
            scrollToBottom();
        }

        function renderTextMessage(content) {
            const chatCanvas = document.getElementById('chat-canvas');
            chatCanvas.insertAdjacentHTML('beforeend', `
                <div class="flex gap-3 items-start msg-animate">
                    <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-white shadow-lg shrink-0">
                        <span class="material-symbols-outlined text-[18px]">restaurant</span>
                    </div>
                    <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-surface-variant max-w-[85%] md:max-w-[70%]">
                        <p class="text-sm text-on-surface leading-relaxed whitespace-pre-line">${escapeHtml(content)}</p>
                    </div>
                </div>
            `);
        }

        function renderRecipe(recipe) {
            const chatCanvas = document.getElementById('chat-canvas');
            const ingredientsList = (recipe.ingredients || []).map(i => `
                <li class="flex items-start gap-2 py-1 border-b border-surface-variant/30 last:border-0">
                    <span class="material-symbols-outlined text-primary text-[16px] mt-0.5">check_circle</span>
                    <span class="text-on-surface-variant">${escapeHtml(i)}</span>
                </li>
            `).join('');
            
            const stepsList = (recipe.steps || []).map((s, idx) => `
                <div class="flex gap-4">
                    <div class="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0 font-bold text-xs">${idx + 1}</div>
                    <p class="text-on-surface-variant leading-relaxed pb-4">${escapeHtml(s)}</p>
                </div>
            `).join('');

            const imageKeyword = recipe.image_keyword || recipe.title || 'gourmet food';
            const imageUrl = `https://source.unsplash.com/1200x800/?${encodeURIComponent(imageKeyword)}&sig=${Math.random()}`;

            chatCanvas.insertAdjacentHTML('beforeend', `
                <div class="flex gap-3 items-start msg-animate">
                    <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-white shadow-lg shrink-0">
                        <span class="material-symbols-outlined text-[18px]">restaurant</span>
                    </div>
                    <div class="bg-white rounded-[1.5rem] md:rounded-[2rem] shadow-xl border border-surface-variant/50 overflow-hidden max-w-[98%] md:max-w-[85%] lg:max-w-[70%]">
                        <!-- Header Image -->
                        <div class="relative h-48 md:h-72 w-full bg-surface-variant">
                            <img src="${imageUrl}" alt="${escapeHtml(recipe.title)}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=1200&q=80'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-4 md:p-6">
                                <h3 class="text-xl md:text-3xl font-extrabold text-white tracking-tight drop-shadow-md line-clamp-2">${escapeHtml(recipe.title || '')}</h3>
                            </div>
                        </div>

                        <!-- Quick Info Bar -->
                        <div class="grid grid-cols-3 gap-1 px-2 md:px-6 py-3 bg-primary/5 border-b border-surface-variant/50">
                            <div class="flex items-center gap-1.5 md:gap-2 justify-center">
                                <span class="material-symbols-outlined text-primary text-[18px] md:text-[20px]">schedule</span>
                                <div class="text-[9px] md:text-[11px] font-bold uppercase tracking-wider text-on-surface-variant">Waktu<br><span class="text-primary text-xs md:text-sm">${escapeHtml(recipe.waktu || '-')}</span></div>
                            </div>
                            <div class="flex items-center gap-1.5 md:gap-2 justify-center border-x border-surface-variant/30">
                                <span class="material-symbols-outlined text-primary text-[18px] md:text-[20px]">group</span>
                                <div class="text-[9px] md:text-[11px] font-bold uppercase tracking-wider text-on-surface-variant">Porsi<br><span class="text-primary text-xs md:text-sm">${escapeHtml(recipe.porsi || '-')}</span></div>
                            </div>
                            <div class="flex items-center gap-1.5 md:gap-2 justify-center">
                                <span class="material-symbols-outlined text-primary text-[18px] md:text-[20px]">equalizer</span>
                                <div class="text-[9px] md:text-[11px] font-bold uppercase tracking-wider text-on-surface-variant">Level<br><span class="text-primary text-xs md:text-sm">${escapeHtml(recipe.level || '-')}</span></div>
                            </div>
                        </div>

                        <div class="p-5 md:p-8 space-y-6 md:space-y-8">
                            <!-- Description -->
                            <p class="text-on-surface-variant italic leading-relaxed text-xs md:text-sm bg-surface-container-low p-4 rounded-xl border-l-4 border-primary">
                                "${escapeHtml(recipe.description || 'Resep spesial yang disiapkan khusus untuk Anda.')}"
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                                <!-- Ingredients -->
                                <div>
                                    <h4 class="font-bold text-secondary mb-3 md:mb-4 flex items-center gap-2 text-base md:text-lg uppercase tracking-tight">
                                        <span class="material-symbols-outlined bg-secondary/10 p-2 rounded-lg text-[18px] md:text-[20px]">kitchen</span>
                                        Bahan-bahan
                                    </h4>
                                    <ul class="space-y-1 text-xs md:text-sm">${ingredientsList}</ul>
                                </div>

                                <!-- Steps -->
                                <div>
                                    <h4 class="font-bold text-secondary mb-3 md:mb-4 flex items-center gap-2 text-base md:text-lg uppercase tracking-tight">
                                        <span class="material-symbols-outlined bg-secondary/10 p-2 rounded-lg text-[18px] md:text-[20px]">outdoor_grill</span>
                                        Langkah
                                    </h4>
                                    <div class="space-y-1 text-xs md:text-sm">${stepsList}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="p-6 bg-surface-container-low border-t border-surface-variant/50 flex justify-between items-center">
                            <p class="text-[11px] text-on-surface-variant font-medium">© Chef Atelier AI Premium Experience</p>
                            <button onclick="window.print()" class="p-2 hover:bg-white rounded-full transition-colors" title="Print Resep">
                                <span class="material-symbols-outlined text-primary text-[20px]">print</span>
                            </button>
                        </div>
                    </div>
                </div>
            `);
        }

        // ===== PANTRY PICKER =====
        async function openPantryPicker() {
            const popup = document.getElementById('pantry-popup');
            const panel = document.getElementById('pantry-panel');
            popup.classList.remove('hidden');
            setTimeout(() => { panel.style.transform = 'scale(1)'; panel.style.opacity = '1'; }, 10);

            // Load pantry items
            document.getElementById('pantry-loading').classList.remove('hidden');
            document.getElementById('pantry-list').classList.add('hidden');

            try {
                const res = await fetch('/api/pantry-items');
                allPantryItems = await res.json();
                renderPantryItems();
            } catch (e) {
                document.getElementById('pantry-loading').innerHTML = '<p class="text-error text-sm">Gagal memuat pantry</p>';
            }
        }

        function renderPantryItems() {
            document.getElementById('pantry-loading').classList.add('hidden');
            document.getElementById('pantry-list').classList.remove('hidden');

            const grid = document.getElementById('pantry-items-grid');
            const empty = document.getElementById('pantry-empty');
            const footer = document.getElementById('pantry-footer');

            if (allPantryItems.length === 0) {
                empty.classList.remove('hidden');
                grid.innerHTML = '';
                footer.classList.add('hidden');
                return;
            }

            empty.classList.add('hidden');
            footer.classList.remove('hidden');

            const iconMap = { 'Protein': 'set_meal', 'Sayuran': 'eco', 'Bumbu': 'nutrition', 'Karbohidrat': 'bakery_dining' };
            const colorMap = { 'Protein': 'text-secondary', 'Sayuran': 'text-primary', 'Bumbu': 'text-secondary', 'Karbohidrat': 'text-primary' };

            grid.innerHTML = allPantryItems.map(item => {
                const isSelected = selectedPantryItems.some(s => s.id === item.id);
                const icon = iconMap[item.category] || 'inventory_2';
                const color = colorMap[item.category] || 'text-primary';
                return `
                    <button onclick="togglePantryItem(${item.id})" id="pi-${item.id}"
                        class="flex items-center gap-2 p-3 rounded-xl border-2 transition-all text-left hover:shadow-md
                        ${isSelected ? 'border-primary bg-primary/5 shadow-sm' : 'border-surface-variant bg-white hover:border-primary/30'}">
                        <span class="material-symbols-outlined ${color} text-[20px] icon-fill shrink-0">${icon}</span>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-on-surface truncate">${escapeHtml(item.name)}</p>
                            <p class="text-[11px] text-on-surface-variant">${item.quantity} ${item.unit}</p>
                        </div>
                        ${isSelected ? '<span class="material-symbols-outlined text-primary text-[18px] icon-fill ml-auto shrink-0">check_circle</span>' : ''}
                    </button>`;
            }).join('');

            updateConfirmCount();
        }

        function togglePantryItem(id) {
            const item = allPantryItems.find(i => i.id === id);
            if (!item) return;
            const idx = selectedPantryItems.findIndex(s => s.id === id);
            if (idx >= 0) { selectedPantryItems.splice(idx, 1); }
            else { selectedPantryItems.push(item); }
            renderPantryItems();
        }

        function updateConfirmCount() {
            document.getElementById('confirm-count').textContent = `Gunakan Bahan (${selectedPantryItems.length})`;
        }

        function confirmPantrySelection() {
            closePantryPicker();
            renderSelectedChips();
        }

        function renderSelectedChips() {
            const container = document.getElementById('selected-chips');
            container.innerHTML = selectedPantryItems.map(item => `
                <span class="pantry-chip inline-flex items-center gap-1.5 bg-primary/10 text-primary border border-primary/20 px-3 py-1.5 rounded-full text-xs font-bold">
                    ${escapeHtml(item.name)}
                    <button onclick="removeChip(${item.id})" class="hover:bg-primary/20 rounded-full p-0.5 transition-colors">
                        <span class="material-symbols-outlined text-[14px]">close</span>
                    </button>
                </span>
            `).join('');
        }

        function removeChip(id) {
            selectedPantryItems = selectedPantryItems.filter(i => i.id !== id);
            renderSelectedChips();
        }

        function closePantryPicker() {
            const popup = document.getElementById('pantry-popup');
            const panel = document.getElementById('pantry-panel');
            panel.style.transform = 'scale(0.95)';
            panel.style.opacity = '0';
            setTimeout(() => popup.classList.add('hidden'), 200);
        }

        // ===== BOOKMARK =====
        async function toggleBookmark() {
            if (!currentSessionId) return;
            try {
                const res = await fetch(`/chat/session/${currentSessionId}/bookmark`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken }
                });
                const data = await res.json();
                isBookmarked = data.is_bookmarked;
                updateBookmarkIcon();
            } catch (e) { console.error(e); }
        }

        function updateBookmarkIcon() {
            const icon = document.getElementById('bookmark-icon');
            if (isBookmarked) { icon.classList.add('icon-fill'); icon.textContent = 'bookmark'; }
            else { icon.classList.remove('icon-fill'); icon.textContent = 'bookmark'; }
        }

        // ===== UTILS =====
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    </script>
</body>
</html>