import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './app/Filament/**/*.php',
        './app/Http/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            colors: {
                // Base backgrounds
                'bg-base':    '#0F0320',
                'bg-card':    '#1A0530',
                'bg-section': '#150428',
                'bg-light':   '#1F0840',

                // Accent colors
                'accent': {
                    DEFAULT: '#D4157A',
                    hover:   '#B8106A',
                    light:   '#F06FAF',
                    dark:    '#8E0E52',
                },
                'gold': {
                    DEFAULT: '#F0C060',
                    light:   '#F8D990',
                    dark:    '#C49030',
                },

                // Text
                'text-primary': '#F5EEFF',
                'text-muted':   '#9B87B0',
                'text-subtle':  '#6B5580',

                // Border
                'border-card':  '#D4157A',
                'border-soft':  '#3D1A5A',
            },

            fontFamily: {
                heading: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
                body:    ['"Inter"', ...defaultTheme.fontFamily.sans],
                sans:    ['"Inter"', ...defaultTheme.fontFamily.sans],
            },

            fontSize: {
                'hero':    ['clamp(2.5rem, 5vw, 3.75rem)', { lineHeight: '1.1' }],
                'section': ['clamp(1.8rem, 3vw, 2.5rem)',  { lineHeight: '1.2' }],
                'card':    ['clamp(1.1rem, 2vw, 1.375rem)', { lineHeight: '1.3' }],
            },

            spacing: {
                'section': '7rem',
                'section-sm': '4rem',
            },

            borderRadius: {
                'card': '12px',
                'btn':  '8px',
            },

            boxShadow: {
                'card':   '0 2px 20px rgba(212, 21, 122, 0.15)',
                'card-hover': '0 4px 30px rgba(212, 21, 122, 0.35)',
                'glow':   '0 0 40px rgba(212, 21, 122, 0.2)',
            },

            backgroundImage: {
                'gradient-accent': 'linear-gradient(135deg, #D4157A 0%, #8E0E52 100%)',
                'gradient-dark':   'linear-gradient(180deg, #0F0320 0%, #1A0530 100%)',
                'gradient-hero':   'linear-gradient(135deg, #0F0320 0%, #1A0530 60%, #2A0850 100%)',
                'gradient-card':   'linear-gradient(135deg, #1A0530 0%, #240A42 100%)',
            },

            animation: {
                'fade-up':   'fadeUp 0.6s ease-out forwards',
                'fade-in':   'fadeIn 0.4s ease-out forwards',
                'pulse-soft': 'pulseSoft 3s ease-in-out infinite',
            },

            keyframes: {
                fadeUp: {
                    '0%':   { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                pulseSoft: {
                    '0%, 100%': { opacity: '1' },
                    '50%':      { opacity: '0.7' },
                },
            },
        },
    },

    plugins: [forms, typography],
};
