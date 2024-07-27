<script>
import { onMount } from 'svelte';
import { showLogin, user } from '../stores';
import User from '../svg/User.svelte';
import Sidebar from '../components/Sidebar.svelte';
import Login from '../svg/LoginIcon.svelte';

$: svg = '';
$: show = false;

onMount(async () => {
    if (!$user) return;

    const creator = await import('@dicebear/core');
    const styles = await import('@dicebear/collection');

    const avatar = creator.createAvatar(styles.funEmoji, {
        seed: $user.nickname,
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

    svg = avatar.toString();
});
</script>

<header class="header" id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                {#if $user}
                    <button
                        class="header__user"
                        on:click|preventDefault={() => (show = true)}
                    >
                        <span class="visually-hidden">Sidebar öffnen</span>
                        {#if svg}
                            {@html svg}
                        {/if}
                    </button>
                {:else}
                    <div class="header__login">
                        <button
                            class="btn btn--icon-filled btn--header"
                            on:click|preventDefault={() => showLogin.set(true)}
                        >
                            <Login css="btn__icon" />
                            <span>Login</span>
                        </button>
                    </div>
                {/if}
            </div>
        </div>
    </div>
</header>

<Sidebar picture={svg} bind:show={show} />
