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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                skyblue: '#87CEEB', // ここにカスタムカラーを追加
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require("@tailwindcss/typography"), require("daisyui")], // plugins を一つの配列に統合
};