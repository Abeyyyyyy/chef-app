import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/View/ComponentViews/*.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                "brand-green": "#2D9B4E",
                "brand-dark-green": "#1e7a3a",
                "primary": "#006b2d",
                "secondary": "#80534c",
                "background": "#FEFCF3",
                "surface-container": "#f0eee5",
                "surface-container-high": "#eae8e0",
                "on-surface": "#1b1c17",
                "outline": "#6e7a6d",
            },
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                "fade-up": "fadeUp 0.4s ease-out forwards",
            },
            keyframes: {
                fadeUp: {
                    "0%": { opacity: "0", transform: "translateY(20px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" }
                }
            }
        },
    },
    plugins: [forms],
};