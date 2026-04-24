const fs = require('fs');
const path = require('path');

const files = [
    'dashboard.blade.php',
    'explore.blade.php',
    'pantry.blade.php',
    'community.blade.php',
    'bookmarks.blade.php',
    'history.blade.php',
    'settings.blade.php'
];

const basePath = 'c:\\laragon\\www\\chef\\resources\\views';

files.forEach(file => {
    const filePath = path.join(basePath, file);
    let content = fs.readFileSync(filePath, 'utf8');

    // 1. Add preload to body class
    content = content.replace(/<body class="([^"]*)"/g, (match, p1) => {
        if (!p1.includes('preload')) {
            return `<body class="preload ${p1}"`;
        }
        return match;
    });

    // 2. Add preload style in head
    if (!content.includes('.preload * { transition: none !important; }')) {
        content = content.replace('</head>', `    <style>
        .preload * { transition: none !important; }
    </style>
</head>`);
    }

    // 3. Add md:hidden to hamburger menu button
    content = content.replace(
        /<button onclick="toggleSidebar\(\)" class="text-primary hover:bg-surface-container-high p-2 rounded-full transition-colors duration-200 flex">/g,
        '<button onclick="toggleSidebar()" class="text-primary hover:bg-surface-container-high p-2 rounded-full transition-colors duration-200 flex md:hidden">'
    );

    // 4. Add script to remove preload class
    if (!content.includes("document.body.classList.remove('preload');")) {
        content = content.replace('</body>', `    <script>
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.body.classList.remove('preload');
            }, 100);
        });
    </script>
</body>`);
    }

    fs.writeFileSync(filePath, content, 'utf8');
    console.log(`Updated ${file}`);
});
