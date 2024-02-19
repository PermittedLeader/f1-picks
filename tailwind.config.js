import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/permittedleader/*/*.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './config/*.php'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                "success": {
                    "light": "#d1e9b2",
                    "mid": "#8cc73f",
                    "dark": "#385019"
                },
                "info": {
                    "light": "#99def9",
                    "mid": "#00adef",
                    "dark": "#004560",
                },
                "warning": {
                    "light": "#fddca3",
                    "mid": "#faa81a",
                    "dark": "#64430a"
                },
                "danger": {
                    "light": "#f799d2",
                    "mid": "#ec008e",
                    "dark": "#5e0039"
                },
                "brand": {
                    "light": "#fca5a5",
                    "mid": "#b91c1c",
                    "dark": "#7f1d1d",
                },
                "secondary": {
                    "light": "#0689B1",
                    "mid": "#045C77",
                    "dark": "#022E3B",
                },
                "gray": {
                    "50":   "#F6F6F6",
                    "100":  "#D4D4D4",
                    "200":  "#B3B3B3",
                    "300":  "#A2A2A2",
                    "400":  "#919191",
                    "500":  "#808080",
                    "600":  "#666666",
                    "700":  "#4d4d4d",
                    "800":  "#333333",
                    "900":  "#1a1a1a",
                    "950":  "#080808"
                },
                "white": "#FFFFFF",
                "black": "#000000"
            },
            borderOpacity: ({theme}) => theme('opacity')
        },
    },

    plugins: [forms],
};
