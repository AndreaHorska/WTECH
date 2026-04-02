import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/variables.css',
                'resources/css/header_footer.css',
                'resources/css/style.css',
                'resources/css/product_card.css',
                'resources/css/user_style.css',
                'resources/css/cart.css',
                'resources/css/products.css',
                'resources/css/ok.css',
                'resources/js/app.js',
                'resources/js/products.js',
                'resources/js/cart.js',
                'resources/js/billing_address.js',
                'resources/js/filter.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
