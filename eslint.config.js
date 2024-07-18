import globals from 'globals';
import pluginJs from '@eslint/js';
import eslintConfigPrettier from 'eslint-config-prettier';

export default [
    eslintConfigPrettier,
    { languageOptions: { globals: globals.browser } },
    pluginJs.configs.recommended,
    {
        ignores: ['node_modules', 'vendor', 'dist', 'build', 'public'],
    },
];
