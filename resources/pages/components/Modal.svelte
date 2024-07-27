<script>
    import Close from '../svg/Close.svelte';

    export let show = false;
    export let closeModal = () => {
        show = false;
    };
    export let name = 'Modal';
</script>

<div class="modal" class:modal--show={show}>
    <button class="modal__drop" on:click|preventDefault={closeModal}>
        <span class="visually-hidden">Sidebar schliessen</span>
    </button>

    <div class="modal__wrapper">
        <button class="modal__back" on:click|preventDefault={closeModal}>
            <span class="visually-hidden">{`${name} schliessen`}</span>
        </button>
        <div class="modal__inner">
            <button class="modal__close" on:click|preventDefault={closeModal}>
                <span class="visually-hidden">{`${name} schliessen`}</span>
                <Close css="modal__icon" />
            </button>
            {#if show}
                <slot />
            {/if}
        </div>
    </div>
</div>
