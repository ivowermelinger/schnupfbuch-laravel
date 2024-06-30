module.exports = {
	extends: ['stylelint-prettier/recommended', 'stylelint-config-standard-scss'],

	rules: {
		'no-descending-specificity': null,
		'scss/dollar-variable-colon-space-after': null,
		'value-keyword-case': null,
		'selector-class-pattern': null,
		'custom-property-pattern': null,
	},
};
