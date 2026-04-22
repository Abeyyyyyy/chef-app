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
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fbf9f0; }
        .bg-primary { background-color: #006b2d; }
        .text-primary { color: #006b2d; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e4e3da; border-radius: 10px; }
    </style>
</head>
<body class="h-screen flex flex-col">

    <header class="px-6 py-4 bg-white/80 backdrop-blur-md border-b border-[#e4e3da] flex justify-between items-center z-10 sticky top-0">
        <div class="flex items-center gap-4">
            <a href="/dashboard" class="p-2 hover:bg-[#e4e3da] rounded-full transition-colors flex items-center justify-center">
                <span class="material-symbols-outlined text-gray-600">arrow_back</span>
            </a>
            <div>
                <h2 class="font-bold text-primary">Live Cooking Canvas</h2>
                <p class="text-xs text-gray-500">Nemotron AI Chef</p>
            </div>
        </div>
    </header>

    <main id="chat-canvas" class="flex-1 overflow-y-auto p-4 md:p-8 space-y-6 custom-scrollbar pb-32">
        <div class="flex gap-4 items-start">
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white shadow-lg shrink-0">
                <span class="material-symbols-outlined">restaurant</span>
            </div>
            <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-[#e4e3da] max-w-[85%] md:max-w-[70%]">
                <p class="text-sm text-gray-800 leading-relaxed">Halo Chef! Peralatan sudah siap. Bahan apa saja yang kamu miliki di dapur hari ini? Biar saya racikkan resep mewahnya.</p>
            </div>
        </div>
    </main>

    <div class="fixed bottom-0 left-0 right-0 p-4 md:p-6 bg-gradient-to-t from-[#fbf9f0] via-[#fbf9f0] to-transparent">
        <div class="max-w-4xl mx-auto relative">
            <div class="flex items-center bg-white rounded-2xl shadow-xl border border-[#e4e3da] p-2 pl-6 focus-within:ring-2 focus-within:ring-primary/20 transition-all">
                <input type="text" id="user-input" 
                    onkeypress="if(event.key === 'Enter') sendIngredients()"
                    placeholder="Contoh: Ayam, santan, kunyit..." 
                    class="flex-1 border-none outline-none focus:ring-0 text-sm py-3 bg-transparent w-full">
                <button onclick="sendIngredients()" class="bg-primary text-white p-3 md:px-6 rounded-xl hover:bg-[#0b873c] transition-all shadow-md flex items-center gap-2">
                    <span class="hidden md:inline font-bold text-sm">Masak</span>
                    <span class="material-symbols-outlined text-[20px]">send</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        async function sendIngredients() {
            const inputField = document.getElementById('user-input');
            const chatCanvas = document.getElementById('chat-canvas');
            const ingredients = inputField.value.trim();
            
            if (!ingredients) return;

            // Tambah Bubble User
            chatCanvas.innerHTML += `
                <div class="flex flex-row-reverse gap-4 items-start mb-6">
                    <div class="bg-primary p-4 rounded-2xl rounded-tr-none text-white max-w-[85%] md:max-w-[70%] shadow-md">
                        <p class="text-sm font-medium">${ingredients}</p>
                    </div>
                </div>
            `;
            inputField.value = ''; 
            chatCanvas.scrollTop = chatCanvas.scrollHeight;

            // Tambah Loading
            const loadingId = 'loading-' + Date.now();
            chatCanvas.innerHTML += `
                <div id="${loadingId}" class="flex gap-4 items-start mb-6 animate-pulse">
                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-gray-400">skillet</span>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-2xl rounded-tl-none text-gray-500 text-sm">
                        Chef sedang memasak resepmu...
                    </div>
                </div>
            `;
            chatCanvas.scrollTop = chatCanvas.scrollHeight;

            try {
                // Pastikan route ini sesuai dengan Route::post('/generate-recipe') di web.php kamu
                const response = await fetch('/generate-recipe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ ingredients: ingredients })
                });

                const recipe = await response.json();
                document.getElementById(loadingId).remove();

                if (recipe.error) throw new Error(recipe.error);

                // Tambah Bubble Resep AI
                chatCanvas.innerHTML += `
                    <div class="flex gap-4 items-start mb-6">
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white shadow-lg shrink-0">
                            <span class="material-symbols-outlined">restaurant</span>
                        </div>
                        <div class="bg-white rounded-2xl shadow-md border border-[#e4e3da] overflow-hidden max-w-[90%] md:max-w-[75%]">
                            <div class="bg-[#006b2d]/5 p-5 border-b border-[#e4e3da]">
                                <h3 class="text-lg md:text-xl font-bold text-primary">${recipe.title}</h3>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    <span class="text-[10px] font-bold bg-white px-3 py-1 rounded-full shadow-sm border border-[#e4e3da]">⏱ ${recipe.waktu}</span>
                                    <span class="text-[10px] font-bold bg-white px-3 py-1 rounded-full shadow-sm border border-[#e4e3da]">👥 ${recipe.porsi}</span>
                                    <span class="text-[10px] font-bold bg-[#ffc4ba] text-[#7b4e47] px-3 py-1 rounded-full shadow-sm">🔥 ${recipe.level}</span>
                                </div>
                            </div>
                            <div class="p-5 space-y-4 text-sm text-gray-700">
                                <div>
                                    <h4 class="font-bold text-[#80534c] mb-2 flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">kitchen</span> BAHAN:</h4>
                                    <ul class="list-disc ml-5 space-y-1">
                                        ${recipe.ingredients.map(ing => `<li>${ing}</li>`).join('')}
                                    </ul>
                                </div>
                                <hr class="border-[#e4e3da]">
                                <div>
                                    <h4 class="font-bold text-[#80534c] mb-2 flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">outdoor_grill</span> CARA MASAK:</h4>
                                    <ol class="list-decimal ml-5 space-y-2">
                                        ${recipe.steps.map(step => `<li>${step}</li>`).join('')}
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } catch (error) {
                document.getElementById(loadingId)?.remove();
                chatCanvas.innerHTML += `
                    <div class="flex gap-4 items-start mb-6">
                        <div class="bg-[#ffdad6] text-[#ba1a1a] p-4 rounded-2xl max-w-[80%] text-sm border border-[#ba1a1a]/20 shadow-sm">
                            <b>Aduh Chef!</b> ${error.message}
                        </div>
                    </div>
                `;
            }
            chatCanvas.scrollTop = chatCanvas.scrollHeight;
        }
    </script>
</body>
</html> 