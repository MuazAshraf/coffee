import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
                serif: ['"Fraunces"', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                cream: {
                    50:  '#fdfaf4',
                    100: '#faf3e7',
                    200: '#f3e6cd',
                    300: '#e8d3a8',
                    400: '#d9b977',
                },
                espresso: {
                    50:  '#f6f1ec',
                    100: '#e9ddd0',
                    200: '#c9ad8b',
                    300: '#9c7553',
                    400: '#6b4a30',
                    500: '#4a3120',
                    600: '#352216',
                    700: '#23160d',
                    800: '#160d07',
                    900: '#0b0703',
                },
                caramel: {
                    300: '#e0a96d',
                    400: '#cf8a3f',
                    500: '#b86e22',
                    600: '#92541a',
                },
            },
            backgroundImage: {
                'noise': "url(\"data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9'/%3E%3CfeColorMatrix values='0 0 0 0 0.3 0 0 0 0 0.2 0 0 0 0 0.1 0 0 0 0.18 0'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E\")",
            },
            animation: {
                'shimmer': 'shimmer 1.8s linear infinite',
                'float': 'float 6s ease-in-out infinite',
                'steam': 'steam 4s ease-in-out infinite',
            },
            keyframes: {
                shimmer: {
                    '0%':   { backgroundPosition: '-400px 0' },
                    '100%': { backgroundPosition: '400px 0' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%':      { transform: 'translateY(-12px)' },
                },
                steam: {
                    '0%':   { transform: 'translateY(0) scale(1)', opacity: '0.6' },
                    '100%': { transform: 'translateY(-40px) scale(1.4)', opacity: '0' },
                },
            },
        },
    },

    plugins: [forms],
};
