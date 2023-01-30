const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            width: {
                '300': '300px',
            },
            minHeight: {
                '300': '300px',
                '400': '400px'
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                roboto: ['Roboto', 'sans-serif'],
            },
            keyframes: {
                wiggle: {
                  '0%': { transform: 'rotate(-3deg)' },
                  '50%': { transform: 'rotate(3deg)' },
                  '100%': { transform: 'rotate(0)' },
                }
            },
            animation: {
                wiggle: 'wiggle 250ms ease-in-out 2',
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
