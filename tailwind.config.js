const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
            },
        },

        colors: {
            dark: '#231f20',
            light: '#f2efea',
            primary: '#de3c4b',
            error: '#e0491b',
            success: '#82a759',
        },

        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '1rem',
                md: '2rem',
                lg: '2rem',
                xl: '2rem',
            },
            screens: {
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1280px',
            },
        },
        fontSize: {
            content: [
                'clamp(1.125rem, 1.0536rem + 0.3571vw, 1.375rem)',
                {
                    lineHeight: '1.3',

                    fontWeight: '400',
                },
            ],
            base: [
                'clamp(1.125rem, 1.0536rem + 0.3571vw, 1.375rem)',
                {
                    lineHeight: '1.3',

                    fontWeight: '400',
                },
            ],
            heading: [
                'clamp(1.5rem, 1.4286rem + 0.3571vw, 1.75rem)',
                {
                    lineHeight: '1.3',
                    fontWeight: '700',
                },
            ],
            small: [
                'clamp(0.875rem, 0.8393rem + 0.1786vw, 1rem)',
                {
                    lineHeight: '1.3',
                    fontWeight: '400',
                },
            ],
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
        },
    },
    content: [
        './app/**/*.php',
        './resources/**/*.html',
        './resources/**/*.js',
        './resources/**/*.jsx',
        './resources/**/*.ts',
        './resources/**/*.tsx',
        './resources/**/*.php',
        './resources/**/*.vue',
        './resources/**/*.twig',
    ],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
