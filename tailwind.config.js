import defaultTheme from 'tailwindcss/defaultTheme';
import preset from './vendor/filament/support/tailwind.config.preset'
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/wire-elements/modal/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './vendor/filament/**/*.blade.php',

        './storage/framework/views/*.php',
        './app/Filament/**/*.php',
        './resources/**/*.blade.php',
        './resources/views/filament/**/*.blade.php',
        './app/livewire/**/*.php',
    ],
    options: {
        safelist: [
            'sm:max-w-2xl',
            'max-w-5xl',
        ]
    },
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                danger: colors.red,
                primary: colors.teal,
                success: colors.green,
                warning: colors.yellow,
                teal: {
                    '50': '#edfafa',
                    '100': '#d5f5f6',
                    '200': '#afecef',
                    '300': '#7edce2',
                    '400': '#16bdca',
                    '500': '#0694a2',
                    '600': '#047481',
                    '700': '#036672',
                    '800': '#05505c',
                    '900': '#014451',
                }
            }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },
    darkMode: 'class',
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ],
};
