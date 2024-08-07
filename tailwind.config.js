import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors');
import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                roboto: ['Roboto', 'sans-serif'],
                anton: ['Anton', 'sans-serif'],
            },
            boxShadow: {
                'calendar': '0 1px 0 #bdbdbd, 0 2px 0 #fff, 0 3px 0 #bdbdbd, 0 4px 0 #fff, 0 5px 0 #bdbdbd, 0 0 0 1px #bdbdbd',
            },
            keyframes: {
                scale: {
                  '0%, 100%': { transform: 'scale(1)' },
                  '50%': { transform: 'scale(1.1)' },
                },
              },
              animation: {
                'scale-up-down': 'scale 2s infinite',
              },
              colors: {
                teal: colors.teal,
                cyan: colors.cyan,
                lime: colors.lime,
                rose: colors.rose,
                amber: colors.amber,
              },
        },
        keyframes: {
            bounceHorizontal: {
                '0%, 100%': {
                    transform: 'translateX(-25%)',
                    'animation-timing-function': 'cubic-bezier(0.8, 0, 1, 1)',
                },
                '50%': {
                    transform: 'translateX(0)',
                    'animation-timing-function': 'cubic-bezier(0, 0, 0.2, 1)',
                },
            },
        },
        animation: {
            bounceHorizontal: 'bounceHorizontal 1s infinite',
        },
        colors: {
            red: colors.red,
            black: colors.black,
            slate: colors.slate,
            white: colors.white,
            green: colors.green,
            yellow: colors.yellow,
            gray: colors.trueGray,
            transparent: 'transparent',
            blue: {
                '50': '#f0f8ff',
                '100': '#dff0ff',
                '200': '#b9e2fe',
                '300': '#7bcdfe',
                '400': '#34b4fc',
                '500': '#0a9bed',
                '600': '#007acb',
                '700': '#006cb6',
                '800': '#055387',
                '900': '#0a4570',
                '950': '#072c4a',
            },
            teal: colors.teal,
            cyan: colors.cyan,
            lime: colors.lime,
            rose: colors.rose,
            amber: colors.amber,
            screens: {
                'md': '1768px',
                'lg': '1024px',
                'xl': '1280px',
                '2xl': '1536px',
            },
        }
    },

    plugins: [
        forms,
        daisyui,
        require('tailwind-scrollbar-hide')
    ],
};
