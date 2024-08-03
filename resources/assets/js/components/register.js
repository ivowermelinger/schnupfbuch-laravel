document.addEventListener('alpine:init', () => {
    window.Alpine.data('register', () => ({
        matcher: {},
        showNicknameError: false,
        nickname: '',
        init: async function () {
            const { badWords } = await import('../helpers/bad-words');
            const {
                RegExpMatcher,
                pattern,
                englishDataset,
                englishRecommendedTransformers,
            } = await import('obscenity');

            const blacklistedTerms = [];

            badWords.forEach((word, index) => {
                blacklistedTerms.push({ id: index, pattern: pattern`${word}` });
            });
            this.matcher = new RegExpMatcher({
                ...englishDataset.build(),
                ...englishRecommendedTransformers,
                blacklistedTerms: blacklistedTerms,
            });
        },
        checkNickname: function () {
            this.showNicknameError = this.matcher.hasMatch(this.nickname);
            console.log(this.showNicknameError);
        },
        submit: function () {
            if (this.showNicknameError) {
                this.$refs.nickname.focus();
                return;
            }

            this.$wire.register();
        },
    }));
});
