<script lang="ts">
    import { get } from 'svelte/store';
    import { activeLine } from '../stores';

    export let setLine;

    let item = get(activeLine);

    activeLine.subscribe(value => {
        item = value;
    });

</script>

<button on:click|preventDefault={setLine} class="btn btn--loading touch__trigger">
    {#if item}
        <span class="touch__line">{item.line}</span>
        <span class="touch__author">{item.nickname}</span>
    {/if}
</button>
