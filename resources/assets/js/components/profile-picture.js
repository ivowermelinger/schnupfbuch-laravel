document.addEventListener('alpine:init', () => {
    window.Alpine.data('profilePicture', (nickname) => ({
        avatar: null,
        init: async function () {
            const creator = await import('@dicebear/core');
            const styles = await import('@dicebear/collection');

            const icon = creator.createAvatar(styles.funEmoji, {
                seed: nickname,
                backgroundColor: ['f2efea', '71a9f7'],
                backgroundType: ['gradientLinear'],
                mouth: [
                    'cute',
                    'drip',
                    'lilSmile',
                    'pissed',
                    'plain',
                    'sad',
                    'shout',
                    'smileLol',
                    'smileTeeth',
                    'wideSmile',
                ],
                eyes: [
                    'closed',
                    'closed2',
                    'cute',
                    'glasses',
                    'pissed',
                    'plain',
                    'sad',
                    'shades',
                    'sleepClose',
                    'wink',
                    'wink2',
                ],
                backgroundRotation: [90],
                radius: 8,
                scale: 75,
                size: 128,
            });

            this.avatar = icon.toDataUri();
        },
    }));
});
