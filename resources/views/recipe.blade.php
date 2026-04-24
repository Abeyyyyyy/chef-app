<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Chef Simulator - {{ $recipe['title'] }}</title>
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
    </style>
</head>
<body class="font-body text-on-surface bg-texture antialiased min-h-screen">
    <!-- TopAppBar -->
    <header class="glass-nav sticky top-0 z-50 w-full bg-[#fbf9f0]/80 border-b border-surface-variant/50 transition-colors px-6 py-4 flex justify-between items-center">
        <!-- Back Button -->
        <a href="/explore" class="p-2 rounded-full hover:bg-surface-container-high transition-colors text-primary flex items-center justify-center">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">arrow_back</span>
        </a>
        <div class="text-xl font-bold italic text-primary tracking-tight">The Atelier</div>
        <div class="flex gap-2">
            <button class="p-2 rounded-full hover:bg-surface-container-high transition-colors text-primary">
                <span class="material-symbols-outlined">favorite</span>
            </button>
            <button class="p-2 rounded-full hover:bg-surface-container-high transition-colors text-primary">
                <span class="material-symbols-outlined">share</span>
            </button>
        </div>
    </header>

    <main class="">
        <!-- Hero Section -->
        <section class="relative w-full aspect-[21/9] min-h-[400px] max-h-[600px] overflow-hidden">
            <img alt="{{ $recipe['title'] }}" class="w-full h-full object-cover" src="{{ $recipe['image'] }}"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-full p-8 md:p-16 lg:px-24">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-primary/20 backdrop-blur-sm border border-primary/30 text-white text-xs font-bold uppercase tracking-widest mb-4">
                    {{ $recipe['category'] }}
                </div>
                <h1 class="text-4xl md:text-6xl font-display font-extrabold text-white tracking-tight leading-tight mb-3">{{ $recipe['title'] }}</h1>
                <p class="text-white/80 text-lg md:text-xl font-medium max-w-2xl">{{ $recipe['description'] }}</p>
            </div>
        </section>

        <!-- Floating Metadata Bar -->
        <div class="relative z-10 -mt-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-surface-container-lowest rounded-2xl ambient-shadow p-6 flex flex-wrap justify-center gap-8 md:gap-16 items-center text-center border border-surface-variant/50">
                <div class="flex flex-col items-center">
                    <span class="material-symbols-outlined text-secondary mb-1">timer</span>
                    <span class="text-[10px] uppercase tracking-widest font-bold text-outline">Prep</span>
                    <span class="font-bold text-on-surface">30 min</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="material-symbols-outlined text-secondary mb-1">local_fire_department</span>
                    <span class="text-[10px] uppercase tracking-widest font-bold text-outline">Cook</span>
                    <span class="font-bold text-on-surface">45 min</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="material-symbols-outlined text-secondary mb-1">signal_cellular_alt</span>
                    <span class="text-[10px] uppercase tracking-widest font-bold text-outline">Level</span>
                    <span class="font-bold text-on-surface">{{ $recipe['difficulty'] }}</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="material-symbols-outlined text-secondary mb-1">restaurant</span>
                    <span class="text-[10px] uppercase tracking-widest font-bold text-outline">Yields</span>
                    <span class="font-bold text-on-surface">1 Loaf</span>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
                <!-- Left Column (70%) -->
                <div class="flex-1 space-y-16">
                    <!-- The Story -->
                    <section class="prose prose-lg max-w-none">
                        <p class="text-lg leading-relaxed text-on-surface-variant font-medium">
                            Baking is a journey of patience and observation. This recipe is designed to guide you through the tactile process of creating a masterpiece at home. The secret lies not just in the ingredients, but in understanding how the dough feels at every stage.
                        </p>
                    </section>
                    
                    <!-- Ingredients -->
                    <section>
                        <h2 class="text-2xl font-display font-bold mb-6 text-on-surface tracking-tight">The Elements</h2>
                        <div class="bg-surface-container-lowest rounded-2xl p-8 ambient-shadow border border-surface-variant/50">
                            <ul class="space-y-5">
                                <li class="flex items-start gap-4">
                                    <input class="mt-1 w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary bg-surface" type="checkbox"/>
                                    <div>
                                        <span class="font-bold text-on-surface block text-lg">400g Bread Flour</span>
                                        <span class="text-sm text-on-surface-variant">High protein content is crucial for gluten development</span>
                                    </div>
                                </li>
                                <li class="flex items-start gap-4">
                                    <input class="mt-1 w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary bg-surface" type="checkbox"/>
                                    <div>
                                        <span class="font-bold text-on-surface block text-lg">100g Whole Wheat Flour</span>
                                        <span class="text-sm text-on-surface-variant">Adds earthy depth and complexity to the flavor profile</span>
                                    </div>
                                </li>
                                <li class="flex items-start gap-4">
                                    <input class="mt-1 w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary bg-surface" type="checkbox"/>
                                    <div>
                                        <span class="font-bold text-on-surface block text-lg">375g Filtered Water</span>
                                        <span class="text-sm text-on-surface-variant">At room temperature (around 75°F/24°C)</span>
                                    </div>
                                </li>
                                <li class="flex items-start gap-4">
                                    <input class="mt-1 w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary bg-surface" type="checkbox"/>
                                    <div>
                                        <span class="font-bold text-on-surface block text-lg">100g Active Sourdough Starter</span>
                                        <span class="text-sm text-on-surface-variant">Fed 4-6 hours prior, bubbly and active</span>
                                    </div>
                                </li>
                                <li class="flex items-start gap-4">
                                    <input class="mt-1 w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary bg-surface" type="checkbox"/>
                                    <div>
                                        <span class="font-bold text-on-surface block text-lg">10g Fine Sea Salt</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                    
                    <!-- Instructions -->
                    <section>
                        <h2 class="text-2xl font-display font-bold mb-8 text-on-surface tracking-tight">The Process</h2>
                        <div class="space-y-12">
                            <!-- Step 1 -->
                            <div class="relative pl-14">
                                <div class="absolute left-0 top-0 w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-lg shadow-sm">1</div>
                                <h3 class="text-xl font-bold text-on-surface mb-3">Autolyse</h3>
                                <p class="text-on-surface-variant mb-6 leading-relaxed">In a large mixing bowl, combine the bread flour, whole wheat flour, and 350g of the water. Mix by hand until just combined and no dry spots remain. Cover with a damp towel and let rest for 1 hour. This allows the flour to hydrate fully before adding the starter or salt.</p>
                                <img alt="Mixing dough" class="w-full h-64 object-cover rounded-2xl ambient-shadow" src="https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=800&auto=format&fit=crop"/>
                            </div>
                            <!-- Step 2 -->
                            <div class="relative pl-14">
                                <div class="absolute left-0 top-0 w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-lg shadow-sm">2</div>
                                <h3 class="text-xl font-bold text-on-surface mb-3">Mix and Fold</h3>
                                <p class="text-on-surface-variant mb-4 leading-relaxed">Add the active starter, salt, and the remaining 25g of water to the dough. Pinch the dough to incorporate the ingredients evenly. Perform a series of stretch and folds every 30 minutes for the next 2 hours (4 sets total).</p>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right Column (30%) -->
                <aside class="w-full lg:w-[360px] flex-shrink-0 space-y-8">
                    <!-- Actions -->
                    <div class="bg-surface-container-lowest rounded-2xl ambient-shadow p-6 flex flex-col gap-4 border border-surface-variant/50 sticky top-24">
                        <a href="/chat" class="bg-gradient-to-r from-primary to-primary-container text-white font-bold py-4 px-6 rounded-xl flex items-center justify-center gap-2 hover:opacity-90 active:scale-95 transition-all shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">play_circle</span>
                            Mulai Mode Masak
                        </a>
                        <button class="bg-surface-container-high border border-surface-variant text-on-surface font-bold py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 hover:bg-surface-variant transition-colors">
                            <span class="material-symbols-outlined text-[18px]">bookmark_add</span>
                            Save to Collection
                        </button>
                        <button class="bg-transparent text-secondary font-bold py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 hover:bg-surface-container-low transition-colors">
                            <span class="material-symbols-outlined text-[18px]">print</span>
                            Print Recipe
                        </button>

                        <div class="mt-4 pt-6 border-t border-surface-variant">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="material-symbols-outlined text-secondary">lightbulb</span>
                                <h3 class="text-lg font-bold text-on-surface">Chef's Wisdom</h3>
                            </div>
                            <p class="text-sm text-on-surface-variant leading-relaxed">
                                Temperature is an ingredient. If your kitchen is colder than 70°F, your bulk fermentation will take significantly longer. Use the visual cues of the dough rather than watching the clock.
                            </p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="w-full mt-12 py-10 border-t border-surface-variant bg-surface-container-lowest">
            <div class="max-w-6xl mx-auto px-6 text-xs uppercase tracking-widest font-bold text-outline flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-sm font-black text-primary italic">The Atelier</div>
                <div class="flex flex-wrap justify-center gap-8">
                    <a class="hover:text-primary transition-colors" href="#">About</a>
                    <a class="hover:text-primary transition-colors" href="#">Guidelines</a>
                    <a class="hover:text-primary transition-colors" href="#">Privacy</a>
                    <a class="hover:text-primary transition-colors" href="#">Support</a>
                </div>
                <div class="text-[10px]">© 2024 The Culinary Atelier.</div>
            </div>
        </footer>
    </main>
</body>
</html>
