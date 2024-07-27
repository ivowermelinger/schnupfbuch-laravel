module.exports = {
    env: {
        browser: true,
        es6: true,
    },

    extends: [
        'plugin:react/recommended',
        'plugin:@wordpress/eslint-plugin/recommended',
        'prettier',
        'eslint-config-prettier',
    ],

    plugins: ['prettier'],

    rules: {
        'prettier/prettier': [
            'error',

            {
                objectCurlySpacing: false,

                arrowParens: 'avoid',

                printWidth: 120,
            },
        ],

        'space-unary-ops': [
            2,

            {
                words: false,

                nonwords: false,
            },
        ],

        'arrow-parens': ['error', 'as-needed'],

        'computed-property-spacing': ['error', 'never'],

        'array-bracket-spacing': ['error', 'never'],

        'space-in-parens': ['error', 'never'],

        indent: ['error', 'tab'],

        'react/jsx-curly-spacing': ['error', 'never'],

        'linebreak-style': ['error', 'unix'],

        quotes: ['error', 'single'],

        semi: ['error', 'always'],

        'react-hooks/rules-of-hooks': 'off',

        'max-len': ['error', { code: 120 }],
    },
};
