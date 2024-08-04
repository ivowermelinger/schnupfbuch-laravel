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
            error: '#AD343E',
            success: '#82a759',
            focus: '#2374AB',
            active: '#C8963E',
        },

        container: {
            center: true,
            padding: {
                DEFAULT: '1.5rem',
                sm: '1.5rem',
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
                'clamp(1rem, 0.9286rem + 0.3571vw, 1.25rem)',
                {
                    lineHeight: '1.3',

                    fontWeight: '400',
                },
            ],
            lead: [
                'clamp(1.125rem, 1.0179rem + 0.5357vw, 1.5rem)',
                {
                    lineHeight: '1.3',
                    fontWeight: '700',
                },
            ],
            heading: [
                'clamp(1.625rem, 1.5179rem + 0.5357vw, 2rem)',
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
