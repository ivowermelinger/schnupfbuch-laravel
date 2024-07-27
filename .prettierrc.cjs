module.exports = {
    ...require('@wordpress/prettier-config'),
    plugins: ['prettier-plugin-blade', 'prettier-plugin-tailwindcss'],
    useTabs: false,
    overrides: [
        {
            files: ['*.blade.php'],
            options: {
                parser: 'blade',
            },
        },
        {
            files: ['*.svelte'],
            options: {
                parser: 'svelte',
            },
        },
    ],
};
