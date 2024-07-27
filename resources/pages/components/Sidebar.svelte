<script>
    import Close from '../svg/Close.svelte';
    import { user } from '../stores';
    import Settings from '../svg/Settings.svelte';
    import Logout from '../svg/Logout.svelte';

    export let show = false;
    export let picture = '';

    const closeModal = () => {
        show = false;
    };
</script>

<div class="sidebar" class:sidebar--show={show}>
    <button class="sidebar__drop" on:click|preventDefault={closeModal}>
        <span class="visually-hidden">Sidebar schliessen</span>
    </button>
    <div class="sidebar__wrapper">
        <button class="sidebar__close" on:click|preventDefault={closeModal}>
            <span class="visually-hidden">Sidebar schliessen</span>
            <Close css="sidebar__cross" />
        </button>
        <div class="sidebar__profile">
            {#if picture}
                {@html picture}
            {/if}
            {#if $user}
                <span>{$user.nickname}</span>
            {/if}
        </div>
        <menu class="sidebar__menu">
            <li class="sidebar__item">
                <a href="/account" class="sidebar__link">
                    <Settings css="sidebar__icon" />
                    <span>Account</span>
                </a>
            </li>
            <li class="sidebar__item">
                <a href="/logout" class="sidebar__link">
                    <Logout css="sidebar__icon" />
                    <span>Logout</span>
                </a>
            </li>
        </menu>
    </div>
</div>
